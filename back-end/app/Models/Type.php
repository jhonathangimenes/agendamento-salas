<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    static function getList(){
        $types = DB::table('types')
            ->orderBy('name', 'asc')
            ->get();
        return $types;
    }
}
