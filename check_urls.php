<?php
session_start();

if (isset($_POST['checkUrls'])) {
    $jsonFile = 'urls.json';
    $urls = [];

    if (file_exists($jsonFile)) {
        $urls = json_decode(file_get_contents($jsonFile), true);
    }

    checkAllUrls($urls);


    saveUrls($jsonFile, $urls);
}


function checkUrl($url) {

    $response = @file_get_contents($url);

    if ($response !== FALSE) {

        if (strpos($response, 'success') !== false) {
            return 'active';
        } else {
            return 'deactive';
        }
    } else {
        return 'not active';
    }
}


function saveUrls($jsonFile, $urls) {
    file_put_contents($jsonFile, json_encode($urls));
}


function checkAllUrls(&$urls) {
    foreach ($urls as $id => &$urlData) {
        $urlData['status'] = checkUrl($urlData['url']);
    }
}


header("Location: index.php");
?>
