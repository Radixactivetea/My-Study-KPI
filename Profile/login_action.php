
<?php
session_start();
include("../config.php");
include('../message.php');


//login values from login form
$userName = $_POST['userName'];
$userPwd = $_POST['userPwd'];

$sql = "SELECT * FROM user WHERE matricNo='$userName' LIMIT 1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    //check password hash
    $row = mysqli_fetch_assoc($result);
    if (password_verify($_POST['userPwd'], $row['userPwd'])) {
        $_SESSION["UID"] = $row["userID"]; //the first record set, bind to userID
        $_SESSION["userName"] = $row["matricNo"];
        //set logged in time
        $_SESSION['loggedin_time'] = time();
        messageBox("WELCOME to My Study KPI");
        header("refresh:2;URL=profile.php");
    } else {
        messageBox("WARNING :: Username and Password didn't match!\n Try Again");
        header("refresh:3;URL=../index.php");
    }
} else {
    messageBox("WARNING :: Username doesn't exist! \n Please register");
    header("refresh:3;URL=../index.php");
}

mysqli_close($conn);
?>