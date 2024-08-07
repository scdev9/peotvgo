<?php
// This is the PHP proxy part

// Replace with your Widevine license server URL
$licenseServerUrl = 'https://api.viu.lk/drmproxy/bp/wv/license?lat=2I8mtqM5%2F6IdGKu2vcuU8so1x41ZiXF2F5tiLhAyShETcXyuq%2B4W5gj1tIafMLxK1FwrFvqxJDs5apZix6klFvTyJ8Of4H%2B7m6vB8v8unmLPPqLpDj2EEwmHIjKCevIj0SDxzk67iYcq4j2S500%2BC0MtP6XDxdE%2BihIfGvmuftvA6LlC%2FhEAmXsXneK8z1KGyZEuSfZFRU5728xHr7ld61JhMl%2BF18P0%2BD9TGUueJy2ygLsXN%2BuJP4mZIKDpBo0wHtWdjdS46fBBBdOu1bQh%2Ff6ukoH6mDEDWxa0RAL51%2F5%2BTrIfLE7ZKRUSVEpdvTJidZndyLbxtpTFE07S4ogC0xUSRoAj4EgsDDvqhEGsW1sTWzeWGG7k3KQxQHsJJKof43ZPf2VhfuDixNfJ16IhcKGeQYOAVU6g5p5Ww5cWqnPGimRAFw%2BQtTS0H7VdPbANRPlXaPNLZ2sUkSzkicxC%2Bg%3D%3D&jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkaWQiOjEzNjQ4ODgsImR1aWQiOiI1MGVhZDY4MC01MTE3LTExZWYtOWFlZS02ZjY1MzgzZWU5NjEiLCJleHAiOjE3MjI2NTYxNjUsImlhdCI6MTcyMjY1NDM2NSwiaXNzIjoidW5pcUNhc3QiLCJvaWQiOjEsIm91aWQiOiJkZWZhdWx0IiwicmlkIjoxLCJyb2xlIjpbInN1YnNjcmliZXIiXSwicnVpZCI6ImRlZmF1bHQiLCJzdWIiOiJhY2Nlc3MiLCJ1aWQiOjkzOTUxMCwidmVyc2lvbiI6Mn0.xDKYLDUBFX6l8WO06uNgkm0S52xdXAb9LBOG5pzNkQ4';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['license'])) {
    header('Content-Type: application/octet-stream');

    // Initialize a cURL session
    $ch = curl_init($licenseServerUrl);

    // Set the cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, file_get_contents('php://input'));

    // Execute the request
    $response = curl_exec($ch);

    // Check for errors
    if ($response === false) {
        http_response_code(500);
        echo 'Error: ' . curl_error($ch);
    } else {
        echo $response;
    }

    // Close the cURL session
    curl_close($ch);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Widevine Protected MPD Stream with JW Player</title>
  <script src="https://cdn.jwplayer.com/libraries/1uritdb6.js"></script>
</head>
<body>
  <div id="video-player"></div>
  <script>
    const player = jwplayer("video-player").setup({
      playlist: [{
        sources: [{
          file: 'https://bpcdn.dialog.lk/bpk-tv/Ch110/out/index.mpd',
          type: 'dash',
          drm: {
            widevine: {
              url: 'https://scdev9.github.io/peotvgo/stream_player.php?license=true',
              headers: {
                'Content-Type': 'application/octet-stream'
              }
            }
          }
        }]
      }],
      width: "640",
      controls: true
    });

    player.on('error', function(e) {
      console.error('Error code', e.code, 'message', e.message);
    });

    player.on('drmKeyStatus', function(event) {
      if (event.keyStatus && event.keyStatus === 'expired') {
        console.log('Key has expired, renewing...');
        player.load({
          sources: [{
            file: 'https://bpcdn.dialog.lk/bpk-tv/Ch110/out/index.mpd',
            type: 'dash',
            drm: {
              widevine: {
                url: 'https://scdev9.github.io/peotvgo/stream_player.php?license=true',
                headers: {
                  'Content-Type': 'application/octet-stream'
                }
              }
            }
          }]
        });
      }
    });
  </script>
</body>
</html>
