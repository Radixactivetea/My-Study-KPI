<?php
include("../config.php");
include('../message.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["aid"];
    $sem = $_POST["sem"];
    $year = $_POST["year"];
    $activity = trim($_POST["activity"]);
    $level = $_POST["level"];
    $remark = trim($_POST["remark"]);

    $sql = "UPDATE `activity` SET `sem`='$sem',`year`='$year',
        `activity`='$activity',`level`='$level',
        `remark`='$remark' WHERE av_id=" . $id;
    $result = mysqli_query($conn, $sql);

    if ($result) {
        messageBox("Successfully Updated!", "my_activities.php");
        header("refresh:2;URL=my_activities.php");
    } else {
        messageBox("WARNING :: Data not Updated!", "my_activities.php");
        header("refresh:2;URL=my_activities.php");
    }
}
mysqli_close($conn);
