<?php
$host = "localhost";
$user = "root";
$pass = "";
$database = "db_0618";
$connect = new mysqli($host, $user, $pass, $database);
if (mysqli_connect_errno()) {
    trigger_error('Failed connect to mysql: '  . mysqli_connect_error(), E_USER_ERROR);
}

