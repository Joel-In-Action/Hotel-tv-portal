@extends('layout')

@section('content')
<h1>Free Channels</h1>

<div class="grid">
    @foreach ($countries as $code => $country)
        <a href="/show" class="tile">{{ $country['country'] }} ({{ $code }})</a>
    @endforeach

    <a href="/country" class="tile back">⬅ Back</a>
</div>
@endsection
