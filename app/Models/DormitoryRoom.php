<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DormitoryRoom extends Model
{
    protected $table = 'dormitory_rooms';

    protected $fillable = [
        'dormitory_id',
        'room_type_id',
        'name',
        'no_of_beds',
        'cost_per_bed',
    ];

    protected $casts = ['cost_per_bed' => 'decimal:2'];

    public function dormitory()
    {
        return $this->belongsTo(Dormitory::class, 'dormitory_id');
    }

    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }
}
