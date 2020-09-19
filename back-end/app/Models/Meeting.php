<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'room_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    static function isMeetingToday($date, $userId) {
        $starDate = date('Y-m-d', strtotime($date));

        $meeting = DB::table('meetings')
            ->where('user_id', $userId)
            ->whereDate('start_date',$starDate)
            ->exists();
        return $meeting;
    }

    static function isMeetingRomm($starDate, $endDate, $rommId) {
        $starDateFormat = date('Y-m-d', strtotime($starDate));
        $endDateFormat = date('Y-m-d', strtotime($endDate));

        $starTimeFormat = date('H:i:s', strtotime($starDate));
        $endTimeFormat = date('H:i:s', strtotime($endDate));

        $meeting = DB::table('meetings')
            ->where('room_id', $rommId)
            ->whereDate('start_date','=',$starDateFormat)
            ->whereTime('start_date', '<=', $starTimeFormat)
            ->whereDate('end_date','=',$endDateFormat)
            ->whereTime('end_date', '>=', $endTimeFormat)
            ->exists();
        return $meeting;
    }

    static function getList(){
        $meeting = DB::table('meetings')
            ->join('users', 'meetings.user_id', '=', 'users.id')
            ->join('rooms', 'meetings.room_id', '=', 'rooms.id')
            ->join('locations', 'rooms.location_id', '=', 'locations.id')
            ->join('sectors', 'users.sector_id', '=', 'sectors.id')
            ->select(
                'meetings.*',
                'users.name as user_name',
                'rooms.name as room_name',
                'locations.name as location_name',
                'sectors.name as sector_name')
            ->orderBy('start_date', 'desc')
            ->get();
        return $meeting;
    }
}
