<?php
require_once 'load_env.php';

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
$query = $_GET['search'] ?? 'software';
$page = $_GET['page'] ?? 1;

$newsData = fetch_news($newsApiUrl, $newsApiKey, $query, $page);

if ($newsData === null) {
    echo '
    <div class="auto-container">
        <p>No news available at the moment.</p>
    </div>';
    exit;
}

// var_dump($newsData);

?>
