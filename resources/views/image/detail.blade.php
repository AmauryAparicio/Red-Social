@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('includes.message')
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card pub_image mb-2">
                <div class="card-header">
                    <div class="container-avatar">
                        @if ($image->user->image)
                        <img src=" {{ route('user.avatar', ['filename' => $image->user->image]) }} "
                            class="img-fluid img-thumbnail rounded-circle">
                        @endif
                        <span class="h5"><strong>{{ $image->user->name . ' ' . $image->user->surname }} <span
                                    class="text-muted small">
                                    {{ '@' . str_replace(' ', '', $image->user->nick) }}</span> </strong></span>
                    </div>
                </div>
                <div class="card-body p-0 text-center">
                    <img src=" {{ route('image.file', ['filename' => $image->image_path]) }} " class="mw-100 w-auto m-0"
                        style="max-height:400px;">
                </div>
                <div class="card-body">
                    <div class="mb-1">
                        @php
                        $user_like = false;
                        @endphp
                        @foreach ($image->likes as $like)
                        @if ($like->user->id == Auth::user()->id)
                        @php
                        $user_like = true;
                        @endphp
                        @endif
                        @endforeach
                        @if ($user_like)
                        <img src=" {{ asset('img/heart-red.png') }} " alt="" style="width: 25px" class="btn-dislike"
                            data-id=" {{ $image->id }} ">
                        @else
                        <img src=" {{ asset('img/heart-black.png') }} " alt="" style="width: 25px" class="btn-like"
                            data-id=" {{ $image->id }} ">
                        @endif
                    </div>
                    <div class="description">
                        <strong>{{ '@' . str_replace(' ', '', $image->user->nick) }}</strong>
                        <span class="mb-0"> "{{ $image->description }}" </span>
                        <br>
                        <small> {{ \FormatTime::LongTimeFilter($image->created_at) }}
                        </small>
                        @if (Auth::user() && Auth::user()->id == $image->user->id)
                        <br>
                        <div class="btn-group btn-group-sm mt-2" role="group">
                            <a href=" {{ route('image.edit', ['id' => $image->id]) }} " class="btn btn-outline-secondary">Actualizar</a>
                            <a href="#delModal" data-toggle="modal"
                                class="btn btn-outline-danger">Borrar</a>
                        </div>
                        <div class="modal fade" id="delModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Borrar imagen</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h4>Si borras esta imagen, no podras recuperarla y se eliminaran todos los comentarios y me gusta.</h4>
                                        <p>¿Estas seguro de querer eliminarla?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href=" {{ route('image.delete', ['id' => $image->id]) }} "
                                            class="btn btn-sm btn-outline-danger">Eliminar definitivamente</a>
                                        <button type="button" class="btn btn-sm btn-outline-secondary"
                                            data-dismiss="modal">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <hr>
                        <p class="mb-1">Comentarios:</p>
                        @foreach ($image->comments as $comment)
                        <hr style="margin: 5px 0 5px 0">
                        <div class="row">
                            <div class="pl-3">
                                <small><strong> {{ '@' . str_replace(' ', '', $comment->user->nick) }} </strong></small>
                                <small> {{ $comment->content }} </small>
                            </div>
                            @if (Auth::check() && ($comment->user_id == Auth::user()->id || $image->user_id ==
                            Auth::user()->id))
                            <div class="ml-auto mr-0 col-2">
                                <a href=" {{ route('comment.delete', ['id' =>$comment->id]) }} "
                                    class="text-danger">Eliminar</a>
                            </div>
                            @endif
                        </div>
                        @endforeach
                        <form action=" {{ route('comment.save') }} " method="post">
                            {{ csrf_field() }}

                            <input type="hidden" name="image_id" value=" {{ $image->id }} ">
                            <div class="input-group mt-3">
                                <textarea
                                    class="form-control text-dark {{ $errors->has('content') ? 'is-invalid' : '' }}"
                                    name="content" id="content" rows="1" style="resize: none"
                                    placeholder="Agregar un comentario..."></textarea>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary " type="submit"
                                        id="submit">Publicar</button>
                                </div>

                                @if ($errors->has('content'))
                                <div class="invalid-feedback" role="alert">
                                    <strong> {{ $errors->first('content') }} </strong>
                                </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
