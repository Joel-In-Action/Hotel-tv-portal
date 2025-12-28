@extends('layout')

@section('content')
<h1>{{ $name }}</h1>

<video controls autoplay style="width: 100%; max-width: 800px;">
    <source src="{{ $url }}" type="application/x-mpegURL">
    Your browser does not support the video tag.
</video>

<a href="{{ url()->previous() }}" class="back">⬅ Back</a>
@endsection
