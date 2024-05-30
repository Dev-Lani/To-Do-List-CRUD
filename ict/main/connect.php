<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "info";

$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
    die("failes to connect");
}
