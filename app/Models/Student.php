<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    protected $fillable = [
        'admission_no', 'roll_no', 'first_name', 'last_name', 'gender', 'dob', 'religion',
        'blood_group', 'category_id', 'class_id', 'section_id', 'group_id', 'parent_id',
        'user_id', 'phone', 'email', 'address', 'admission_date', 'photo', 'status',
        'transport_route_id', 'dormitory_room_id',
    ];

    protected $casts = ['dob' => 'date', 'admission_date' => 'date'];

    public function fullName(): string
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }

    public function photoUrl(): string
    {
        return $this->photo
            ? asset('storage/' . $this->photo)
            : 'https://ui-avatars.com/api/?name=' . urlencode($this->fullName()) . '&background=1cc88a&color=fff';
    }

    public function category()    { return $this->belongsTo(StudentCategory::class, 'category_id'); }
    public function schoolClass() { return $this->belongsTo(SchoolClass::class, 'class_id'); }
    public function section()     { return $this->belongsTo(Section::class, 'section_id'); }
    public function studentGroup(){ return $this->belongsTo(StudentGroup::class, 'group_id'); }
    public function parent()      { return $this->belongsTo(User::class, 'parent_id'); }
    public function user()        { return $this->belongsTo(User::class, 'user_id'); }

    public function transportRoute() { return $this->belongsTo(TransportRoute::class, 'transport_route_id'); }
    public function dormitoryRoom() { return $this->belongsTo(DormitoryRoom::class, 'dormitory_room_id'); }

    public function attendances()  { return $this->hasMany(StudentAttendance::class, 'student_id'); }
    public function feesPayments() { return $this->hasMany(FeesPayment::class, 'student_id'); }
    public function markRegisters(){ return $this->hasMany(MarkRegister::class, 'student_id'); }

    /** Total payable = fees masters of the class + carry forwards */
    public function totalPayable(): float
    {
        $masters = FeesMaster::where('class_id', $this->class_id)->orWhereNull('class_id')->sum('amount');
        $carry = FeesCarryForward::where('student_id', $this->id)->sum('amount');
        return (float) ($masters + $carry);
    }

    public function totalPaid(): float
    {
        return (float) $this->feesPayments()->sum('amount');
    }

    public function balance(): float
    {
        return max(0, $this->totalPayable() - $this->totalPaid());
    }
}
