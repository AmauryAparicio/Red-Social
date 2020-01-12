<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function config()
    {
        return view('user.config');
    }

    //Control de actualizacion de datos
    public function update(Request $request)
    {
        //Conseguir el usuario identificado
        $user = \Auth::user();
        $id = $user->id;

        //Validacion del formulario
        $validate = $this->validate($request,[
            'name'=> 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'nick' => 'required|string|max:255|unique:users,nick,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$id
        ]);

        //Recoger los datos del formulario
        $id = \Auth::user()->id;
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');

        //Asignar nuevos valores al objeto de usuario
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

        //Subir la imagen
        $image_path = $request->file('image_path');
        if ($image_path) {

            //Poner nombre unico
            $image_path_name = time().\Auth::user()->id.date('m-d-y').'.jpg';

            //Guardar en la carpeta de storage
            Storage::disk('users')->put($image_path_name, File::get($image_path));

            //Asignar el nombre de la imagen en el objeto
            $user->image = $image_path_name;
        }

        //Ejecutar consulta y cambios en la base de datos
        $user->update();

        return redirect()->route('config')->with(['message'=>'Usuario actualizado correctamente']);
    }

    //Control para obtener imagenes de usuarios
    public function getImage($filename)
    {
        $file = Storage::disk('users')->get($filename);
        return response()->view($file, 200);
    }
}
