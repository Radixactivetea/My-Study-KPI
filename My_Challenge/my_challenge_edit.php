<?php
session_start();
include('../config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>KPI Idicator</title>
    <meta name="viewport" content="width=device-width,  initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/mainStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://kit.fontawesome.com/9aa99ba8cc.js" crossorigin="anonymous"></script>

    <style>
        header {
            text-align: center;
            margin-top: 150px;
        }

        .flex {
            justify-content: center;
        }

        #challengeAdd {
            margin-top: 10px;
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>
    <main>
        <?php
        include('../menu.php');

        $id = "";
        $sem = "";
        $year = "";
        $challenge = "";
        $plan = "";
        $remark = "";
        $img = "";

        if (isset($_GET["id"]) && $_GET["id"] != "") {
            $sql = "SELECT * FROM challenge WHERE ch_id=" . $_GET["id"];
            //echo $sql . "<br>";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            if (mysqli_num_rows($result) > 0) {
                $id = $row["ch_id"];
                $sem = $row["sem"];
                $year = $row["year"];
                $challenge = $row["challenge"];
                $plan = $row["plan"];
                $remark = $row["remark"];
                $img = $row["img_path"];
            }
        }
        mysqli_close($conn);
        ?>
        <header>
            <h1>Edit Your Challenge</h1>
        </header>
        <div id="challengeAdd">
            <form action="challenge_edit_action.php" method="POST" enctype="multipart/form-data" id="myForm">
                <input type="text" id="cid" name="cid" value="<?= $_GET['id'] ?>" hidden>
                <table style="width: 500px;">
                    <tr>
                        <td>Semester</td>
                        <td>
                            <select size="1" name="sem" required>
                                <option value="">&nbsp;</option>
                                <?php
                                if ($sem == "1")
                                    echo '<option value="1" selected>1</option>';
                                else
                                    echo '<option value="1">1</option>';
                                if ($sem == "2")
                                    echo '<option value="2" selected>2</option>';
                                else
                                    echo '<option value="2">2</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Year</td>
                        <td>
                            <?php
                            if ($year != "") {
                                echo '<input type="text" name="year" size="5" value="' . $year . '" required>';
                            } else {
                                echo '<input type="text" name="year" size="5" required>';
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Challenge</td>
                        <td>
                            <textarea rows="4" name="challenge" cols="20" required><?= $challenge ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Plan</td>
                        <td>
                            <textarea rows="4" name="plan" cols="20" required><?= $plan ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Remark</td>
                        <td>
                            <textarea rows="4" name="remark" cols="20"><?= $remark ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Photo</td>
                        <td>
                            <input type="text" disabled value="<?= $img; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Upload Photo</td>
                        <td>
                            Max size: 488.28KB<br>
                            <input type="file" name="fileToUpload" id="fileToUpload" accept=".jpg, .jpeg, .png">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" align="right">
                            <button type="submit">Submit</button>
                            <button type="reset">Reset</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </main>
    <footer>
        <p>Copyright (c) 2023 - <a href="https://www.instagram.com/sirajddn._/" style="color: rgb(3, 0, 85); text-decoration: none;">@Sirajddn</a></p>
    </footer>

</body>
<script>
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