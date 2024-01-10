<?php
session_start();
include('../config.php');
include('../message.php');

$sql = "SELECT * FROM kpiindicator WHERE userID=" . $_SESSION["UID"] . " LIMIT 1";
$result = mysqli_query($conn, $sql);

$cgpa_myself = $_POST["cgpa_myself"];
$avfaculty_myself = $_POST["avfaculty_myself"];
$avuni_myself = $_POST["avuni_myself"];
$avnation_myself = $_POST["avnation_myself"];
$avinter_myself = $_POST["avinter_myself"];

if (mysqli_num_rows($result) == 1) {

    $sql = "UPDATE kpiindicator SET 
    cgpa_myself = '$cgpa_myself',
    avfaculty_myself = '$avfaculty_myself',
    avuni_myself = '$avuni_myself',
    avnation_myself = '$avnation_myself',
    avinter_myself = '$avinter_myself'
    WHERE userID =". $_SESSION["UID"];


    $result = mysqli_query($conn, $sql);

    if ($result) {
        messageBox("Form data saved successfully!");
        header("refresh:2;URL=my_kpi.php");
    } else {
        messageBox("WARNING :: Form data not saved successfully!");
        header("refresh:2;URL=my_kpi.php");
    }
} else {
    $sql = "INSERT INTO kpiindicator (`userID`, `cgpa_myself`, 
    `avfaculty_myself`, `avuni_myself`, `avnation_myself`, `avinter_myself`) 
    VALUES('" . $_SESSION["UID"] . "','" . $cgpa_myself . "',
    '" . $avfaculty_myself . "','" . $avuni_myself . "',
    '" . $avnation_myself . "','" . $avinter_myself . "')";


    $result = mysqli_query($conn, $sql);

    if ($result) {
        messageBox("Form data saved successfully!");
        header("refresh:2;URL=my_kpi.php");
    } else {
        messageBox("WARNING :: Form data not saved successfully!");
        header("refresh:2;URL=my_kpi.php");
    }
}
mysqli_close($conn);
