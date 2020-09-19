<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sector extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    static function getList(){
        $sectors = DB::table('sectors')
            ->orderBy('name', 'asc')
            ->get();
        return $sectors;
    }
}
