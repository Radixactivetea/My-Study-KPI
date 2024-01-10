<?php
session_start();
$_SESSION["UID"] = NULL;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Study KPI</title>
    <meta name="viewport" content="width=device-width,  initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/mainStyle.css">
    <link rel="stylesheet" href="css/formStyle.css">
    <link rel="stylesheet" href="css/flip-card.css">
    
    <style>
        img {
            width: 270px;
            height: 70px;
            margin-bottom: 10px;
        }

        .flex {
            flex-direction: column;
            translate: 0px 35%;
        }

    </style>
</head>

<body>
    <div class="flex">
        <img src="img/Logo.png" alt="Your Logo">
        <div class="flip">
            <div class="flip-inner">
                <div id="login" class="flip-front">
                    <form action="Profile/login_action.php" id="LoginID" method="post">
                        <div>
                            <input type="username" placeholder="Username" name="userName" required />
                        </div>
                        <div>
                            <input type="password" placeholder="Password" name="userPwd" required />
                        </div>
                        <div>
                            <button class="btn" type="submit">Log in</button>
                        </div>
                        <span class="psw">
                            <br>
                            <a onclick="toggleFlip()" style="cursor: pointer;"> Register</a> |
                            <a style="cursor: pointer;">Forgot password?</a>
                        </span>
                    </form>
                </div>
                <div id="register" class="flip-back">
                    <form action="Profile/register_action.php" method="post">
                        <input type="username" placeholder="Matric Number" id="matricNo" name="matricNo" required />
                        <input type="email" placeholder="Email" id="userEmail" name="userEmail" required />
                        <input type="password" placeholder="Password" id="userPwd" name="userPwd" required />
                        <input type="password" placeholder="Confirm Password" id="confirmPwd" name="confirmPwd" required />
                        <div style="display: flex; ">
                            <button class="btn" type="submit">Register</button>
                            <button class="btn" type="button" onclick="toggleFlip()">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</body>
<script>
    function toggleFlip() {
        document.querySelector('.flip').classList.toggle('is-flipped');
    }
</script>

</html>