<?PHP
include('../config.php');
include('../message.php');
//this action is called when the Delete link is clicked
if (isset($_GET["id"]) && $_GET["id"] != "") {
    $id = $_GET["id"];
    $sql = "DELETE FROM challenge WHERE ch_id=" . $id;
    if (mysqli_query($conn, $sql)) {
        messageBox("Record deleted successfully<br>");
        header("refresh:2;URL=my_challenge.php");
    } else {
        $message("Error deleting record: " . mysqli_error($conn) . "<br>");
        messageBox($message);
        header("refresh:2;URL=my_challenge.php");
    }
}
mysqli_close($conn);
