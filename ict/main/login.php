<?php
session_start();

include("connect.php");
include("functions.php");

$error_message = ''; // Initialize error message variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if 'email' or 'username' and 'password' keys exist in $_POST array
    if (isset($_POST['email']) && isset($_POST['password'])) {
        //something was posted
        $email_or_username = $_POST['email']; // Change variable name to reflect it can contain either email or username
        $password = $_POST['password'];

        if (!empty($email_or_username) && !empty($password)) {

            //read from database
            $query = "SELECT * FROM users WHERE (email = '$email_or_username' OR user_name = '$email_or_username') LIMIT 1";

            $result = mysqli_query($con, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $user_data =  mysqli_fetch_assoc($result);

                // Check if user password matches hashed password
                if (password_verify($password, $user_data['password'])) {
                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: index.php");
                    exit();
                } else {
                    $error_message = 'Incorrect email/username or password';
                }
            } else {
                $error_message = 'Incorrect email/username or password';
            }
        } else {
            $error_message = 'Please enter email/username and password';
        }
    } else {
        $error_message = 'Please enter both email/username and password';
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
    <link rel="stylesheet" href="../css/log-in.css">
    <title>Lani | Log In</title>
</head>

<body>
    <div class="container-fluid full">
        <div class="box">
            <form method="post" name="form" class="form">
                <div class="">
                    <label for="form" class="d-flex align-items-center label_cont">
                        <img src="../img/logo_violet.png" alt="logo" class="logo">
                        <div class="">
                            <h5 class="text-center">Log In</h5>
                        </div>
                    </label>
                </div>

                <!-- Email Input -->
                <div class="row row-margin">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="floatingInputGrid" name="email" placeholder="Username or Email address" required>
                            <label for="floatingInputGrid">Username or Email address</label>
                        </div>
                    </div>
                </div>

                <!-- Password Input -->
                <div class="row row-margin">
                    <div class="col-md">
                        <div class="form-floating ">
                            <input type="password" class="form-control" id="floatingPasswordGrid" name="password" placeholder="Password" required pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,20}$">
                            <label for="floatingPasswordGrid">Password</label>
                            <div id="passwordHelpBlock" class="form-text smaller-text">
                                Your password must be 8-20 characters long, contain letters and numbers, and must not
                                contain spaces, special characters, or emoji.
                            </div>
                        </div>

                        <div class="form-check mt-2 d-flex align-items-center">
                            <input class="form-check-input" type="checkbox" id="showPasswordCheckbox" minlength="8" size="8">
                            <label class="form-check-label smaller-text d-flex align-items-center" for="showPasswordCheckbox">
                                Show Password
                            </label>
                        </div>

                    </div>
                </div>

                <div class="row row-margin">
                    <div class="col-md justify-content-center">
                        <input type="submit" class="btn signup" value="Log In">
                    </div>
                </div>
                <!-- Log In Hyperlink -->

                <p class="smaller-text text-center">Don't have an account? <a href="signup.php" class="login smaller-text">Register Here</a></p>
            </form>
        </div>
    </div>

    <!-- Modal popup HTML -->
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
<script src="../js/login.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</html>