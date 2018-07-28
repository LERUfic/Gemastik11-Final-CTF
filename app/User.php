<?php

namespace App;

use Illuminate\Notifications\Notifiable;
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
        'team_username', 'team_password', 'team_type',
    ];

    protected $table = 'tb_team';
    protected $primaryKey ='team_id';
    protected $hidden = [
        'team_password','remember_token',
    ];
    public $timestamps = false;

    public function getAuthPassword()
    {
        return $this->team_password;
    }
}