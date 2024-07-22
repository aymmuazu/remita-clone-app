<?php

$localhost = 'localhost';
$user = 'root';
$password = 'root';

$database = 'remita_clone';

$con = @mysqli_connect($localhost, $user, $password, $database);

if (!$con) {
    die('<div class="alert alert-info">Cannot connect to the database</div>');
}