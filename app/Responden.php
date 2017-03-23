<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\DB;

class Responden extends Eloquent
{
    protected $table = "responden";
    public $timestamps = false;
}
