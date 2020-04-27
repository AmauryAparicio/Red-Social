<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $table = 'images';

    //Relación One To Many / de uno a muchos
    public function comments()
    {
        return $this->hasMany('App\Comment')->orderBy('id', 'desc');
    }

    //Relación One To Many
    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    //Relación de Muchos a Uno
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($image) {
            $image->likes()->each(function ($likes) {
                $likes->delete();
            });
            $image->comments()->each(function ($comments) {
                $comments->delete();
            });
            Storage::disk('images')->delete($image->image_path);
        });
    }
}