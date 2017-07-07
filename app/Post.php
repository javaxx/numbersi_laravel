<?php

namespace App;

class Post extends BModel
{

    //可以注入的字段
    protected $fillable = ['title','content','user_id'];

    //关联用户
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
    public function comments(){
        return $this->hasMany('App\Comment','post_id','id')->orderBy('created_at','desc');
    }

    //
    public function zan($user_id)
    {
        return $this->hasOne(\App\Zan::class)->where('user_id',$user_id);
    }
    public function zans(){
        return $this->hasMany('App\Zan','post_id','id')->orderBy('created_at','desc');
    }
}
