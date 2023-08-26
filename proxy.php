<?php
$apiUrl = 'https://api.escuelajs.co/api/v1/products';
$response = file_get_contents($apiUrl);
echo $response;
?>

