<?php
/**
 * Created by PhpStorm.
 * User: Matej
 * Date: 30. 8. 2015
 * Time: 19:58
 */

namespace Social\Models;
use Illuminate\Database\Eloquent\Model;

class Status extends Model{
    protected $table = 'statuses';

    protected  $fillable = [
        'body'
    ];

    public function user(){
        return $this->belongsTo('Social\Models\User','user_id');
    }

    public function scopeNotReply($query){
        return $query->whereNull('parent_id');
    }

    public function replies(){
        return $this->hasMany('Social\Models\Status','parent_id');
    }

    public function likes(){
        return $this->morphMany('Social\Models\Like','likeable');
    }
}