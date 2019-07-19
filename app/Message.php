<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    protected  $fillable =['id', 'message', 'user_id'];
    public $timestamps = true;

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
