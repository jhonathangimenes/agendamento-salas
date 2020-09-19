<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location_id'
    ];

    static function getList($locationId){
        $types = DB::table('rooms')
            ->where('location_id', $locationId)
            ->orderBy('name', 'asc')
            ->get();
        return $types;
    }
}
