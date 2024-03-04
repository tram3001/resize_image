<?php
  if(isset($_POST['submit']) )
  { 
    $uploadDir = 'C:/Uploads/'; 
    if (!file_exists( $uploadDir)) { 
      mkdir( $uploadDir, 0777, true); 
    } 
    foreach ($_FILES["images"]["tmp_name"] as $key => $tmpName) {
      $originalName = $_FILES["images"]["name"][$key];
      $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
          // Validate file extension (you can add more extensions if needed)
      if (!in_array($extension, ["jpg", "jpeg", "png", "gif"])) {
          echo "Invalid image extension: $originalName";
          continue;
      }
      list($width, $height) = getimagesize($tmpName);
      $newWidth = 800;
      $newHeight =600;
      $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
      // Load the original image
      if($extension=='png'){
        $sourceImage=imagecreatefrompng($tmpName);
      }else{
        $sourceImage = imagecreatefromjpeg($tmpName);
      }
       // Change to imagecreatefrompng for PNG images
      // Resize the image
      imagecopyresampled($resizedImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
      // Save the resized image
      $newFilename = $uploadDir . uniqid() . "." .'jpg';
      imagejpeg($resizedImage, $newFilename, 90); 
     
    }
  }
?>