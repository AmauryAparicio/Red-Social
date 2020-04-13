@if (\Auth::user()->image)
	<img src="{{route('user.avatar', ['filename'=>Auth::user()->image])}}" class="img-fluid img-thumbnail rounded-circle">
@endif
