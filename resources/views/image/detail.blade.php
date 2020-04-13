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
                            class="img-fluid img-thumbnail rounded">
                        @endif
                        <span class="h5"><strong>{{ $image->user->name . ' ' . $image->user->surname }} <span
                                    class="text-muted small">
                                    {{ '@' . str_replace(' ', '', $image->user->nick) }}</span> </strong></span>
                    </div>
                </div>
                <div class="card-body p-0 text-center">
                    <img src=" {{ route('image.file', ['filename' => $image->image_path]) }} " class="mw-100 w-auto m-0" style="max-height:400px;">
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
                        <a href="#" class="text-dark h4">
                            <svg class="bi bi-chat" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M2.678 11.894a1 1 0 01.287.801 10.97 10.97 0 01-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 01.71-.074A8.06 8.06 0 008 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 01-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 00.244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 01-2.347-.306c-.52.263-1.639.742-3.468 1.105z"
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
