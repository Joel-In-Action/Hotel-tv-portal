@extends('layout')

@section('content')
<main>
    <h1><img src="{{asset('/images/logo.png')}}" alt="" srcset=""></h1>

    <div class="grid">
        <a href="https://www.youtube.com" class="tile"><img src="{{asset('/images/youtube.png')}}" alt="" style="width:200px;" class="tile-img"></a>
        <a href="https://www.netflix.com" class="tile"><img src="{{asset('/images/netflix.png')}}" alt="" style="width:200px;" class="tile-img"></a>
        <a href="/channels" class="tile"><img src="{{asset('/images/channel.png')}}" alt="" style="width:180px;" class="tile-img"></a>        
        <a href="" class="tile"><img src="{{asset('/images/contacts.png')}}" alt="" style="width:100px;" class="tile-img"></a>


        <a href="/hotel" class="tile small">Hotel Info</a>
        <a href="#" class="tile small">Spa</a>
        <a href="/menu" class="tile small">Restaurant</a>
        <a href="#" class="tile small">Contact</a>
    </div>
</main>
@endsection
