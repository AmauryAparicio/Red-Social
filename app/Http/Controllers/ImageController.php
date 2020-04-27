<?php

namespace App\Http\Controllers;

use Auth;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('image.create');
    }

    public function save(request $request)
    {
        //Validacion
        $validate = $this->validate($request, [
            'description' => 'required',
            'image' => 'required|image'
        ]);

        //Recoger datos
        $descripcion = $request->descripcion;
        $image_path = $request->image;

        //Asignar valores al nuevo objeto
        $user = Auth::user();
        $image = new Image();
        $image->user_id = $user->id;
        $image->description = $descripcion;

        //Subir fichero
        if ($image_path) {
            $image_path_name = time() . $image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }

        $image->save();

        return redirect()->route('home')->with([
            'message' => 'La foto se cargo correctamente'
        ]);
    }

    public function getImage($filename)
    {
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }

    public function detail($id)
    {
        $image = Image::find($id);

        return view('image.detail', [
            'image' => $image
        ]);
    }

    public function delete($id)
    {
        $user = Auth::user();
        $image = Image::find($id);
        if ($user && $image->user->id == $user->id) {
            $image->delete();
            $message = 'La imagen se ha borrado existosamente';
        } else {
            $message = 'La imagen no se pudo borrar';
        }

        return redirect()->route('home')->with('message', $message);
    }

    public function edit($id)
    {
        $user = Auth::user();
        $image = Image::find($id);

        if ($user && $image && $image->user->id == $user->id) {
            return view('image.edit', ['image' => $image]);
        } else {
            return redirect()->route('home');
        }
    }

    public function update(request $request)
    {
        $image = Image::find($request->id);
        $description = $request->description;
        $image_path = $request->image;

        $validate = $this->validate($request, [
            'description' => 'required',
            'image' => 'required|image'
        ]);

        $image->description = $description;

        if ($image_path) {
            $image_path_name = time() . $image_path->getClientOriginalName();
            Storage::disk('images')->delete($image->image_path);
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }

        $image->update();

        return redirect()->route('image.detail', ['id' => $image->id])->with('message', 'Se actualizo correctamente la imagen');
    }
}