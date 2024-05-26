<?php
require_once 'load_env.php';

function fetch_news($url, $apiKey, $query)
{
    $params = [
        'q' => $query,
        'apiKey' => $apiKey
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
$query = getenv('NEWS_API_QUERY');

$newsData = fetch_news($newsApiUrl, $newsApiKey, $query);

if ($newsData === null) {
    echo "Error fetching news data";
    var_dump($httpCode);
    exit;
}

// var_dump($newsData);
?>
