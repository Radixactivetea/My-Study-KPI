<?php
session_start();
include('../config.php');
include('../message.php');

$action = "";
$id = "";
$sem = "";
$year = "";
$challenge = " ";
$remark = "";

$target_dir = "../uploads/";
$target_file = "";
$uploadOk = 0;
$imageFileType = "";
$uploadfileName = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sem = $_POST["sem"];
    $year = $_POST["year"];
    $challenge = trim($_POST["challenge"]);
    $plan = trim($_POST["plan"]);
    $remark = trim($_POST["remark"]);

    $filetmp = $_FILES["fileToUpload"];
    //file of the image/photo file
    $uploadfileName = $filetmp["name"];

    if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["name"] == "") {
        $sql = "INSERT INTO challenge (`userID`, `sem`, `year`, `challenge`, `plan`, `remark`)
            VALUES ('" . $_SESSION["UID"] . "','" . $sem . "','" . $year . "','" . $challenge . "','" . $plan . "','" . $remark . "')";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            messageBox("Form data saved successfully!");
            header("refresh:2;URL=my_challenge.php");
        } else {
            messageBox("WARNING :: Form data not saved successfully!");
            header("refresh:2;URL=my_challenge.php");
        }
    } //IF there is image
    else if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == UPLOAD_ERR_OK) {
        //Variable to determine for image upload is OK
        $uploadOk = 1;
        $filetmp = $_FILES["fileToUpload"];
        //file of the image/photo file
        $uploadfileName = $filetmp["name"];

        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {
            $message = "ERROR: Sorry, image file $uploadfileName already exists.";
            messageBox($message);
            $uploadOk = 0;
        }

        // Check file size <= 488.28KB or 500000 bytes
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            $message = "ERROR: Sorry, your file is too large. Try resizing your image.";
            messageBox($message);
            $uploadOk = 0;
        }

        // Allow only these file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $message = "ERROR: Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            messageBox($message);
            $uploadOk = 0;
        }

        //If uploadOk, then try add to database first
        //uploadOK=1 if there is image to be uploaded, filename not exists, file size is ok and format ok 

        if ($uploadOk) {
            $sql = "INSERT INTO challenge (userID, sem, year, challenge, plan, remark, img_path)
                VALUES ('" . $_SESSION["UID"] . "', '" . $sem . "', '" . $year . "', '" . $challenge . "','" . $plan . "', '" . $remark . "', '" . $uploadfileName . "')";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    //Image file successfully uploaded
                    //Tell successfull record
                    messageBox("Form data saved successfully!");
                    header("refresh:2;URL=profile.php");
                } else {
                    //There is an error while uploading image
                    messageBox("Sorry, there was an error uploading your file.<br>");
                    header("refresh:2;URL=my_challenge.php");
                }
            } else {
                header("refresh:2;URL=my_challenge.php");
            }
        } else {
            header("refresh:2;URL=my_challenge.php");
        }
    }
}
mysqli_close($conn);
