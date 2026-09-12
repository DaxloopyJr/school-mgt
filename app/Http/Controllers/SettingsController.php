<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SettingsController extends Controller
{
    protected function all(): array
    {
        return Setting::pluck('value', 'key')->toArray();
    }

    protected function save(Request $request, array $keys)
    {
        foreach ($keys as $key) {
            Setting::updateOrCreate(['key' => $key], ['value' => $request->input($key, '')]);
        }
    }

    public function general()
    {
        return view('settings.general', ['s' => $this->all()]);
    }

    public function generalSave(Request $request)
    {
        $this->save($request, ['school_name', 'school_code', 'address', 'phone', 'email', 'currency', 'currency_symbol', 'session', 'footer_text']);
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('uploads/settings', 'public');
            Setting::updateOrCreate(['key' => 'logo'], ['value' => $path]);
        }
        return back()->with('success', 'General settings saved.');
    }

    public function roles()
    {
        return view('settings.roles');
    }

    public function email()
    {
        return view('settings.email', ['s' => $this->all()]);
    }

    public function emailSave(Request $request)
    {
        $this->save($request, ['mail_mailer', 'mail_host', 'mail_port', 'mail_username', 'mail_encryption', 'mail_from_address', 'mail_from_name']);
        return back()->with('success', 'Email settings saved.');
    }

    public function sms()
    {
        return view('settings.sms', ['s' => $this->all()]);
    }

    public function smsSave(Request $request)
    {
        $this->save($request, ['sms_gateway', 'sms_api_key', 'sms_sender_id']);
        return back()->with('success', 'SMS settings saved.');
    }

    public function weekend()
    {
        $s = $this->all();
        return view('settings.weekend', ['weekends' => json_decode($s['weekends'] ?? '["Saturday","Sunday"]', true)]);
    }

    public function weekendSave(Request $request)
    {
        Setting::updateOrCreate(['key' => 'weekends'], ['value' => json_encode($request->input('days', []))]);
        return back()->with('success', 'Weekend setup saved.');
    }

    public function language()
    {
        return view('settings.language', ['s' => $this->all()]);
    }

    public function languageSave(Request $request)
    {
        $this->save($request, ['default_language', 'rtl']);
        return back()->with('success', 'Language settings saved.');
    }

    public function backup()
    {
        return view('settings.backup');
    }

    public function backupDownload()
    {
        $db = config('database.connections.mysql.database');
        $user = config('database.connections.mysql.username');
        $pass = config('database.connections.mysql.password');
        $host = config('database.connections.mysql.host');
        $file = storage_path('app/backup-' . date('Ymd-His') . '.sql');
        $cmd = sprintf('mysqldump -h%s -u%s %s %s > %s 2>&1', escapeshellarg($host), escapeshellarg($user), $pass ? '-p' . escapeshellarg($pass) : '', escapeshellarg($db), escapeshellarg($file));
        exec($cmd, $out, $code);
        if ($code === 0 && file_exists($file) && filesize($file) > 0) {
            return Response::download($file)->deleteFileAfterSend(true);
        }
        return back()->with('error', 'Backup failed: mysqldump not available or DB not reachable. Run `mysqldump` manually from the server.');
    }
}
