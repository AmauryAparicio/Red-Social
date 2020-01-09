<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    //Relación de Muchos a Uno
	public function user()
	{
			return $this->belongsTo('App\User','user_id');
    }
    
    //Relación One To Many
    public function image()
    {
        return $this->hasMany('App/Image', 'image_id');
    }
}
