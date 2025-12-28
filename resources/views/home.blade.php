@extends('layout')

@section('content')
<main>
    <h1><img src="{{asset('/images/logo.png')}}" alt="" srcset=""></h1>

    <div class="grid">
    <a href="https://www.youtube.com" class="tile">
        <img src="{{ asset('/images/youtube.png') }}" alt="YouTube">
    </a>

    <a href="https://www.netflix.com" class="tile">
        <img src="{{ asset('/images/netflix.png') }}" alt="Netflix">
    </a>

    <a href="/country" class="tile">
        <img src="{{ asset('/images/channel.png') }}" alt="Channels">
    </a>

    <a href="/contacts" class="tile">
        <img src="{{ asset('/images/telephone.png') }}" alt="Contact">
    </a>

    <a href="/hotel" class="tile small">Hotel Info</a>
    <a href="#" class="tile small">Spa</a>
    <a href="/menu" class="tile small">Restaurant</a>
    <a href="#" class="tile small">Tour</a>
</div>

</main>
@endsection
