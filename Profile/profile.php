<?php
session_start();
include('../config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Study KPI</title>
    <meta name="viewport" content="width=device-width,  initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/formstyle.css">
    <link rel="stylesheet" href="../css/mainStyle.css">
    <link rel="stylesheet" href="../css/profilepic.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://kit.fontawesome.com/9aa99ba8cc.js" crossorigin="anonymous"></script>

    <style>
        .flex {
            flex-direction: column;
            margin-bottom: 10px;
        }

        #editprofile {
            display: none;
            align-items: center;
            justify-content: center;
        }

        .container p {
            background-color: #e4ebf5;
            padding: 20px;
            border-radius: 6px;
            border: none;
        }

        form .flex {
            display: flex;
            flex-direction: row;
            width: 1000px;
        }

        input {
            margin-left: 15px;
            margin-right: 15px;
            width: 100%;
        }
    </style>
</head>

<body>
    <?php
    if(!isset($_SESSION["UID"])){
        header("location:../index.php");
    }
    include('../menu.php');

    $matricNo = "";
    $userEmail = "";
    $username = "";
    $program = "";
    $mentor = "";
    $motto = "";
    $aboutMe = "";
    $img_path = "avatar.png";
    $batch = "";

    $sql = "SELECT * FROM profile INNER JOIN user ON profile.id = user.userID WHERE profile.id =" . $_SESSION["UID"];
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $username = htmlspecialchars($row["username"], ENT_QUOTES, 'UTF-8');
        $matricNo = $row["matricNo"];
        $userEmail = $row["userEmail"];
        $program = $row["program"];
        $mentor = $row["mentor"];
        $aboutMe = $row["aboutMe"];
        $motto = $row["motto"];
        if ($row["img_path"] != "") {
            $img_path = $row["img_path"];
        }
        $batch = $row["batch"];
    }
    ?>

    <div id="banner-container" style="background-image: url('../img/banner.png');">
        <img id="profile-pic" src="../uploads/<?= $img_path ?>" alt="Profile Picture">
    </div>
    <div class="flex">
        <h1><?= $username ?></h1>
        <button onClick="showEdit()">Edit Profile</button>
    </div>
    <div class="container" id="profile">
        <div class="left-section" id="box" style="line-height: 0.4;">
            <h3>Matric No.</h3>
            <p><?= $matricNo ?></p>
            <h3>Email</h3>
            <p><?= $userEmail ?></p>
            <h3>Program</h3>
            <p><?= $program ?></p>
            <h3>Mentor Name</h3>
            <p><?= $mentor ?></p>
        </div>
        <div class="right-section" id="box">
            <h3>About Me</h3>
            <p><?= $aboutMe ?></p>
            <h3>My Motto</h3>
            <p><?= $motto ?></p>
            <h3>Year Batch</h3>
            <p><?= $batch ?></p>
        </div>
    </div>
    <div id="editprofile">
        <form action="profile_action.php" method="post" enctype="multipart/form-data">
            <div class="flex">
                <input type="username" placeholder="Username" id="username" name="username" value='<?= $username ?>'>
                <input type="text" placeholder="Program" id="program" name="program" value='<?= $program ?>'>
            </div>
            <div class="flex">
                <input type="text" placeholder="Mentor Name" id="mentor" name="mentor" value='<?= $mentor ?>'>
                <input type="text" placeholder="Batch" id="batch" name="batch" value='<?= $batch ?>'>
            </div>
            <input type="text" style="width: 95%;" placeholder="About Me" id="aboutMe" name="aboutMe" value='<?= $aboutMe ?>'>
            <input type="text" style="width: 95%;" placeholder="Motto" id="motto" name="motto" value='<?= $motto ?>'>
            Max size: 488.28KB<br>
            <input style="width: 250px;" type="file" name="fileToUpload" id="fileToUpload" accept=".jpg, .jpeg, .png">
            <div>
                <button class="btn" type="submit">Edit</button>
                <button class="btn" type="reset" onClick="cancelEdit()">Cancel</button>
            </div>
        </form>
    </div>
    <footer>
        <p>Copyright (c) 2023 - <a href="https://www.instagram.com/sirajddn._/" style="color: rgb(3, 0, 85); text-decoration: none;">@Sirajddn</a></p>
    </footer>
</body>
<script>
    function showEdit() {
        var x = document.getElementById("editprofile");
        x.style.display = 'flex';
        var x = document.getElementById("profile");
        x.style.display = 'none';
    }

    function cancelEdit() {
        var x = document.getElementById("editprofile");
        x.style.display = 'none';
        var x = document.getElementById("profile");
        x.style.display = 'flex';
    }

    function myFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
    }
</script>

</html>