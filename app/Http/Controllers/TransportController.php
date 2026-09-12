<?php

namespace App\Http\Controllers;

use App\Models\TransportRoute;
use App\Models\Student;

class TransportController extends Controller
{
    public function report()
    {
        $routes = TransportRoute::with(['vehicles'])->orderBy('title')->get()->map(function ($r) {
            return [
                'route'    => $r,
                'students' => Student::where('transport_route_id', $r->id)->where('status', 'active')->with('schoolClass')->get(),
            ];
        });
        return view('transport.report', ['routes' => $routes]);
    }
}
