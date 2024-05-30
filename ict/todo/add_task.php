<?php
session_start();

include("../main/connect.php");
include("../main/functions.php");

$user_data = check_login($con);
$user_id = $user_data['id'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $task = $_POST['task'];

    if (!empty($task)) {
        $query = "INSERT INTO todos (user_id, task) VALUES ('$user_id', '$task')";
        mysqli_query($con, $query);

        header("Location: todo.php");
        die;
    }
}
