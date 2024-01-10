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
            flex-direction: column;
            justify-content: center;
        }

        table {
            width: 90%;
        }

        button {
            margin-bottom: 20px;
        }

        #edit_KPI {
            display: none;
            margin-top: 50px;
            width: 70%;
            text-align: center;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <?php
    include('../menu.php');
    include('cgpa.php');
    include('activity.php');
    include('kpi.php');
    ?>
    <main>
        <header>
            <h1>KPI Indicator</h1>
        </header>
        <div class="flex">
            <button onclick="showEdit()">Edit KPI</button>
            <table>
                <tr>
                    <th>No</th>
                    <th>Indicator</th>
                    <th>Faculty KPI</th>
                    <th>My KPI</th>
                    <th style="width: 100px;">Sem 1 Year 1</th>
                    <th style="width: 100px;">Sem 2 Year 1</th>
                    <th style="width: 100px;">Sem 1 Year 2</th>
                    <th style="width: 100px;">Sem 2 Year 2</th>
                    <th style="width: 100px;">Sem 1 Year 3</th>
                    <th style="width: 100px;">Sem 2 Year 3</th>
                    <th style="width: 100px;">Sem 1 Year 4</th>
                    <th style="width: 100px;">Sem 2 Year 4</th>
                </tr>
                <tr>
                    <td align="center">1</td>
                    <td>CGPA</td>
                    <td align="center">>3.00</td>
                    <td><?= $cgpa_myself ?? '' ?></td>
                    <td><?= $sem1year1 ?? '' ?></td>
                    <td><?= $sem2year1 ?? '' ?></td>
                    <td><?= $sem1year2 ?? '' ?></td>
                    <td><?= $sem2year2 ?? '' ?></td>
                    <td><?= $sem1year3 ?? '' ?></td>
                    <td><?= $sem2year3 ?? '' ?></td>
                    <td><?= $sem1year4 ?? '' ?></td>
                    <td><?= $sem2year4 ?? '' ?></td>
                </tr>
                <tr>
                    <td align="center" rowspan="5" style="border-bottom-left-radius: 20px;">2</td>
                    <th colspan="12">Student Activity</th>
                </tr>
                <tr>
                    <td>Faculty</td>
                    <td>4</td>
                    <td><?= $avfaculty_myself ?? '' ?></td>
                    <?php activity('Faculty', $conn) ?>
                </tr>
                <tr>
                    <td>University</td>
                    <td>4</td>
                    <td><?= $avuni_myself ?? '' ?></td>
                    <?php activity('University', $conn) ?>
                </tr>
                <tr>
                    <td>National</td>
                    <td>1</td>
                    <td><?= $avnation_myself ?? '' ?></td>
                    <?php activity('National', $conn) ?>
                </tr>
                <tr>
                    <td>International</td>
                    <td>1</td>
                    <td><?= $avinter_myself ?? '' ?></td>
                    <?php activity('International', $conn) ?>
                </tr>
                <tr>
            </table>
            <div id="edit_KPI">
                <form action="kpi_action.php" method="POST" id="kpi">
                    <h1>Edit your Kpi indicator</h1>
                    <table style="width: 400px;">
                        <tr>
                            <th>No</th>
                            <th>Indicator</th>
                            <th style="width: 90px;">My KPI</th>
                        </tr>
                        <tr>
                            <td>No</td>
                            <td>CGPA</td>
                            <td><input type="text" name="cgpa_myself" id="cgpa_myself" size="5" value="<?= $cgpa_myself ?? '' ?>"></td>
                        </tr>
                        <tr>
                            <td align="center" rowspan="5" style="border-bottom-left-radius: 20px;">2</td>
                            <th colspan="3">Student Activity</th>
                        </tr>
                        <tr>
                            <td>Faculty</td>
                            <td><input type="text" name="avfaculty_myself" id="avfaculty_myself" size="5" value="<?= $avfaculty_myself ?? '' ?>"></td>
                        </tr>
                        <tr>
                            <td>University</td>
                            <td><input type="text" name="avuni_myself" id="avuni_myself" size="5" value="<?= $avuni_myself ?? '' ?>"></td>
                        </tr>
                        <tr>
                            <td>National</td>
                            <td><input type="text" name="avnation_myself" id="avnation_myself" size="5" value="<?= $avnation_myself ?? '' ?>"></td>
                        </tr>
                        <tr>
                            <td>International</td>
                            <td><input type="text" name="avinter_myself" id="avinter_myself" size="5" value="<?= $avinter_myself ?? '' ?>"></td>
                        </tr>
                        <tr></tr>
                    </table>
                    <div style="margin-top: 20px;">
                        <button type="submit">Submit</button>
                        <button type="reset">Reset</button>
                        <button type="reset" onClick="cancelAdd()">Cancel</button>
                    </div>
                </form>
                <?php
                $querry = "SELECT batch from profile WHERE userID = " . $_SESSION["UID"];
                $status = mysqli_query($conn, $querry);
                $batch =  "";
                $batch2 =  "";
                $batch3 =  "";
                $batch4 = "";
                if (mysqli_num_rows($status) > 0) {

                    if ($row = mysqli_fetch_assoc($status)) {

                        if ($row["batch"] != "") {
                            $batch = $row["batch"];

                            $batch2 = $batch + 1;
                            $batch3 = $batch + 2;
                            $batch4 = $batch + 3;
                        }
                    }
                }
                ?>
                <form action="cgpa_action.php" method="POST" id="cgpa">
                    <h1>Edit Or Add Your CGPA</h1>
                    <table style="width: 400px;">
                        <tr>
                            <th>Sem & Year</th>
                            <th>CGPA</th>
                        </tr>
                        <tr>
                            <td>1/<?=$batch?></td>
                            <td><input type="text" name="sem1year1" id="sem1year1" size="5" value="<?= $sem1year1 ?? '' ?>"></td>
                        </tr>
                        <tr>
                            <td>2/<?=$batch?></td>
                            <td><input type="text" name="sem2year1" id="sem2year1" size="5" value="<?= $sem2year1 ?? '' ?>"></td>
                        </tr>
                        <tr>
                            <td>1/<?=$batch2?></td>
                            <td><input type="text" name="sem1year2" id="sem1year2" size="5" value="<?= $sem1year2 ?? '' ?>"></td>
                        </tr>
                        <tr>
                            <td>2/<?=$batch2?></td>
                            <td><input type="text" name="sem2year2" id="sem2year2" size="5" value="<?= $sem2year2 ?? '' ?>"></td>
                        </tr>
                        <tr>
                            <td>1/<?=$batch3?></td>
                            <td><input type="text" name="sem1year3" id="sem1year3" size="5" value="<?= $sem1year3 ?? '' ?>"></td>
                        </tr>
                        <tr>
                            <td>2/<?=$batch3?></td>
                            <td><input type="text" name="sem2year3" id="sem2year3" size="5" value="<?= $sem2year3 ?? '' ?>"></td>
                        </tr>
                        <tr>
                            <td>1/<?=$batch4?></td>
                            <td><input type="text" name="sem1year4" id="sem1year4" size="5" value="<?= $sem1year4 ?? '' ?>"></td>
                        </tr>
                        <tr>
                            <td>2/<?=$batch4?></td>
                            <td><input type="text" name="sem2year4" id="sem2year4" size="5" value="<?= $sem2year4 ?? '' ?>"></td>
                        </tr>
                        <tr></tr>
                    </table>
                    <div style="margin-top: 20px;">
                        <button type="submit">Submit</button>
                        <button type="reset">Reset</button>
                        <button type="reset" onClick="cancelAdd()">Cancel</button>
                    </div>
                </form>
            </div>

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

    function showEdit() {
        var x = document.getElementById("edit_KPI");
        x.style.display = 'flex';
        x.style.justifyContent = 'space-around';
        var firstField = document.getElementById('CGPA');
        firstField.focus();
    }
    function cancelAdd() {
        var x = document.getElementById("edit_KPI");
        x.style.display = 'none';
        var firstField = document.getElementById('CGPA');
        firstField.focus();
    }
</script>

</html>