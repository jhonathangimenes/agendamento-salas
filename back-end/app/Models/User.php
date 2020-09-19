<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'sector_id', 'type_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function type()
    {
        return $this->belongsTo('App\Models\Type');
    }

    static function getList(){
        $meeting = DB::table('users')
            ->join('sectors', 'users.sector_id', '=', 'sectors.id')
            ->join('types', 'users.type_id', '=', 'types.id')
            ->select('users.*', 'sectors.name as sector_name', 'types.name as type_name')
            ->orderBy('name', 'asc')
            ->get();
        return $meeting;
    }

    static function getFind($userId) {
        $user = DB::table('users')
            ->where('users.id', $userId)
            ->join('sectors', 'users.sector_id', '=', 'sectors.id')
            ->join('types', 'users.type_id', '=', 'types.id')
            ->select('users.id', 'users.email','users.name','sectors.name as sector_name', 'types.name as type_name')
            ->first();

        return $user;
    }
}
