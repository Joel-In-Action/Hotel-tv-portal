@extends('layout')

@section('content')

<h1>All Channels</h1>

<form method="GET" action="{{ route('channels') }}" style="margin-bottom: 20px;">
    <input type="text" name="q" placeholder="Search channels..." value="{{ request('q') }}" style="padding: 8px; width: 250px;">
    <button type="submit" style="padding: 8px;">Search</button>
</form>

<div class="grid">
    @foreach ($channels as $channel)
        <a href="{{ route('player', ['url' => $channel['url'], 'name' => $channel['name']]) }}" class="tile">
            @if(!empty($channel['logo']))
                <img src="{{ $channel['logo'] }}" alt="{{ $channel['name'] }}" class="channel-logo">
            @endif
            <span>{{ $channel['name'] }}</span>
        </a>
    @endforeach
</div>

<style>
.grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 15px;
    margin-top: 20px;
}
.tile {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 15px;
    background: #f1f1f1;
    text-decoration: none;
    color: #333;
    border-radius: 8px;
    font-weight: bold;
    text-align: center;
    transition: background 0.2s;
}
.tile:hover {
    background: #ddd;
}
.channel-logo {
    max-width: 100px;
    max-height: 60px;
    margin-bottom: 8px;
    object-fit: contain;
}
</style>

@endsection
