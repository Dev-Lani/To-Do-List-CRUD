<?php
include 'todo_db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM todos WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: todo.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }   
}
