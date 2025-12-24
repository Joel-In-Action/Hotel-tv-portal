@extends('layout')

@section('content')
<style>
    .tv-container {
        position: relative;
        width: 100%;
        height: 80vh;
        background-color: #000;
        margin: 20px 0;
    }
    
    .tv-frame {
        width: 100%;
        height: 100%;
        border: none;
        display: block;
    }
    
    /* Overlay to hide unwanted elements */
    .overlay-top {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 145px;
        background: #000;
        z-index: 10;
        pointer-events: none;
    }
    
    .overlay-left {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        width: 151px;
        background: #000;
        z-index: 10;
        pointer-events: none;
    }
    
    .overlay-right {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        width: 340px;
        background: #000;
        z-index: 10;
        pointer-events: none;
    }
    
    /* Settings button */
    .adjust-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 20;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: 1px solid white;
        padding: 8px 15px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 12px;
        transition: background 0.3s;
    }
    
    .adjust-btn:hover {
        background: rgba(255, 255, 255, 0.4);
    }
    
    .settings-panel {
        position: absolute;
        top: 50px;
        right: 10px;
        background: rgba(0, 0, 0, 0.95);
        color: white;
        padding: 20px;
        border-radius: 8px;
        z-index: 20;
        display: none;
        min-width: 250px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
    }
    
    .settings-panel.active {
        display: block;
    }
    
    .settings-panel h3 {
        margin: 0 0 15px 0;
        font-size: 14px;
    }
    
    .settings-panel label {
        display: block;
        margin: 10px 0 5px 0;
        font-size: 12px;
    }
    
    .settings-panel input {
        width: 100%;
        padding: 5px;
        border-radius: 3px;
        border: 1px solid #666;
        background: #333;
        color: white;
    }
    
    .settings-panel button {
        margin-top: 10px;
        width: 100%;
        padding: 8px;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 12px;
    }
    
    .btn-primary { background: #4CAF50; }
    .btn-primary:hover { background: #45a049; }
    
    .btn-secondary { background: #2196F3; }
    .btn-secondary:hover { background: #1976D2; }
    
    .btn-warning { background: #FF9800; }
    .btn-warning:hover { background: #F57C00; }
    
    .tile.back {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 20px;
        background: #333;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }
    
    .tile.back:hover {
        background: #555;
    }
</style>
    

<div class="tv-container">
    <iframe class="tv-frame"
        src="https://tv.garden/fr/yjR0KcAL5erp0S"
        allow="autoplay; fullscreen">
    </iframe>

    <div class="overlay-top"></div>
    <div class="overlay-left"></div>
    <div class="overlay-right"></div>

    <div class="tv-controls">
        <button class="tile small" onclick="toggleOverlays(this)"><a href="/channels" class="tile small">⬅ Back</a></button>
    </div>
</div>

<script>
    function toggleSettings(id) {
        const panel = document.getElementById(id);
        // Close all other panels
        document.querySelectorAll('.settings-panel').forEach(p => {
            if (p.id !== id) p.classList.remove('active');
        });
        // Toggle this panel
        panel.classList.toggle('active');
    }

    function updateOverlay(input, className, property) {
        const container = input.closest('.tv-container');
        const overlay = container.querySelector('.' + className);
        overlay.style[property] = input.value + 'px';
    }

    function hideAllOverlays(button) {
        const container = button.closest('.tv-container');
        container.querySelectorAll('.overlay-top, .overlay-left, .overlay-right').forEach(el => {
            el.style.display = 'none';
        });
    }

    function showAllOverlays(button) {
        const container = button.closest('.tv-container');
        container.querySelectorAll('.overlay-top, .overlay-left, .overlay-right').forEach(el => {
            el.style.display = 'block';
        });
    }
</script>

@endsection
