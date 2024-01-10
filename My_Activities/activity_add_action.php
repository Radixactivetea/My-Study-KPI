<?php
session_start();
include('../config.php');
include('../message.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sem = $_POST["sem"];
    $year = $_POST["year"];
    $activity = trim($_POST["activity"]);
    $level = $_POST["level"];
    $remark = trim($_POST["remark"]);

    $sql = "INSERT INTO activity (`userID`, `sem`, `year`, `activity`, `level`, `remark`) 
        VALUES('" . $_SESSION["UID"] . "','" . $sem . "','" . $year . "','" . $activity . "','" . $level . "','" . $remark . "')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        messageBox("Form data saved successfully!");
        header("refresh:2;URL=my_activities.php");
    } else {
        messageBox("WARNING :: Form data not saved successfully!");
        header("refresh:2;URL=my_activities.php");
    }
}
mysqli_close($conn);
