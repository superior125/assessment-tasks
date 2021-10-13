<!DOCTYPE html>
<html>
  <head>
    <meta charset=utf-8 />
    <title>24 TV CANLI YAYIN</title>
    

    <link href="https://unpkg.com/video.js/dist/video-js.css" rel="stylesheet">
    <script src="https://unpkg.com/video.js/dist/video.js"></script>
    <script src="https://unpkg.com/videojs-contrib-hls/dist/videojs-contrib-hls.js"></script>

  </head>
  <body>
    <video id="my_video_1" class="video-js vjs-fluid vjs-default-skin" controls preload="auto"
    data-setup='{}'>
    <source src="{{ Storage::disk('public')->url('videos/' . $video->converted_file) }}" type="application/x-mpegURL">
    </video>
    
    <script>
      var player = videojs('my_video_1');
      player.play();
    </script>
    
  </body>
</html>
