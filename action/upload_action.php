<?php
//  echo "<pre>";
//  print_r($_FILES);

include_once "conn.php";

$imageName = $_FILES['image']['name'];
$imageSize = $_FILES['image']['size'];
$imageTmpName = $_FILES['image']['tmp_name'];
$imageError = $_FILES['image']['error'];
$imageType = $_FILES['image']['type'];

if ($imageError === 0) {
    // echo "Image Uploaded Successfully";
                     
    if ($imageSize <= 5000000) {

        $imageExt = pathinfo($imageName, PATHINFO_EXTENSION);

        $allowedExt = ['jpg','png','jpeg','webp'];

       

    if(in_array(strtolower($imageExt), $allowedExt)){
            $newImageName = uniqid('000-').".".$imageExt;
            echo $newImageName .  "<br>";
            
        }




    }else {
        $msg = "Image Size is Not OK";
        header("location:../index.php?msg=$msg");
    }
} else {

    $msg = "Error Occured While Uploading Image";
    header("location:../index.php?msg=$msg");
}
