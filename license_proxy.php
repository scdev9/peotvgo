<?php
// Replace with your Widevine license server URL
$licenseServerUrl = 'https://api.viu.lk/drmproxy/bp/wv/license?lat=2I8mtqM5%2F6IdGKu2vcuU8oIiK33vDeizdF%2Bh9nOZ6ZBnIebC%2FxBOpO6WzG7iXvQFfy04uFRu1TvFDCH9P%2FxQNmJGrjtgf2YfBoFRFWyPy8oHTraCWJ%2BxjUhdkIKwYE7K2X%2B0j6vEfJi3Eg0V0hotlxD1U1A%2FqtbSmi7OCTUIUdC7ZNIMluqAcxfC%2F3lBVIvC%2B47KmNiUZC%2F7nUU4eok%2FrI%2Fv3pqV%2FYr%2FUW8PCOOHk1RXnGFjj8VoGcy697NwZBqeCEaxm%2FcNLelaLdhNq%2BY8pveeq8i0hyPFEwhvWlZLwuSQQVIPKq84MJu4XQWY07jT8l7%2FGu4Y8tO0MfZy1GZjgv%2Bfo%2BsuZaww0fMkwy5Ldq3yR5VHMJpMePBB9Wyx6vt6AcypVE1hW5sqSjFxOPzS26Lu2oMcywgmDOMqWpu1xZpuTtn9A4yhM2%2FTWOh0Gyr1%2B1J8oeJnsppTaowIqR7mDw%3D%3D&jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkaWQiOjEzNjQ4ODksImR1aWQiOiJkNjdjNGNiMC01MTE4LTExZWYtOWE1OC0xMzRmNDVmYTA1Y2IiLCJleHAiOjE3MjI2MzczMTMsImlhdCI6MTcyMjYzNTUxMywiaXNzIjoidW5pcUNhc3QiLCJvaWQiOjEsIm91aWQiOiJkZWZhdWx0IiwicmlkIjoxLCJyb2xlIjpbInN1YnNjcmliZXIiXSwicnVpZCI6ImRlZmF1bHQiLCJzdWIiOiJhY2Nlc3MiLCJ1aWQiOjkzOTUxMCwidmVyc2lvbiI6Mn0.rai3by01kM4K4SB27L-Sgw1kKzyjDHKyNk8fT6gdofU';

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
