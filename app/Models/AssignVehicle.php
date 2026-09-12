<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignVehicle extends Model
{
    protected $table = 'assign_vehicles';

    protected $fillable = [
        'vehicle_id',
        'transport_route_id',
        'note',
    ];

    protected $casts = [];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function transportRoute()
    {
        return $this->belongsTo(TransportRoute::class, 'transport_route_id');
    }
}
