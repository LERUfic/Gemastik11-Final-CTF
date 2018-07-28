<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    protected $fillable = [
       'soal_desc','soal_poin'
    ];

    protected $table = 'tb_soal';
    protected $primaryKey ='soal_id';

    public $timestamps = false;
}
