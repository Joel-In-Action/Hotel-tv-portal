<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Single TV Channel</title>

  <!-- Make the page full screen -->
  <style>
    body {
      margin: 0;
      background: black;
    }

    video {
      width: 100vw;
      height: 100vh;
    }
  </style>
</head>

<body>

  <!-- Video player (the only thing on the page) -->
  <video id="tvPlayer" controls autoplay></video>

  <!-- HLS support for most browsers -->
  <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>

  <script>
    // 1. Get the video element
    const video = document.getElementById('tvPlayer');

    // 2. Put your channel stream URL here (.m3u8)
    // const streamUrl = 'https://4kuhls.persiana.live/hls/stream.m3u8';
    const streamUrl = 'blob:https://tv.garden/c65a15fb-b9cd-4b4f-b2d4-c96a83a85054';
    

    // 3. Load the stream
    if (Hls.isSupported()) {
      const hls = new Hls();
      hls.loadSource(streamUrl);
      hls.attachMedia(video);
    } else {
      // Safari support
      video.src = streamUrl;
    }
  </script>

</body>
</html>
