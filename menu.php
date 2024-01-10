<?php
define('BASE_URL', '/Assignment_Individual');

echo
'<nav class="topnav" id="myTopnav">
    <a href="' . BASE_URL . '/Profile/profile.php"><i class="fa-solid fa-user"></i></a>
    <a href="' . BASE_URL . '/My_KPI/my_kpi.php">KPI Indicator</a>
    <a href="' . BASE_URL . '/My_Activities/my_activities.php">List of Activities</a>
    <a href="' . BASE_URL . '/My_Challenge/my_challenge.php">Challenge and Future Plan</a>
    <a href="' . BASE_URL . '/logOut.php" onClick="return confirm(\'Confirm Log Out\');" style="margin-left: 6px;" class="split">
    <i class="fa-solid fa-right-from-bracket"></i></a>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()"><i class="fa fa-bars"></i>
  </a></nav>';
