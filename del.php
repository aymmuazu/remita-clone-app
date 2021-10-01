<?php
require 'server.php';

$rrr = $_GET['rrr'];

$query = "DELETE FROM `pre-payments` WHERE `rrr`='$rrr'";

if ($query_run = mysqli_query($con, $query)) {
    session_start();
    $_SESSION['delete'] = 'You just Deleted a Payment Record.';
    header('Location: index.php');
}