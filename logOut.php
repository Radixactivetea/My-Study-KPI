<?php
session_start();
include("../config.php");
if (isset($_SESSION["UID"])) {
    unset($_SESSION["UID"]);
    unset($_SESSION["userName"]);
    header("location:index.php");
}else {
    header("location:index.php");
}
