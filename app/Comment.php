<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends BModel
{
    //
/*    protected $fillable = [
        'user_id',
        'content'
    ];*/
    public function post()
    {
        return $this->belongsTo('App\Post','post_id','id');
    }
    //评论用用户
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
     }
}
