@extends('layout')

@section('content')
<main>
    <h1>Welcome</h1>

    <div class="grid">
        <a href="https://www.youtube.com/tv" class="tile">YouTube</a>
        <a href="https://www.netflix.com" class="tile">Netflix</a>
        <a href="/channels" class="tile">Free TV</a>
        <a href="/hotel" class="tile">Hotel Info</a>

        <a href="/menu" class="tile small">Restaurant</a>
        <a href="#" class="tile small">Spa</a>
        <a href="#" class="tile small">Tours</a>
        <a href="#" class="tile small">Contact</a>
    </div>
</main>
@endsection
