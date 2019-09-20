<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'second_name', 'patronymic', 'login', 'department', 'email', 'password',
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects()
    {
        return $this->hasMany('App\Project');
    }

    public function findUsers(Request $request)
    {
        $query = [];
        if ($request['first_name']) {
            $query = $query + ['first_name' => $request['first_name']];
        }

        if ($request['second_name']) {
            $query = $query + ['second_name' => $request['second_name']];
        }

        if ($request['patronymic']) {
            $query = $query + ['patronymic' => $request['patronymic']];
        }

        if ($request['login']) {
            $query = $query + ['login' => $request['login']];
        }

        if ($request['role']) {
            $query = $query + ['role' => $request['role']];
        }

        if ($request['status']) {
            $query = $query + ['status' => $request['status']];
        }

        return $this->select(['first_name', 'second_name', 'patronymic', 'login', 'role', 'status', 'id'])->where($query)->get();
    }

    public function avatarFile()
    {
        return $this->belongsTo('App\File', 'avatar');
    }
}
