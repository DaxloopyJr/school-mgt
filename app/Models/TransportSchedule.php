<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransportSchedule extends Model
{
    protected $table = 'transport_schedules';

    protected $fillable = [
        'transport_route_id',
        'vehicle_id',
        'day',
        'departure_time',
    ];

    protected $casts = [];

    public function transportRoute()
    {
        return $this->belongsTo(TransportRoute::class, 'transport_route_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }
}
