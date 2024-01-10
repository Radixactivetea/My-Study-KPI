<?php
session_start();
include('../config.php');
include('../message.php');

$target_dir = "../Uploads/";
$target_file = "";
$uploadOk = 0;
$imageFileType = "";
$uploadfileName = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $program = $_POST["program"];
    $mentor = $_POST["mentor"];
    $aboutMe = $_POST["aboutMe"];
    $motto = $_POST["motto"];
    $batch = $_POST["batch"];

    $filetmp = $_FILES["fileToUpload"];
    $uploadfileName = $filetmp["name"];

    if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["name"] == "") {
        $sql = "UPDATE profile SET username='$username', program='$program', 
            mentor='$mentor', aboutMe='$aboutMe', motto='$motto', batch='$batch' WHERE userID=" . $_SESSION["UID"];

        $result = mysqli_query($conn, $sql);
        if ($result) {
            messageBox("Data updated successfully!");
            header("refresh:2;URL=profile.php");
        } else {
            messageBox("WARNING :: Data not updated! There is something wrong");
            header("refresh:2;URL=profile.php");
        }
    } else if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == UPLOAD_ERR_OK) {
        $uploadOk = 1;
        $filetmp = $_FILES["fileToUpload"];
        $uploadfileName = $filetmp["name"];
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {
            $message = "ERROR: Sorry, image file $uploadfileName already exists.<br>";
            messageBox($message);
            $uploadOk = 0;
        }
        if ($_FILES["fileToUpload"]["size"] > 5000000) {
            $message =  "ERROR: Sorry, your file is too large. Try resizing your image.<br>";
            messageBox($message);
            $uploadOk = 0;
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $message =  "ERROR: Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
            messageBox($message);
            $uploadOk = 0;
        }

        if ($uploadOk) {
            $sql = "UPDATE profile SET username='$username', program='$program', 
            mentor='$mentor', aboutMe='$aboutMe', motto='$motto', batch='$batch', img_path = '$uploadfileName'
            WHERE userID = " . $_SESSION["UID"];

            $result = mysqli_query($conn, $sql);

            if ($result) {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    messageBox("Form data updated successfully!<br>");
                    header("refresh:2;URL=profile.php");
                } else {
                    messageBox("Sorry, there was an error uploading your file.<br>");
                    header("refresh:2;URL=profile.php");
                }
            }
        } else {
            header("refresh:2;URL=profile.php");
        }
    } else {
        header("refresh:2;URL=profile.php");
    }
}
mysqli_close($conn);
