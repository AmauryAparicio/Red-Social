@extends('layouts.app')

@section('content')
<div class="container">
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
                        <a href="#" class="text-dark h4 px-1">
                            <svg class="bi bi-heart" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 01.176-.17C12.72-3.042 23.333 4.867 8 15z"
                                    clip-rule="evenodd" />
                            </svg>
                            <svg class="bi bi-heart-fill" width="1em" height="1em" viewBox="0 0 16 16" fill="red"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                    <div class="description">
                        <strong>{{ '@' . $image->user->nick }}</strong>
                        <span class="mb-0"> "{{ $image->description }}" </span>
                        <br>
                        <small> {{ \FormatTime::LongTimeFilter($image->created_at) }}
                        </small>
                        <hr>
                        <p>Comentarios:</p>
                        <form action=" {{ route('comment.save') }} " method="post">
                            {{ csrf_field() }}

                            <input type="hidden" name="image_id" value=" {{ $image->id }} ">
                            <div class="input-group">
                                <textarea class="form-control text-dark {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content" rows="1" style="resize: none"
                                    placeholder="Agregar un comentario..."></textarea>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary " type="submit"  id="submit">Publicar</button>
                                </div>
                            </div>
                            @if ($errors->has('content'))
                                <div class="invalid-feedback" role="alert">
                                    <strong> {{ $errors->first('content') }} </strong>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
