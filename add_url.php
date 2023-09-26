<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['url'])) { 
    $url = $_POST['url'];

    if (!empty($url)) {
        $jsonFile = 'urls.json';
        $urls = [];

        if (file_exists($jsonFile)) {
            $urls = json_decode(file_get_contents($jsonFile), true);
        }

        if (!urlExists($urls, $url)) {
            $id = uniqid();
            $status = checkUrl($url);
            $urls[$id] = ['url' => $url, 'status' => $status];
            saveUrls($jsonFile, $urls);
        }
    }
}
}

function urlExists($urls, $url) {
    foreach ($urls as $urlData) {
        if ($urlData['url'] === $url) {
            return true;
        }
    }
    return false;
}


function checkUrl($url) {
    $response = @file_get_contents($url);

    if ($response !== FALSE) {
        return 'active';
    } else {
        return 'not active';
    }
}


function saveUrls($jsonFile, $urls) {
    file_put_contents($jsonFile, json_encode($urls));
}

// Ana sayfaya yönlendir
header("Location: index.php");
?>
