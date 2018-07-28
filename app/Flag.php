<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flag extends Model
{

    protected $fillable = [
        'soal_id', 'team_id', 'flag_text','flag_submitter','flag_timestamp'
    ];

    protected $table = 'tb_flag';
    protected $primaryKey ='flag_id';

    public $timestamps = false;
}
