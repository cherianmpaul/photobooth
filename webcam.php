<?php
  //Save webcam image to png file
  $targetDir = 'uploads/';
  $unique_id = '__' . substr(time(), -4);
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $imageData = $_POST['image'];
    $file = $targetDir . $_POST['name'] . $unique_id . '.png'; // set filename
    $uri = substr($imageData, strpos($imageData, ',') + 1); // remove "data:image/png;base64," prefix
    $decodedData = base64_decode($uri);
    file_put_contents($file, $decodedData);
    echo $file; // return the filename
  }
  
?>
