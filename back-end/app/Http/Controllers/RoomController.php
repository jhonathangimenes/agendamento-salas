<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index($locationId)
    {
        $rooms = Room::getList($locationId);

        return response()->json($rooms);
    }
}
