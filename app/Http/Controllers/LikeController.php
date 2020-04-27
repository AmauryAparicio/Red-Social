<?php

namespace App\Http\Controllers;

use App\Like;
use Auth;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $likes = Like::orderBy('id', 'desc')->where('user_id', $user->id)->paginate(5);

        return view('like.index', [
            'likes' => $likes
        ]);
    }

    public function like($image_id)
    {
        $user = Auth::user();

        $isset_like = Like::where('user_id', $user->id)->where('image_id', $image_id)->exists();
        if (!$isset_like) {
            $like = new Like();
            $like->user_id = $user->id;
            $like->image_id = (int) $image_id;
            $like->save();

            return response()->json([
                'like' => $like
            ]);
        } else {
            return response()->json([
                'message' => 'El like ya existe'
            ]);
        }
    }

    public function dislike($image_id)
    {
        $user = Auth::user();

        $like = Like::where('user_id', $user->id)->where('image_id', $image_id);
        if ($like->exists()) {
            $like->first()->delete();

            return response()->json([
                'like' => $like,
                'message' => 'Has dado dislike correctamente'
            ]);
        } else {
            return response()->json([
                'message' => 'El like no existe'
            ]);
        }
    }
}