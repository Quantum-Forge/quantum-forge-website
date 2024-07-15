<?php
require_once 'load_env.php';

// Menonaktifkan penampilan error
error_reporting(0);
ini_set('display_errors', 0);

function fetch_news($url, $apiKey, $query = '', $page = 1, $pageSize = 5)
{
    $params = [
        'q' => $query,
        'apiKey' => $apiKey,
        'page' => $page,
        'pageSize' => $pageSize,
    ];

   

    $fullUrl = $url . '?' . http_build_query($params);

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $fullUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'User-Agent: PHP-cURL'
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode == 200) {
        return json_decode($response, true);
    } else {
        return null;
    }
}

$newsApiUrl = getenv('NEWS_API_URL');
$newsApiKey = getenv('NEWS_API_KEY');
$query = $_GET['search'] ?? 'UMKM Indonesia';
$page = $_GET['page'] ?? 1;

$newsData = fetch_news($newsApiUrl, $newsApiKey, $query, $page);
// var_dump($newsData);

?>
