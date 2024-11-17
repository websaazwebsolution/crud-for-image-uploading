<?php 
include_once 'conn.php';

// print_r($_POST);


// echo $id = $_GET['id'];

// $sql = "DELETE FROM guest WHERE guest_id = $id";
// $result = $conn->query($sql);
// header("location:../index.php");

$id = $_POST['id'];
$image = $_POST['image'];

// $image_path = "../images/". $image;
// echo $image_path;

$sql = "DELETE FROM guest WHERE guest_id = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    
    $image_path = "../images/". $image;
    
    if(file_exists($image_path)){
        unlink($image_path);

    }

    $successMsg = "Guest Deleted Successfully";
    header("location:../index.php?successMsg=$successMsg");
}else{
    $msg = "Failed to Delete Guest";
    header("location:../index.php?msg=$msg");
}

?>