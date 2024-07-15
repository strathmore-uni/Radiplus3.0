<div class="notifications">
    @foreach(Auth::user()->notifications as $notification)
        @include('partials.notifications', ['notification' => $notification])
    @endforeach
</div>