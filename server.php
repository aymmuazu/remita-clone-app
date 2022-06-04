<?php

$localhost = 'localhost';
$user = 'remi_remita';
$password = '.Abd37736578+';

$database = 'remi_remita';

$con = @mysqli_connect($localhost, $user, $password, $database);

if (!$con) {
    die('<div class="alert alert-info">Cannot connect to the database</div>');
}