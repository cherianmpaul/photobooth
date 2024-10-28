<?php
  //Save webcam image to png file
  $targetDir = 'uploads/';
  $unique_id = substr(time(), -4) . '__';
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $imageData = $_POST['image'];
    $file = $targetDir . $unique_id . $_POST['name'] . '.png'; // set filename
    $uri = substr($imageData, strpos($imageData, ',') + 1); // remove "data:image/png;base64," prefix
    $decodedData = base64_decode($uri);
    file_put_contents($file, $decodedData);
    echo $file; // return the filename
  }
  
?>
