<?php 
// phpinfo();
try {
    $test = new PDO ("dblib:host=10.0.8.19:1433;dbname=apbd_2019_30m", "bappeda", "Bapeda321");

   

} catch (PDOException $e) {
    echo "Failed to get DB handle: " . $e->getMessage() . "\n";
}