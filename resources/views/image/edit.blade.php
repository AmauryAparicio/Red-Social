@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar mi imagen</div>
                <div class="card-body p-0 text-center mt-2">
                    <img src=" {{ route('image.file', ['filename' => $image->image_path]) }} " class="mw-100 w-auto m-0"
                        style="max-height:200px;">
                </div>
                <div class="card-body">
                    <form action=" {{ route('image.update') }} " method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <input type="hidden" name="id" value="{{ $image->id }}">
                            <label for="image" class="col-md-3 col-form-label text-md-right">Imagen</label>
                            <div class="col-md-6">
                                <input type="file" name="image" id="image" class="form-control-file {{ $errors->has('image') ? 'is-invalid' : '' }}">
                                @if ($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong> {{ $errors->first('image') }} </strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-3 col-form-label text-md-right">Descripcion</label>
                            <div class="col-md-6">
                                <textarea name="description" id="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" style="resize: none">{{ $image->description }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong> {{ $errors->first('description') }} </strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3 offset-md-3">
                                <input type="submit" class="btn btn-primary" value="Actualizar Imagen">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
