<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Comment;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(request $request)
    {
        $validate = $this->validate($request, [
            'image_id' => 'integer|required',
            'content' => 'string|required'
        ]);

        $image_id = $request->image_id;
        $content = $request->content;
        $user = Auth::user();

        $comment = new Comment();

        $comment->user_id = $user->id;
        $comment->content = $content;
        $comment->image_id = $image_id;

        $comment->save();

        return redirect()->route('image.detail', ['id' => $image_id])->with('message', 'Has publicado tu comentario correctamente');
    }

    public function delete($id)
    {
        $user = Auth::user();

        $comment = Comment::find($id);

        if (Auth::check() && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)) {
            $comment->delete();
            return redirect()->route('image.detail', ['id' => $id])->with('message', 'Has eliminado el comentario exitosamente');
        } else {
            return redirect()->route('image.detail', ['id' => $id])->with('message', 'No se puede eliminar el comentario');
        }
    }
}
