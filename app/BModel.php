<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BModel extends Model
{
    //    //不可以注入的字段e
    protected $guarded = [];
}
