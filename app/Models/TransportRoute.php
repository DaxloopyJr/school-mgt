<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransportRoute extends Model
{
    protected $table = 'transport_routes';

    protected $fillable = [
        'title',
        'fare',
        'description',
    ];

    protected $casts = ['fare' => 'decimal:2'];


    public function vehicles() { return $this->hasMany(Vehicle::class, 'transport_route_id'); }
}
