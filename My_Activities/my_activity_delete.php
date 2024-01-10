<?php
include("../config.php");
include('../message.php');
//this action is called when the Delete link is clicked
if (isset($_GET["id"]) && $_GET["id"] != "") {
    $id = $_GET["id"];
    $sql = "DELETE FROM activity WHERE av_id=" . $id;

    if (mysqli_query($conn, $sql)) {
        messageBox("Record deleted successfully!", "my_activities.php");
        header("refresh:2;URL=my_activities.php");
    } else {
        messageBox("Error deleting record: " . mysqli_error($conn));
        header("refresh:2;URL=my_activities.php");
    }
}
mysqli_close($conn);
