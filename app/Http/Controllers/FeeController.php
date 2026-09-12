<?php

namespace App\Http\Controllers;

use App\Models\FeesCarryForward;
use App\Models\FeesDiscount;
use App\Models\FeesMaster;
use App\Models\FeesPayment;
use App\Models\SchoolClass;
use App\Models\Student;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    public function collectForm(Request $request)
    {
        $student = null;
        $masters = collect();
        $paid = [];

        if ($request->filled('search')) {
            $student = Student::where('admission_no', $request->search)
                ->orWhere('first_name', 'like', '%' . $request->search . '%')
                ->orWhere('last_name', 'like', '%' . $request->search . '%')
                ->first();
            if ($student) {
                $masters = FeesMaster::with(['feesGroup', 'feesType'])
                    ->where('class_id', $student->class_id)->orWhereNull('class_id')->get();
                $paid = FeesPayment::where('student_id', $student->id)
                    ->selectRaw('fees_master_id, sum(amount) as total')->groupBy('fees_master_id')
                    ->pluck('total', 'fees_master_id')->toArray();
            }
        }

        return view('fees.collect', [
            'student'   => $student,
            'masters'   => $masters,
            'paid'      => $paid,
            'discounts' => FeesDiscount::orderBy('name')->get(),
            'search'    => $request->search,
        ]);
    }

    public function collectSave(Request $request)
    {
        $request->validate([
            'student_id'     => 'required|exists:students,id',
            'fees_master_id' => 'required|exists:fees_masters,id',
            'amount'         => 'required|numeric|min:0.01',
            'payment_date'   => 'required|date',
            'method'         => 'required|string',
        ]);

        $payment = FeesPayment::create([
            'invoice_no'      => 'INV-' . str_pad((string) (FeesPayment::max('id') + 1), 6, '0', STR_PAD_LEFT),
            'student_id'      => $request->student_id,
            'fees_master_id'  => $request->fees_master_id,
            'amount'          => $request->amount,
            'discount_amount' => $request->discount_amount ?? 0,
            'fine'            => $request->fine ?? 0,
            'payment_date'    => $request->payment_date,
            'method'          => $request->method,
            'note'            => $request->note,
            'received_by'     => auth()->id(),
        ]);

        return redirect()->route('fees.invoice', $payment->id)
            ->with('success', 'Fees collected. Invoice ' . $payment->invoice_no);
    }

    public function invoice($id)
    {
        $payment = FeesPayment::with(['student.schoolClass', 'student.section', 'feesMaster.feesType', 'receivedBy'])->findOrFail($id);
        return view('fees.invoice', ['payment' => $payment]);
    }

    public function searchPayment(Request $request)
    {
        $payments = FeesPayment::with(['student', 'feesMaster.feesType'])
            ->when($request->invoice_no, fn ($q) => $q->where('invoice_no', 'like', '%' . $request->invoice_no . '%'))
            ->when($request->from, fn ($q) => $q->whereDate('payment_date', '>=', $request->from))
            ->when($request->to, fn ($q) => $q->whereDate('payment_date', '<=', $request->to))
            ->when($request->student, function ($q) use ($request) {
                $q->whereHas('student', fn ($s) => $s->where('first_name', 'like', '%' . $request->student . '%')
                    ->orWhere('admission_no', 'like', '%' . $request->student . '%'));
            })
            ->latest('payment_date')->paginate(20)->withQueryString();

        return view('fees.search-payment', ['payments' => $payments]);
    }

    public function searchDues(Request $request)
    {
        $classes = SchoolClass::orderBy('name')->pluck('name', 'id');
        $rows = collect();

        if ($request->filled('class_id')) {
            $rows = Student::with(['schoolClass', 'section'])
                ->where('status', 'active')->where('class_id', $request->class_id)
                ->orderBy('roll_no')->get()
                ->map(fn ($s) => ['student' => $s, 'payable' => $s->totalPayable(), 'paid' => $s->totalPaid(), 'due' => $s->balance()])
                ->filter(fn ($r) => $r['due'] > 0)->values();
        }
        return view('fees.search-dues', ['classes' => $classes, 'rows' => $rows, 'class_id' => $request->class_id]);
    }

    public function collectionReport(Request $request)
    {
        $from = $request->get('from', today()->startOfMonth()->toDateString());
        $to = $request->get('to', today()->toDateString());

        $rows = FeesPayment::whereBetween('payment_date', [$from, $to])
            ->selectRaw('payment_date, method, count(*) as receipts, sum(amount) as total')
            ->groupBy('payment_date', 'method')->orderBy('payment_date')->get();

        return view('fees.collection-report', [
            'rows' => $rows, 'from' => $from, 'to' => $to, 'grand' => $rows->sum('total'),
        ]);
    }

    public function monthlyReport(Request $request)
    {
        $year = $request->get('year', now()->year);
        $rows = FeesPayment::whereYear('payment_date', $year)->get()
            ->groupBy(fn ($p) => (int) $p->payment_date->format('n'))
            ->map(fn ($g) => $g->sum('amount'));

        return view('fees.monthly-report', ['rows' => $rows, 'year' => $year, 'grand' => $rows->sum()]);
    }

    // ---------------- student / parent panel ----------------
    public function myInvoices(Request $request)
    {
        $student = $this->resolveStudent($request);
        $payments = $student
            ? FeesPayment::with('feesMaster.feesType')->where('student_id', $student->id)->latest('payment_date')->get()
            : collect();

        return view('panel.invoices', [
            'student'  => $student,
            'payments' => $payments,
            'children' => auth()->user()->role === 'parent' ? auth()->user()->children : collect(),
            'masters'  => $student ? FeesMaster::with('feesType')->where('class_id', $student->class_id)->orWhereNull('class_id')->get() : collect(),
            'paidMap'  => $student ? FeesPayment::where('student_id', $student->id)->selectRaw('fees_master_id, sum(amount) as total')->groupBy('fees_master_id')->pluck('total', 'fees_master_id') : collect(),
        ]);
    }

    public function payOnline(Request $request, $masterId)
    {
        $student = $this->resolveStudent($request);
        abort_unless($student, 403);
        $master = FeesMaster::with('feesType')->findOrFail($masterId);
        return view('panel.pay', ['student' => $student, 'master' => $master]);
    }

    public function payOnlineSubmit(Request $request, $masterId)
    {
        $student = $this->resolveStudent($request);
        abort_unless($student, 403);
        $request->validate(['amount' => 'required|numeric|min:0.01']);

        $payment = FeesPayment::create([
            'invoice_no'      => 'INV-' . str_pad((string) (FeesPayment::max('id') + 1), 6, '0', STR_PAD_LEFT),
            'student_id'      => $student->id,
            'fees_master_id'  => $masterId,
            'amount'          => $request->amount,
            'discount_amount' => 0,
            'fine'            => 0,
            'payment_date'    => today()->toDateString(),
            'method'          => 'online',
            'note'            => 'Paid online by ' . auth()->user()->name,
            'received_by'     => auth()->id(),
        ]);

        return redirect()->route('panel.invoices', ['student' => $student->id])
            ->with('success', 'Payment successful. Invoice ' . $payment->invoice_no);
    }

    protected function resolveStudent(Request $request): ?Student
    {
        $user = auth()->user();
        if ($user->role === 'student') {
            return $user->student;
        }
        if ($user->role === 'parent') {
            $childId = $request->get('student') ?: $user->children()->value('id');
            return $user->children()->where('id', $childId)->first() ?? $user->children()->first();
        }
        return null;
    }
}
