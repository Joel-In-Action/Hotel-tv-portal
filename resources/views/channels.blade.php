@extends('layout')

@section('content')

<h1>All Channels</h1>
<form method="GET" action="{{ route('channels') }}" class="search-form">
    <input type="text" name="q" placeholder="Search channels..." value="{{ request('q') }}" class="search-input">
    <button type="submit" class="search-button">🔍</button>
</form>

<style>
.search-form {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}

.search-input {
    padding: 10px 15px;
    width: 300px;
    border: 2px solid #ccc;
    border-radius: 30px 0 0 30px;
    font-size: 16px;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.search-input:focus {
    border-color: #6666ff;
    box-shadow: 0 0 5px rgba(102, 102, 255, 0.5);
}

.search-button {
    padding: 10px 20px;
    border: 2px solid #6666ff;
    background-color: #6666ff;
    color: #fff;
    border-radius: 0 30px 30px 0;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.2s, transform 0.1s;
}

.search-button:hover {
    background-color: #5555ee;
    transform: scale(1.05);
}
</style> 

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

<a href="/" class="tile back">⬅ Back</a>


@endsection
