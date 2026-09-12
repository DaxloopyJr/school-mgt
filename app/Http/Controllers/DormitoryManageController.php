<?php

namespace App\Http\Controllers;

use App\Models\DormitoryAssign;
use App\Models\DormitoryRoom;

class DormitoryManageController extends Controller
{
    public function monitoring()
    {
        $rooms = DormitoryRoom::with(['dormitory', 'roomType'])->get()->map(function ($room) {
            $occupied = DormitoryAssign::where('dormitory_room_id', $room->id)->where('status', 'active')->count();
            return ['room' => $room, 'occupied' => $occupied, 'free' => max(0, ($room->no_of_beds ?? 0) - $occupied)];
        });
        return view('dormitory.monitoring', ['rooms' => $rooms]);
    }

    public function report()
    {
        $assigns = DormitoryAssign::with(['student.schoolClass', 'room.dormitory'])
            ->where('status', 'active')->latest('assigned_date')->paginate(20);
        return view('dormitory.report', ['assigns' => $assigns]);
    }
}
