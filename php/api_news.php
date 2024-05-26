<?php
require_once 'load_env.php';

function fetch_news($url, $apiKey, $query)
{
    $params = [
        'q' => $query,
        'apiKey' => $apiKey
    ];
    $fullUrl = $url . '/everything?' . http_build_query($params);

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $fullUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 1); // Include the header in the output
    curl_setopt($ch, CURLOPT_VERBOSE, 1); // Output verbose information
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // Follow redirects
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'User-Agent: YourAppName/1.0'
    ));

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Separate headers and body
    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $header = substr($response, 0, $header_size);
    $body = substr($response, $header_size);

    // echo "HTTP Status Code: $httpCode\n";
    // echo "Response Header: $header\n";
    // echo "Response Body: $body\n";

    return json_decode($body, true);
}

$newsApiUrl = getenv('NEWS_API_URL');
$newsApiKey = getenv('NEWS_API_KEY');
$query = getenv('NEWS_API_QUERY');

if (!$newsApiUrl || !$newsApiKey || !$query) {
    echo 'One or more environment variables are not set.';
    exit;
}

$newsData = fetch_news($newsApiUrl, $newsApiKey, $query);

// echo '<pre>';
// var_dump($newsData);
// echo '</pre>';
?>
