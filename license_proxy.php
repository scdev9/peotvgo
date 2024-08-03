<?php
$licenseServerUrl = 'https://api.viu.lk/drmproxy/bp/wv/license?lat=2I8mtqM5%2F6IdGKu2vcuU8oIiK33vDeizdF%2Bh9nOZ6ZBNRmRIT4VavGGQmFvkaDU5nNTi1YAHYjgGvdxZB1deiZrsuLOvpI53xjR97IKr%2F%2BJABarlmNDKPWMkq%2FtD%2FJCuDvaevlTfgEtcTNSXxNnJSN%2BsYSYYgj6b78i7mAmyaz%2BsNl7Bes1ZG%2BLHUnqZ8wAc0ZnM6xB0J7xamBGGvClXOSNgORiAPaXJMD%2FjcRTidlp1C80EAtEr8UNaZJJrQfhV0mIi4XRfdV%2Bi6luhtvl8hRje34X6Za2LoHbdoBM7PmFitz68JNtQJ8AWEaQMGf9hyaKwpIsz11da%2FHXh20kR7Us39L8Ghv5M5UJPKkHrpQgRzrwdsVCy04CQu%2Bl3DlLcPE0sa0e8P7DE5OSyttD%2FcXwUzmbfI%2B2lvdgl%2Bvzpcgd91oWwmYW7YUaujO1UEfN6zfy%2F0P3oYTKYytjlgu1mtQ%3D%3D&jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkaWQiOjEzNjQ4ODksImR1aWQiOiJkNjdjNGNiMC01MTE4LTExZWYtOWE1OC0xMzRmNDVmYTA1Y2IiLCJleHAiOjE3MjI2NTMxNjcsImlhdCI6MTcyMjY1MTM2NywiaXNzIjoidW5pcUNhc3QiLCJvaWQiOjEsIm91aWQiOiJkZWZhdWx0IiwicmlkIjoxLCJyb2xlIjpbInN1YnNjcmliZXIiXSwicnVpZCI6ImRlZmF1bHQiLCJzdWIiOiJhY2Nlc3MiLCJ1aWQiOjkzOTUxMCwidmVyc2lvbiI6Mn0.e7VNIsQoqYG9NI9pyWl-6wYfSkErRHYn_9swJKSqr7A';

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
?>
