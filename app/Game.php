<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
       'gvalue','config_id'
    ];

    protected $table = 'tb_config';
    protected $primaryKey ='config_id';

    public $timestamps = false;
}
