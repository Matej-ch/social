<?php
/**
 * Created by PhpStorm.
 * User: Matej
 * Date: 1. 9. 2015
 * Time: 23:29
 */

namespace Social\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model{
    protected $table = 'likeable';

    public function likeable(){
        return $this->morphTo();
    }

    public function user(){
        return $this->belongsTo('Social\Models\User','user_id');
    }
}