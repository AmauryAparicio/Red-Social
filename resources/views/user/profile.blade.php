@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row mb-5 mt-3">
                <div class="col-3">
                    @if ($user->image)
                    <img src="{{route('user.avatar', ['filename'=>$user->image])}}"
                        class="img-fluid img-thumbnail rounded-circle">
                    @endif
                </div>
                <div class="col-9">
                    <h1> {{ $user->name }} {{ $user->surname }} </h1>
                    <h2 class="text-muted">{{ '@' . str_replace(' ', '', $user->nick) }}</h2>
                    <p>Miembro desde: {{ \FormatTime::LongTimeFilter($user->created_at) }}</p>
                    <hr>
                </div>
            </div>
            @foreach ($user->images as $image)
            @include('includes.image')
            @endforeach
        </div>
    </div>
</div>


@endsection
