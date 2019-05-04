<?php

namespace App;
use Illuminate\Database\Eloquent\Builder;
use App\Model;

class Post extends Model
{
    //
//    protected $fillable = [
//        'title', 'content',
//    ];
//    protected $guarded = [];

        public function user(){
            return $this->belongsTo('\App\User');
        }
        public function comments(){

            return $this->hasMany('App\Comments');
        }
        public function zan($user_id){

            return $this->hasMany('App\Zan')->where('user_id',$user_id);
        }
        public function zans(){

            return $this->hasMany('App\Zan');
        }

        public function scopeauthorBy(Builder $query,$user_id){

            return $query->where('user_id',$user_id);
        }

        public function postTopics(){

            return $this->hasMany('App\Post_topic','post_id','id');
        }

        public function scopetopicNotBy(Builder $query,$topic_id){

            return $query->doesntHave('postTopics','and',function($q) use ($topic_id) {
                $q->where('topic_id',$topic_id);
            });
        }
}
