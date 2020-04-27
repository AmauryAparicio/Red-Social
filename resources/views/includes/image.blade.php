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
            <a href=" {{ route('image.detail', ['id' => $image->id]) }} " class="text-dark h4">
                <svg class="bi bi-chat" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M2.678 11.894a1 1 0 01.287.801 10.97 10.97 0 01-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 01.71-.074A8.06 8.06 0 008 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 01-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 00.244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 01-2.347-.306c-.52.263-1.639.742-3.468 1.105z"
                        clip-rule="evenodd" />
                </svg>
            </a>
            @if (count($image->likes) > 0)
            <p><small> {{ count($image->likes) }} Me gusta </small></p>
            @endif
        </div>
        <div class="description">
            <a href=" {{ route('profile', ['id' => $image->user->id]) }} " class="text-dark">
                <strong>{{ '@' . str_replace(' ', '', $image->user->nick) }}</strong>
                <span class="mb-0"> "{{ $image->description }}" </span>
                <br>
            </a>
            @if (App\Comment::where('image_id', $image->id)->exists())
            @if (App\Comment::where('image_id', $image->id)->count() > 3)
            <div>
                <a href=" {{ route('image.detail', ['id' => $image->id]) }} " class="text-muted"><small>Ver los
                        {{ App\Comment::where('image_id', $image->id)->count() }} comentarios</small></a>
            </div>
            @endif
            @foreach (App\Comment::orderBy('id', 'desc')->where('image_id', $image->id)->take(3)->get() as $comment)
            <div>
                <small><strong> {{ '@' . str_replace(' ', '', $comment->user->nick) }} </strong></small>
                <small> {{ $comment->content }} </small>
            </div>
            @endforeach
            @endif
            <small> {{ \FormatTime::LongTimeFilter($image->created_at) }}
            </small>
        </div>
    </div>
</div>
