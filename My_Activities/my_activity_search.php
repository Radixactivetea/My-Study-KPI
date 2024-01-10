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
    </style>
</head>

<body>
    <main>
        <?php
        $search = "";
        include('../menu.php');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $search = $_POST["search"];
        }
        ?>
        <header>
            <h1>Activities</h1>
            <h4>Search Result:&nbsp;<?= $search ?></h4>
        </header>
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
                    if ($search != "") {
                        echo "<th>Action</th>";
                    }
                    ?>
                </tr>
                <?php
                if ($search != "") {
                    $search = $_POST["search"];

                    // Split the search string into individual words
                    $keywords = explode(" ", $search);

                    // Prepare the SQL query with multiple LIKE conditions
                    $sql = "SELECT * FROM activity WHERE (";

                    // Build the conditions dynamically for single keyword
                    $conditions = [];
                    foreach ($keywords as $index => $keyword) {
                        $conditions[] = "activity LIKE '%$keyword%'";
                    }

                    // Combine
                    $sql .= implode(" OR ", $conditions);

                    // Select only with this userID
                    $sql .= " OR activity LIKE '%$search%') AND userID=" . $_SESSION["UID"];

                    $result = mysqli_query($conn, $sql);
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
                        echo '<tr><td colspan="6">No results</td></tr>';
                    }
                } else {
                    echo '<tr><td colspan="5">No results</td></tr>';
                }
                ?>
            </table>
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