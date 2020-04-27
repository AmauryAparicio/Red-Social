@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row text-center justify-content-center">
        <h1 class="mt-3 pb-3 col-12">Descubrir gente</h1>
        <form action=" {{ route('user.index') }} " method="GET" class="w-50" id="buscador">
            <div class="input-group mb-5 col-12">
                <div class="input-group-prepend">
                    <span class="input-group-text">Buscar usuarios</span>
                </div>
                <input type="text" class="form-control" id="search" />
                <div class="input-group-append">
                    <input class="btn btn-outline-primary" type="submit" value="Buscar">
                </div>
            </div>
        </form>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('includes.message')

            @foreach ($users as $user)
            <div class="row mb-5 mt-3 justify-content-center">
                <div class="col-2">
                    @if ($user->image)
                    <img src="{{route('user.avatar', ['filename'=>$user->image])}}"
                        class="img-fluid img-thumbnail rounded-circle">
                    @endif
                </div>
                <div class="col-8">
                    <a href=" {{ route('profile', ['id' => $user->id]) }} " class="text-dark">
                        <h2> {{ $user->name }} {{ $user->surname }} </h2>
                        <h3 class="text-muted">{{ '@' . str_replace(' ', '', $user->nick) }}</h3>
                        <p>Miembro desde: {{ \FormatTime::LongTimeFilter($user->created_at) }}</p>
                    </a>
                    <hr>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
