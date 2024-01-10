<?php
include('../config.php');
include('../message.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userMatric = mysqli_real_escape_string($conn, $_POST['matricNo']);
    $userEmail = mysqli_real_escape_string($conn, $_POST['userEmail']);
    $userPwd = mysqli_real_escape_string($conn, $_POST['userPwd']);
    $confirmPwd = mysqli_real_escape_string($conn, $_POST['confirmPwd']);

    if ($userPwd !== $confirmPwd) {
        messageBox("Password and confirm password do not match.");
        header("refresh:3;URL=../index.php");
    }

    $sql = "SELECT * FROM user WHERE userEmail='$userEmail' or matricNo='$userMatric' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        messageBox("User exists. Please register as a new user");
        header("refresh:3;URL=../index.php");
    } else {
        $pwdHash = trim(password_hash($_POST['userPwd'], PASSWORD_DEFAULT));

        $sql = "INSERT INTO user (matricNo, userEmail, userPwd ) VALUES ('$userMatric', '$userEmail', '$pwdHash')";

        if (mysqli_query($conn, $sql)) {
            messageBox("<p>New user record created successfully.</p>");
            $lastInsertedId = mysqli_insert_id($conn);
            $sql = "INSERT INTO profile (userID, username, program, mentor, motto ) VALUES ('$lastInsertedId', '','', '','')";

            if (mysqli_query($conn, $sql)) {
                $SuccessMessage = "Congratulations " . $userMatric . "! You have successfully registered. Please log in to access your account.";
                messageBox($SuccessMessage);
                header("refresh:3;URL=../index.php");
            } else {
                $errorMessage = "Error: " . $sql . "<br>" . mysqli_error($conn);
                messageBox($errorMessage);
                header("refresh:3;URL=../index.php");
            }
        } else {
            $errorMessage = "Error: " . $sql . "<br>" . mysqli_error($conn);
            messageBox($errorMessage);
            header("refresh:3;URL=../index.php");
        }
    }
}
mysqli_close($conn);
