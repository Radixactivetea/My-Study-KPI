<?php
include('../config.php');

$sql = "SELECT * FROM kpiindicator WHERE userID=" . $_SESSION["UID"];
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

    $row = mysqli_fetch_assoc($result);

    $cgpa_myself = $row["cgpa_myself"];
    $avfaculty_myself = $row["avfaculty_myself"];
    $avuni_myself = $row["avuni_myself"];
    $avnation_myself = $row["avnation_myself"];
    $avinter_myself = $row["avinter_myself"];
}
