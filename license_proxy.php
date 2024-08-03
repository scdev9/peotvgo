<?php
$licenseServerUrl = 'https://api.viu.lk/drmproxy/bp/wv/license?lat=2I8mtqM5%2F6IdGKu2vcuU8oIiK33vDeizdF%2Bh9nOZ6ZD3F5PJot%2FvAQincDJ4YXelZIDpsx5ncx%2B3xfYO1WKt6kQ1Dnmi6UjMh6SAt84soRG6W34XD%2Fsfc0F6IKRjpDrl0GeiJwGHB4AEnv67uIWdWiqXC%2B9XTf%2FZ5FQrndcWU%2BRtmPGloGfGi8AFNFONtwfG9qamyWIP%2FK5L4gWvQTikTg20J6p26mVxO06%2FjVlCMnChQqXnf9qmvdIZZPbRzXzVSgwYXI%2FX%2FNPW8VTuImqkf09jUPJ6FhN0d1sPMMaBqLDEf7EEvtcA%2BvuiKxAwIv%2BEmVz1OifrROKatpkbb6Dlf7DLeHuzmlhMiycULa47BZQx55%2Fa2wa6ZUNd1eZSjdZ%2BtlSjkpRbP2BkD2AZkdACITlVvTRqp7cQctCpBYNks%2B0Va4QZuZ2MvRaPuiS%2BdNsgpKKVi8msJy0eZxD0%2B9rXMg%3D%3D&jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJkaWQiOjEzNjQ4ODksImR1aWQiOiJkNjdjNGNiMC01MTE4LTExZWYtOWE1OC0xMzRmNDVmYTA1Y2IiLCJleHAiOjE3MjI2NTE5MjEsImlhdCI6MTcyMjY1MDEyMSwiaXNzIjoidW5pcUNhc3QiLCJvaWQiOjEsIm91aWQiOiJkZWZhdWx0IiwicmlkIjoxLCJyb2xlIjpbInN1YnNjcmliZXIiXSwicnVpZCI6ImRlZmF1bHQiLCJzdWIiOiJhY2Nlc3MiLCJ1aWQiOjkzOTUxMCwidmVyc2lvbiI6Mn0.M1VFgtf8vs_bzYpfax_IfYn39KLMFOWxoaPLztZDz0E';

header('Content-Type: application/octet-stream');

$ch = curl_init($licenseServerUrl);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, file_get_contents('php://input'));

$response = curl_exec($ch);

if ($response === false) {
    http_response_code(500);
    echo 'Error: ' . curl_error($ch);
} else {
    echo $response;
}

curl_close($ch);
?>
