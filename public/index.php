<?php

header("Content-Type: application/json; charset=UTF-8");

$url = $_GET["url"] ?? "";

if (!$url) {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "error" => "URL parameter is required"
    ]);
    exit;
}

if (!filter_var($url, FILTER_VALIDATE_URL)) {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "error" => "Invalid URL"
    ]);
    exit;
}

$ch = curl_init($url);

curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_HTTPGET => true,
    CURLOPT_TIMEOUT => 15,
    CURLOPT_CONNECTTIMEOUT => 10,
    CURLOPT_SSL_VERIFYPEER => true,
    CURLOPT_SSL_VERIFYHOST => 2,
    CURLOPT_USERAGENT => "Mozilla/5.0"
]);

curl_exec($ch);

$error = curl_error($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$finalUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);

curl_close($ch);

if ($error) {
    http_response_code(500);

    echo json_encode([
        "success" => false,
        "error" => $error
    ]);
    exit;
}

http_response_code(200);

echo json_encode([
    "success" => true,
    "original_url" => $url,
    "final_url" => $finalUrl,
    "http_code" => $httpCode
], JSON_PRETTY_PRINT);
