<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // URL'yi JSON dosyasından sil
    $urls = json_decode(file_get_contents('urls.json'), true);

    if (isset($urls[$id])) {
        unset($urls[$id]);
        file_put_contents('urls.json', json_encode($urls));
    }
}

header('Location: index.php');
?>
