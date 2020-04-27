<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';

    //Relación de Muchos a Uno
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    //Relación One To Many
    public function image()
    {
        return $this->belongsTo('App\Image');
    }
}