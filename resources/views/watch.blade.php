@extends('layout')

@section('content')

<style>
/* ===== TV LAYOUT ===== */
body {
    background: black;
    color: white;
}

h1 {
    margin: 10px 0;
}

/* ===== TV CONTAINER ===== */
.tv-container {
    position: relative;
    width: 100%;
    height: 85vh;
    background: black;
    overflow: hidden;
}

.tv-frame {
    width: 100%;
    height: 100%;
    border: none;
}

/* ===== OVERLAYS ===== */
.overlay-top {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 145px;
    background: black;
    z-index: 10;
    pointer-events: none;
}

.overlay-left {
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    width: 151px;
    background: black;
    z-index: 10;
    pointer-events: none;
}

.overlay-right {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    width: 340px;
    background: black;
    z-index: 10;
    pointer-events: none;
}

/* ===== TV CONTROLS ===== */
.tv-controls {
    position: absolute;
    bottom: 20px;
    left: 20px;
    z-index: 30;
    display: flex;
    gap: 15px;
}

/* ===== TV BUTTONS ===== */
.tv-btn {
    font-size: 20px;
    padding: 18px 30px;
    background: #222;
    color: white;
    border: 2px solid white;
    border-radius: 10px;
    text-decoration: none;
}

.tv-btn:focus {
    outline: none;
    background: #4CAF50;
}
</style>

<h1>{{ ucfirst($channel) }}</h1>

{{-- ================= NEWS CHANNEL ================= --}}
@if($channel === 'news')

<div class="tv-container">
    <iframe class="tv-frame"
        src="https://tv.garden/fr/yjR0KcAL5erp0S"
        allow="autoplay; fullscreen">
    </iframe>

    <div class="overlay-top"></div>
    <div class="overlay-left"></div>
    <div class="overlay-right"></div>

    <div class="tv-controls">
        <button class="tv-btn" onclick="toggleFullscreen(this)">⛶ Fullscreen</button>
        <button class="tv-btn" onclick="toggleOverlays(this)">👁 Overlays ON</button>
        <a href="/channels" class="tv-btn">⬅ Back</a>
    </div>
</div>

{{-- ================= MUSIC CHANNEL ================= --}}
@elseif($channel === 'music')

<div class="tv-container">
    <iframe class="tv-frame"
        src="https://www.youtube.com/embed/5qap5aO4i9A?autoplay=1&mute=1"
        allow="autoplay; fullscreen">
    </iframe>

    <div class="tv-controls">
        <button class="tv-btn" onclick="toggleFullscreen(this)">⛶ Fullscreen</button>
        <a href="/channels" class="tv-btn">⬅ Back</a>
    </div>
</div>

{{-- ================= TRAVEL CHANNEL ================= --}}
@elseif($channel === 'travel')

<div class="tv-container">
    <iframe class="tv-frame"
        src="https://tv.garden/tz/xJdfWe2cF6aQkl"
        allow="autoplay; fullscreen">
    </iframe>

    <div class="overlay-top"></div>
    <div class="overlay-left"></div>
    <div class="overlay-right"></div>

    <div class="tv-controls">
        <button class="tv-btn" onclick="toggleFullscreen(this)">⛶ Fullscreen</button>
        <button class="tv-btn" onclick="toggleOverlays(this)">👁 Overlays ON</button>
        <a href="/channels" class="tv-btn">⬅ Back</a>
    </div>
</div>

@endif

<script>
/* ===== FULLSCREEN ===== */
function toggleFullscreen(button) {
    const container = button.closest('.tv-container');

    if (!document.fullscreenElement) {
        container.requestFullscreen();
    } else {
        document.exitFullscreen();
    }
}

/* ===== OVERLAY TOGGLE ===== */
function toggleOverlays(button) {
    const container = button.closest('.tv-container');
    const overlays = container.querySelectorAll(
        '.overlay-top, .overlay-left, .overlay-right'
    );

    const hidden = overlays[0].style.display === 'none';

    overlays.forEach(el => {
        el.style.display = hidden ? 'block' : 'none';
    });

    button.textContent = hidden ? '👁 Overlays ON' : '🚫 Overlays OFF';
}
</script>

@endsection
