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
}
