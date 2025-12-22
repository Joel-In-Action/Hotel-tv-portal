@extends('layout')

@section('content')
<h1>{{ ucfirst($channel) }}</h1>

<div style="text-align:center;">
    @if($channel === 'news')

            <!-- france 24 -->
        <iframe width="90%" height="500"
            src="https://tv.garden/fr/4CWVkfpOd7mDjB"
            frameborder="0" allowfullscreen></iframe>

            <!-- tbc -->
        <iframe width="90%" height="500"
            src="https://tv.garden/tz/LuoJJuzfa9CVTw"
            frameborder="0" allowfullscreen></iframe>


    @elseif($channel === 'music')
        <iframe width="90%" height="500"
            src="https://www.youtube.com/embed/5qap5aO4i9A"
            frameborder="0" allowfullscreen></iframe>

    @elseif($channel === 'travel')
        <iframe width="90%" height="500"
            src="https://tv.garden/tz/xJdfWe2cF6aQkl"
            frameborder="0" allowfullscreen></iframe>

    @endif
</div>

<a href="/channels" class="tile back">⬅ Back</a>
@endsection
