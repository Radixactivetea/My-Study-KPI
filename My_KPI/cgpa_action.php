<?php
session_start();
include('../config.php');
include('../message.php');

$sql = "SELECT * FROM cgpa WHERE userID=" . $_SESSION["UID"] . " LIMIT 1";
$result = mysqli_query($conn, $sql);

$sem1year1 = $_POST["sem1year1"];
$sem2year1 = $_POST["sem2year1"];
$sem1year2 = $_POST["sem1year2"];
$sem2year2 = $_POST["sem2year2"];
$sem1year3 = $_POST["sem1year3"];
$sem2year3 = $_POST["sem2year3"];
$sem1year4 = $_POST["sem1year4"];
$sem2year4 = $_POST["sem2year4"];

if (mysqli_num_rows($result) == 1) {

    $sql = "UPDATE cgpa SET 
    sem1year1 = '$sem1year1',
    sem2year1 = '$sem2year1',
    sem1year2 = '$sem1year2',
    sem2year2 = '$sem2year2',
    sem1year3 = '$sem1year3',
    sem2year3 = '$sem2year3',
    sem1year4 = '$sem1year4',
    sem2year4 = '$sem2year4'
    WHERE userID =" . $_SESSION["UID"];


    $result = mysqli_query($conn, $sql);

    if ($result) {
        messageBox("Form data saved successfully!");
        header("refresh:2;URL=my_kpi.php");
    } else {
        messageBox("WARNING :: Form data not saved successfully!");
        header("refresh:2;URL=my_kpi.php");
    }
} else {
    $sql = "INSERT INTO cgpa (`userID`, `sem1year1`, 
    `sem2year1`, `sem1year2`, `sem2year2`, `sem1year3`, 
    `sem2year3`, `sem1year4`, `sem2year4`) 
    VALUES('" . $_SESSION["UID"] . "',
    '" . $sem1year1 . "','" . $sem2year1 . "',
    '" . $sem1year2 . "','" . $sem2year2 . "',
    '" . $sem1year3 . "','" . $sem2year3 . "'
    ,'" . $sem1year4 . "','" . $sem2year4 . "'
    )";


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
