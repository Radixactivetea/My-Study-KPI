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
            margin-top: 100px;
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


        ?>
        <header>
            <h1>My Challenge</h1>
        </header>
        <div class="flex" style="margin-bottom: 30px;">
            <button onClick="showAdd()">Add Challenge</button>

        </div>
        <div style="text-align: right; padding:10px; translate: -250px;">
            <form action="my_challenge_search.php" method="post">
                <input type="text" placeholder="Search.." name="search" style="padding:0.5rem 1.5rem;border-radius: 4px;">
                <button type="submit" value="Search">Search</button>
            </form>
        </div>
        <div class="flex">
            <table>
                <tr>
                    <th>No</th>
                    <th>Sem & Year</th>
                    <th>Challenge</th>
                    <th>Plan</th>
                    <th>Remark</th>
                    <th>Photo</th>
                    <th>Action</th>
                </tr>
                <?php
                $sql = "SELECT * FROM challenge WHERE userID=" . $_SESSION["UID"];
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $numrow = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $numrow . "</td><td>" . $row["sem"] . " " . $row["year"] . "</td><td>" . $row["challenge"] . "</td><td>" . $row["plan"] . "</td><td>" . $row["remark"] . "</td><td>" . $row["img_path"] . "</td>";
                        echo '<td> <a href="my_challenge_edit.php?id=' . $row["ch_id"] . '">Edit</a>&nbsp;|&nbsp;';
                        echo '<a href="my_challenge_delete.php?id=' . $row["ch_id"] . '" onClick="return confirm(\'Delete?\');">Delete</a> </td>';
                        echo "</tr>" . "\n\t\t";
                        $numrow++;
                    }
                } else {
                    echo '<tr><td colspan="7">No results</td></tr>';
                }
                mysqli_close($conn);
                ?>
            </table>
        </div>
        <div id="challengeAdd">
            <form action="challenge_add_action.php" method="POST" enctype="multipart/form-data">
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
                        <td>Challenge</td>
                        <td>
                            <textarea rows="4" name="challenge" cols="20" required></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Plan</td>
                        <td>
                            <textarea rows="4" name="plan" cols="20" required></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Remark</td>
                        <td>
                            <textarea rows="4" name="remark" cols="20"></textarea>
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
        var x = document.getElementById("challengeAdd");
        x.style.display = 'flex';
        var firstField = document.getElementById('sem');
        firstField.focus();
    }

    function cancelAdd() {
        var x = document.getElementById("challengeAdd");
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