<?php
session_start();

include("connect.php");
include("functions.php");

$user_data = check_login($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="icon" href="../img/logo_violet.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Lani | Index Page</title>
</head>

<body>
    <nav class="navbar fixed-top">
        <div class="container-fluid">
            <div class="img-cont d-flex align-items-center">
                <img src="../img/home-logo.png" alt="" class="logo">
                <h5 class="home">Home</h5>
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
                            <h5 class="text-center user-name"><?php echo $user_data['user_name']; ?></h5>
                        </div>
                    </div>
                    <div class=" mt-3 d-flex justify-content-center">
                        <a href="../todo/todo.php">
                            <button type="button" class="btn todo">To Do <i class="fa-regular fa-pen-to-square"></i></button>
                        </a>
                    </div>
                    <div class=" mt-3 d-flex justify-content-center">
                        <a href="logout.php">
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
    <div class="greetings">
        <h1 class="scale-up-center"> Welcome, <span class="user_name"><?php echo $user_data['user_name']; ?></span></h1>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</html>