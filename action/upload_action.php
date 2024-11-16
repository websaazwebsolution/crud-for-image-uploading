<?php
//  echo "<pre>";
//  print_r($_FILES);

include_once "conn.php";

$imageName = $_FILES['image']['name'];
$imageSize = $_FILES['image']['size'];
$imageTmpName = $_FILES['image']['tmp_name'];
$imageError = $_FILES['image']['error'];
$imageType = $_FILES['image']['type'];

$name = $_POST['username'];
$email = $_POST['email'];


if ($imageError === 0) {
    // echo "Image Uploaded Successfully";
                     
    if ($imageSize <= 5000000) {

        $imageExt = pathinfo($imageName, PATHINFO_EXTENSION);

        $allowedExt = ['jpg','png','jpeg','webp'];

       

    if(in_array(strtolower($imageExt), $allowedExt)){

            $newImageName = uniqid('000-').".". strtolower($imageExt);
            // echo $newImageName .  "<br>";

            $imageuploadPath = "../images/";
             
            if(move_uploaded_file($imageTmpName, $imageuploadPath . $newImageName)){

                    $sql = "INSERT INTO guest(guest_name, guest_email, guest_image) values(?,?,?) ";
                    $stmt= $conn->prepare($sql);
                    $stmt->bind_param("sss", $name, $email, $newImageName);
                    if($stmt->execute()){
                        $successMsg = "Guest Added Successfully";
                        header("location:../index.php?successMsg=$successMsg");
                    }else{
                        $msg = "Failed to Add Guest";
                        header("location:../index.php?msg=$msg");
                    }
            }


            echo $imageuploadPath .  "<br>";
            
        }else{
            $msg =  "Invalid Image Type";
            header("location:../index.php?msg=$msg");
        }




    }else {
        $msg = "Image Size is Not OK";
        header("location:../index.php?msg=$msg");
    }
} else {

    $msg = "Error Occured While Uploading Image";
    header("location:../index.php?msg=$msg");
}
