<?php
session_start();
include("../config.php");
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

        #activityAdd {
            margin-top: 30px;
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
        $activity = "";
        $level = "";
        $remark = "";

        if (isset($_GET["id"]) && $_GET["id"] != "") {
            $sql = "SELECT * FROM activity WHERE av_id=" . $_GET["id"];
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            if (mysqli_num_rows($result) > 0) {
                $id = $row["av_id"];
                $sem = $row["sem"];
                $year = $row["year"];
                $activity = $row["activity"];
                $level = $row["level"];
                $remark = $row["remark"];
            }
        }
        mysqli_close($conn);
        ?>
        <header>
            <h1>Edit Your Activities</h1>
        </header>
        <div id="activityAdd">
            <form action="activity_edit_action.php" method="POST" enctype="multipart/form-data">
                <input type="text" id="aid" name="aid" value="<?= $_GET['id'] ?>" hidden>
                <table style="width: 500px;">
                    <tr>
                        <td>Semester</td>
                        <td>
                            <select size="1" name="sem" id="sem" required>
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
                        <td>Name</td>
                        <td>
                            <textarea rows="4" name="activity" cols="20" required><?= $activity ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Level</td>
                        <td>
                            <select size="1" name="level" id="level" required>
                                <option value="">&nbsp;</option>
                                <?php
                                if ($level == "Faculty")
                                    echo '<option value="Faculty" selected>Faculty</option>';
                                else
                                    echo '<option value="Faculty">Faculty</option>';
                                if ($level == "University")
                                    echo '<option value="University" selected>University</option>';
                                else
                                    echo '<option value="University">University</option>';
                                if ($level == "National")
                                    echo '<option value="National" selected>National</option>';
                                else
                                    echo '<option value="National">National</option>';
                                if ($level == "International")
                                    echo '<option value="International" selected>International</option>';
                                else
                                    echo '<option value="International">International</option>';
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Remark</td>
                        <td>
                            <textarea rows="4" name="remark" cols="20"><?= $remark ?></textarea>
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
    function showAdd() {
        var x = document.getElementById("activityAdd");
        x.style.display = 'flex';
        var firstField = document.getElementById('sem');
        firstField.focus();
    }

    function cancelAdd() {
        var x = document.getElementById("activityAdd");
        x.style.display = 'none';
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