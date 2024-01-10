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

        #activityAdd {
            margin-top: 30px;
            display: none;
            justify-content: center;
        }
    </style>
</head>

<body>
    <main>
        <?php
        if(!isset($_SESSION["UID"])){
            header("location:../index.php");
        }
        include('../menu.php');
        $sql = "SELECT * FROM activity WHERE userID=" . $_SESSION["UID"];
        $result =   mysqli_query($conn, $sql);
        ?>
        <header>
            <h1>Activities</h1>
        </header>
        <div class="flex" style="margin-bottom: 30px;">
            <button onClick="showAdd()">Add Activity</button>
        </div>
        <div style="text-align: right; padding:10px; translate: -250px;">
            <form action="my_activity_search.php" method="post">
                <input type="text" placeholder="Search.." name="search" style="padding:0.5rem 1.5rem;border-radius: 4px;">
                <button type="submit" value="Search">Search</button>
            </form>
        </div>
        <div class="flex">
            <table>
                <tr>
                    <th>No</th>
                    <th style="width: 100px;">Sem & Year</th>
                    <th>Name</th>
                    <th>Level</th>
                    <th>Remark</th>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        echo "<th>Action</th>";
                    }
                    ?>
                </tr>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    $numrow = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $numrow . "</td>";
                        echo '<td>' . $row["sem"] . '  ' . $row["year"] . '</td>';
                        echo "<td>" . $row["activity"] . "</td>";
                        echo "<td>" . $row["level"] . "</td>";
                        echo "<td>" . $row["remark"] . "</td>";
                        echo '<td> <a href="my_activity_edit.php?id=' . $row["av_id"] . '">Edit</a>&nbsp;|&nbsp;';
                        echo '<a href="my_activity_delete.php?id=' . $row["av_id"] . '" onClick="return confirm(\'Delete?\');">Delete</a> </td>';
                        echo "</tr>" . "\n\t\t";
                        $numrow++;
                    }
                } else {
                    echo '<tr><td colspan="5">No results</td></tr>';
                }
                ?>
            </table>
        </div>
        <div id="activityAdd">
            <form action="activity_add_action.php" method="POST" enctype="multipart/form-data">
                <table style="width: 500px;">
                    <tr>
                        <td>Semester</td>
                        <td>
                            <select size="1" name="sem" id="sem" required>
                                <option value="">&nbsp;</option>
                                <option value="1">1</option>;
                                <option value="2">2</option>;
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Year</td>
                        <td>
                            <input type="text" name="year" id="year" size="5" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>
                            <textarea rows="4" name="activity" cols="20" required></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Level</td>
                        <td>
                            <select size="1" name="level" id="level" required>
                                <option value="">&nbsp;</option>
                                <option value="Faculty">Faculty</option>;
                                <option value="University">University</option>;
                                <option value="National">National</option>;
                                <option value="International">International</option>;
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Remark</td>
                        <td>
                            <textarea rows="4" name="remark" cols="20"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" align="right">
                            <button type="submit">Submit</button>
                            <button type="reset">Reset</button>
                            <button type="reset" onClick="cancelAdd()">Cancel</button>
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