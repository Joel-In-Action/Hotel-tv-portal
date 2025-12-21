@extends('layout')

@section('content')
<h1>{{ ucfirst($channel) }}</h1>

<div style="text-align:center;">
    @if($channel === 'news')
        <iframe width="90%" height="500"
            src="https://www.youtube.com/embed/live_stream?channel=UCupvZG-5ko_eiXAupbDfxWw"
            frameborder="0" allowfullscreen></iframe>

    @elseif($channel === 'music')
        <iframe width="90%" height="500"
            src="https://www.youtube.com/embed/5qap5aO4i9A"
            frameborder="0" allowfullscreen></iframe>

    @elseif($channel === 'travel')
        <iframe width="90%" height="500"
            src="https://www.youtube.com/embed/live_stream?channel=UCn2y8P3K2NnV0N3JpJg9wqQ"
            frameborder="0" allowfullscreen></iframe>

    @elseif($channel === 'kids')
        <iframe width="90%" height="500"
            src="https://www.youtube.com/embed/live_stream?channel=UCbCmjCuTUZos6Inko4u57UQ"
            frameborder="0" allowfullscreen></iframe>
    @endif
</div>

<a href="/channels" class="tile back">⬅ Back</a>
@endsection
