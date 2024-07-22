<?php

$localhost = 'localhost';
$user = 'root';
$password = 'root';

$database = 'remita_demo';

$con = @mysqli_connect($localhost, $user, $password, $database);

if (!$con) {
    die('<div class="alert alert-info">Cannot connect to the database</div>');
}