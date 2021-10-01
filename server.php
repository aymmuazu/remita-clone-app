<?php

$localhost = 'localhost';
$user = 'root';
$password = '';

$database = 'remita';

$con = @mysqli_connect($localhost, $user, $password, $database);

if (!$con) {
    die('<div class="alert alert-info">Cannot connect to the database</div>');
}