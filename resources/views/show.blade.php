@extends('layout')

@section('content')

<h1>Channels</h1>

<!-- Search form -->
<form method="GET" action="{{ route('showChannels') }}" style="margin-bottom: 20px;">
    <input type="text" name="q" placeholder="Search channels..." value="{{ request('q') }}" style="padding: 8px; width: 250px;">
    <button type="submit" style="padding: 8px;">Search</button>
</form>

<div class="grid">
    @forelse ($channels as $channel)
        @php
            // If a search query exists, filter channels by name
            $query = request('q');
            if ($query && stripos($channel['name'], $query) === false) {
                continue;
            }
        @endphp
        <a href="{{ route('player', ['url' => $channel['url'], 'name' => $channel['name']]) }}" class="tile">
            @if(!empty($channel['logo']))
                <img src="{{ $channel['logo'] }}" alt="{{ $channel['name'] }}" class="channel-logo">
            @endif
            <span>{{ $channel['name'] }}</span>
        </a>
    @empty
        <p>No channels found.</p>
    @endforelse
</div>

<a href="/country" class="tile back">⬅ Back</a>

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
.back {
    background: #bbb;
    margin-top: 20px;
    display: inline-block;
}
.channel-logo {
    max-width: 100px;
    max-height: 60px;
    margin-bottom: 8px;
    object-fit: contain;
}
</style>

@endsection
