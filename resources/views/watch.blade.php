@extends('layout')

@section('content')

<div>
    <h1>{{ $name }}</h1>
    
    <video id="video" controls autoplay style="width: 100%; max-width: 800px;" poster="">
        Your browser does not support the video tag.
    </video>
</div>

<!-- <a href="{{ url()->previous() }}" class="back" style="display: inline-block; margin-top: 20px;">⬅ Back</a> -->
<a href="{{ url()->previous() }}" class="tile back">⬅ Back</a>


<!-- Include HLS.js from CDN -->
<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
<script>
    const video = document.getElementById('video');
    const videoSrc = "{{ $url }}";

    if (Hls.isSupported()) {
        const hls = new Hls();
        hls.loadSource(videoSrc);
        hls.attachMedia(video);
        hls.on(Hls.Events.MANIFEST_PARSED, function() {
            video.play();
        });
    } else if (video.canPlayType('application/vnd.apple.mpegurl')) {
        // Native HLS support (Safari)
        video.src = videoSrc;
        video.addEventListener('loadedmetadata', function() {
            video.play();
        });
    } else {
        alert("Your browser does not support HLS playback.");
    }
</script>

<style>
.back {
    padding: 8px 12px;
    background: #bbb;
    color: #333;
    text-decoration: none;
    border-radius: 5px;
}
</style>

@endsection
