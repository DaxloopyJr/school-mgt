<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'vehicles';

    protected $fillable = [
        'vehicle_no',
        'model',
        'driver_name',
        'driver_phone',
        'capacity',
        'transport_route_id',
    ];

    protected $casts = [];

    public function transportRoute()
    {
        return $this->belongsTo(TransportRoute::class, 'transport_route_id');
    }
}
