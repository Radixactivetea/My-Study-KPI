<?php
include('../config.php');
include('../message.php');

//variables
$action = "";
$id = "";
$sem = "";
$year = "";
$challenge = " ";
$remark = "";

//for upload
$target_dir = "uploads/";
$target_file = "";
$uploadOk = 0;
$imageFileType = "";
$uploadfileName = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //values for add or edit
    $id = $_POST["cid"];
    $sem = $_POST["sem"];
    $year = $_POST["year"];
    $challenge = trim($_POST["challenge"]);
    $plan = trim($_POST["plan"]);
    $remark = trim($_POST["remark"]);

    $filetmp = $_FILES["fileToUpload"];
    //file of the image/photo file
    $uploadfileName = $filetmp["name"];

    //Check if there is an image to be uploaded
    //IF no image
    if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["name"] == "") {
        $sql = "UPDATE challenge SET sem= $sem, year ='$year', challenge = '$challenge', plan = '$plan', remark = '$remark' , img_path = '$uploadfileName'
            WHERE ch_id = " . $id;

        $status = update_DBTable($conn, $sql);

        if ($status) {
            messageBox("Form data updated successfully!<br>");
            header("refresh:2;URL=my_challenge.php");
        } else {
            header("refresh:2;URL=my_challenge.php");
        }
    } else if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == UPLOAD_ERR_OK) {
        $uploadOk = 1;
        $filetmp = $_FILES["fileToUpload"];
        $uploadfileName = $filetmp["name"];
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {
            $message = "ERROR: Sorry, image file $uploadfileName already exists.";
            messageBox($message);
            $uploadOk = 0;
        }
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            $message = "ERROR: Sorry, your file is too large. Try resizing your image.";
            messageBox($message);
            $uploadOk = 0;
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $message = "ERROR: Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            messageBox($message);
            $uploadOk = 0;
        }

        if ($uploadOk) {
            $sql = "UPDATE challenge SET sem= $sem, year ='$year', challenge = '$challenge',
                plan = '$plan', remark = '$remark' , img_path = '$uploadfileName'
                WHERE ch_id = " . $id;

            $status = update_DBTable($conn, $sql);

            if ($status) {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    messageBox("Form data saved successfully!");
                    header("refresh:2;URL=profile.php");
                } else {
                    messageBox("Sorry, there was an error uploading your file.<br>");
                    header("refresh:2;URL=my_challenge.php");
                }
            }
        } else {
            header("refresh:2;URL=my_challenge.php");
        }
    } else {
        header("refresh:2;URL=my_challenge.php");
    }
}

//close db connection
mysqli_close($conn);
//Function to insert data to database table
function update_DBTable($conn, $sql)
{
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "Error: " . $sql . " : " . mysqli_error($conn) . "<br>";
        return false;
    }
}
