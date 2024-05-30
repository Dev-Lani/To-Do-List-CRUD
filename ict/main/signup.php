<?php
session_start();

include("connect.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //something was posted
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = 'Email is already registerd';
        exit;
    }

    if (!empty($user_name) && !empty($email) && !empty($password) && !is_numeric($user_name)) {

        // Check if the username is already taken
        $query_username = "SELECT * FROM users WHERE user_name = '$user_name' LIMIT 1";
        $result_username = mysqli_query($con, $query_username);

        if (mysqli_num_rows($result_username) > 0) {
            $error_message = 'Username already exists';
        } else {

            // Check if the email is already registered
            $query_email = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
            $result_email = mysqli_query($con, $query_email);

            if (mysqli_num_rows($result_email) > 0) {
                $error_message = 'Email is already registered.';
            } else {
                $user_name = ucfirst($user_name);

                //save to data base
                $user_id = random_num(20);
                $password = password_hash($password, PASSWORD_BCRYPT);
                $query = "INSERT INTO users (user_id, user_name, email, password) VALUES ('$user_id', '$user_name', '$email', '$password')";

                mysqli_query($con, $query);
                header("Location: login.php");
            }
        }
    } else {
        $error_message = 'Fill in all the required fields';
    }
}
// Modal popup JavaScript to display the modal
if (!empty($error_message)) {
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                var myModal = new bootstrap.Modal(document.getElementById('errorModal'));
                myModal.show();
            });
        </script>";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/logo_violet.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/signup.css">
    <title>Lani | Sign Up</title>
</head>

<body>
    <div class="container-fluid full">
        <div class="box">
            <form method="post" name="form" class="form ">
                <div class="">
                    <label for="form" class="d-flex align-items-center label_cont">
                        <img src="../img/logo_violet.png" alt="logo" class="logo">
                        <div class="">
                            <h5 class="text-center">Sign Up</h5>
                        </div>
                    </label>
                </div>

                <!-- !Username Input -->
                <div class="row row-margin">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingInputGrid username" name="user_name" placeholder="Username" required autocomplete="off" pattern="^(?!.*\s)(?=.*[A-Za-z]{5,})(?=.*\d).{6,}$">
                            <label for="floatingInputGrid">Username</label>
                            <div id="passwordHelpBlock" class="form-text smaller-text">
                                Username must contain a minimum of 5 letters and at least 1 number </div>
                        </div>
                    </div>
                </div>

                <!-- !Email Input -->
                <div class="row row-margin">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="floatingInputGrid" name="email" placeholder="Email address" required autocomplete="off">
                            <label for="floatingInputGrid">Email address</label>
                        </div>
                    </div>
                </div>

                <!-- !Password Input -->
                <div class="row row-margin">
                    <div class="col-md">
                        <div class="form-floating ">
                            <input type="password" class="form-control" id="floatingPasswordGrid" name="password" placeholder="Password" autocomplete="off" required pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,20}$">
                            <label for="floatingPasswordGrid">Password</label>
                            <div id="passwordHelpBlock" class="form-text smaller-text">
                                Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                            </div>
                        </div>
                        <div class="form-check mt-2 d-flex align-items-center">
                            <input class="form-check-input" type="checkbox" id="showPasswordCheckbox" minlength="8" size="8">
                            <label class="form-check-label smaller-text display" for="showPasswordCheckbox">
                                Show Password
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row row-margin">
                    <div class="col-md justify-content-center">
                        <input type="submit" class="btn signup" value="Sign up">
                    </div>
                </div>
                <!-- !Log In Hyperlink -->

                <p class="smaller-text text-center">Already have an account? <a href="login.php" class="login smaller-text">Log
                        In</a></p>
            </form>
        </div>
    </div>

    <!-- Error Message ng Bootstrap -->
    <div class="modal fade" id="errorModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Error</h5>
                </div>
                <div class="modal-body"><?php echo $error_message; ?></div>
            </div>
        </div>
    </div>
</body>
<script src="../js/signup.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</html>