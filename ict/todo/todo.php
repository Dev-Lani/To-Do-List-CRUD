<?php
session_start();

include("../main/connect.php");
include("../main/functions.php");

$user_data = check_login($con);
$user_id = $user_data['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/todo.css"> <!-- Add Todo List CSS -->
    <link rel="icon" href="../img/logo_violet.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>To Do List</title>
</head>

<body>
    <nav class="navbar fixed-top">
        <div class="container-fluid">
            <div class="img-cont d-flex align-items-center">
                <img src="../img/home-logo.png" alt="" class="logo">
                <h5 class="home">To Do</h5>
            </div>
            <a class="btn" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                <i class="fa-solid fa-gear"></i>
            </a>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Settings</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="profile-section">
                        <div class="profile-pic d-flex justify-content-center">
                            <img class="pfp" src="../img/user.png" alt="Profile Picture">
                        </div>
                        <div class="profile-info">
                            <h5 class="text-center user-name"><?php echo htmlspecialchars($user_data['user_name']); ?></h5>
                        </div>
                    </div>
                    <div class=" mt-3 d-flex justify-content-center">
                        <a href="../main/index.php">
                            <button type="button" class="btn todo">Home <i class="fa-solid fa-house" style="color: #ffffff;"></i></button>
                        </a>
                    </div>
                    <div class=" mt-3 d-flex justify-content-center">
                        <a href="../main/logout.php">
                            <button type="button" class="btn btn-danger">Log Out <i class="fa-solid fa-power-off"></i></button>
                        </a>
                    </div>
                </div>
                <div class="d-flex foot align-items-center">
                    <div class=" d-flex logo-cont justify-content-between">
                        <p class="text-footer">Made with: </p>
                        <i class="fa-brands fa-html5"></i>
                        <i class="fa-brands fa-css3-alt"></i>
                        <i class="fa-brands fa-bootstrap"></i>
                        <i class="fa-brands fa-js"></i>
                        <i class="fa-brands fa-php"></i>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- Todo List Section -->
    <div class="container">
        <div class="row justify-content-center task-container">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <form action="../todo/add_task.php" method="POST" class="input-group mb-4">
                    <input type="text" name="task" class="form-control" placeholder="Enter task" required>
                    <button type="submit" class="btn add-btn">Add Task</button>
                </form>
                <h2 class="mb-3">Tasks:</h2>
                <div id="tasks">
                    <?php
                    $sql = "SELECT * FROM todos WHERE user_id = $user_id ORDER BY created_at DESC";
                    $result = $con->query($sql); // Execute query

                    // Check if the query was successful
                    if ($result) {
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $formatted_date = date("m/d/Y h:i A", strtotime($row["created_at"]));
                    ?>
                                <div class='task card mb-3'>
                                    <div class='card-body d-flex justify-content-between align-items-center'>
                                        <div class='task-text'>
                                            <p class='card-text'><?php echo htmlspecialchars($row["task"]); ?></p>
                                            <small class='text-muted'>Created at: <i class='fa-regular fa-calendar'></i> <?php echo htmlspecialchars($formatted_date); ?></small>
                                        </div>
                                        <a href='../todo/delete_task.php?id=<?php echo $row["id"]; ?>' class='btn btn-danger btn-sm delete-btn'><i class='fas fa-trash-alt'></i></a>

                                    </div>  
                                </div>
                    <?php
                            }
                        } else {
                            echo "<p>No tasks available</p>";
                        }
                    } else {
                        echo "<p>Error: " . htmlspecialchars($con->error) . "</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</html>