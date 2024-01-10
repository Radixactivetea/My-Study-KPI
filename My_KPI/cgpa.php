<?php
include('../config.php');

$sql = "SELECT * FROM cgpa WHERE userID=" . $_SESSION["UID"];
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $sem1year1 = $row["sem1year1"];
    $sem2year1 = $row["sem2year1"];
    $sem1year2 = $row["sem1year2"];
    $sem2year2 = $row["sem2year2"];
    $sem1year3 = $row["sem1year3"];
    $sem2year3 = $row["sem2year3"];
    $sem1year4 = $row["sem1year4"];
    $sem2year4 = $row["sem2year4"];
}
