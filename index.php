<?php

include './database/config.php';
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- logo -->
    <link rel="icon" href="./public/assets/logo.webp" type="image/webp" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Newsreader:ital,opsz,wght@0,6..72,200..800;1,6..72,200..800&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="./public/css/login.css">
    <link rel="stylesheet" href="./public/css/flash.css">

    <!-- Scripts (after body content for better performance) -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>




    <!-- Title -->
    <title>Room Management System</title>
</head>




<body>
    <!--  carousel -->
    <section id="carouselExampleControls" class="carousel slide carousel_section" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="carousel-image" src="./public/assets/carousel_1.jpg">
            </div>
            <div class="carousel-item">
                <img class="carousel-image" src="./public/assets/carousel_2.jpg">
            </div>
            <div class="carousel-item">
                <img class="carousel-image" src="./public/assets/carousel_1.jpg">
            </div>
            <div class="carousel-item">
                <img class="carousel-image" src="./public/assets/carousel_2.jpg">
            </div>
        </div>
    </section>

    <!-- main section -->
    <section id="auth_section">
        <div class="logo">
            <a href="#"><img class="meyclogo" src="./public/assets/logo.webp" alt="logo"></a>
            <p>Meycauayan College</p>
        </div>

        <div class="auth_container">


            <!--============ login =============-->
            <div id="Log_in">
                <h2>Sign In</h2>
                <div class="role_btn">
                    <div class="btns active">Student</div>
                    <div class="btns">Registrar</div>
                </div>

                <!-- // ==userlogin== -->
                <?php
                if (isset($_POST['user_login_submit'])) {
                    $Email = $_POST['Email'];
                    $Password = $_POST['Password'];

                    // Query to check if the user exists in the signup table
                    $sql = "SELECT * FROM signup WHERE Email = '$Email' AND Password = BINARY'$Password'";
                    $result = mysqli_query($conn, $sql);

                    if ($result->num_rows > 0) {
                        // User found, start session and redirect
                        $_SESSION['usermail'] = $Email;
                        $Email = "";
                        $Password = "";
                        header("Location: ./end-users/users.php"); // Redirect to users page
                    } else {
                        // User not found, show error message
                        echo "<script>swal({
                title: 'Invalid credentials, please try again.',
                icon: 'error',
            });
            </script>";
                    }
                }
                ?>

                <!-- User login form (without the Username field) -->
                <form class="user_login authsection active" id="userlogin" action="" method="POST">
                    <div class="form-floating">
                        <input type="email" class="form-control" name="Email" placeholder=" " required>
                        <label for="Email">Email</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" name="Password" placeholder=" " required>
                        <label for="Password">Password</label>
                    </div>
                    <button type="submit" name="user_login_submit" class="auth_btn">Sign In</button>

                    <div class="footer_line">
                        <h6>Don't have an account? <span class="page_move_btn" onclick="signuppage()">sign up</span></h6>
                    </div>
                </form>






                <!-- == Reg Login == -->
                <?php
                if (isset($_POST['Reg_login_submit'])) {
                    $Email = $_POST['Reg_Email'];
                    $Password = $_POST['Reg_Password'];

                    $sql = "SELECT * FROM reg_login WHERE Reg_Email = '$Email' AND Reg_Password = BINARY'$Password'";
                    $result = mysqli_query($conn, $sql);

                    if ($result->num_rows > 0) {
                        $_SESSION['usermail'] = $Email;
                        $Email = "";
                        $Password = "";
                        header("Location: ./end-users/admin.php");
                    } else {
                        echo "<script>swal({
                title: 'Authentication Failed',
                icon: 'error',
            });
            </script>";
                    }
                }
                ?>
                <form class="registrar_login authsection" id="registrarlogin" action="" method="POST">
                    <div class="form-floating">
                        <input type="email" class="form-control" name="Reg_Email" placeholder=" ">
                        <label for="floatingInput">Email</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" name="Reg_Password" placeholder=" ">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <button type="submit" name="Reg_login_submit" class="auth_btn">Sign In</button>
                </form>
            </div>






            <!--============ Student signup =============-->
            <?php
            if (isset($_POST['user_signup_submit'])) {
                // Collect form data
                $FirstName = $_POST['FirstName'];
                $LastName = $_POST['LastName'];
                $StudentNumber = $_POST['StudentNumber'];
                $Email = $_POST['Email'];
                $Password = $_POST['Password'];
                $CPassword = $_POST['CPassword'];

                // Check if all fields are filled
                if ($FirstName == "" || $LastName == "" || $StudentNumber == "" || $Email == "" || $Password == "") {
                    echo "<script>swal({
                title: 'Fill in the proper details',
                icon: 'error',
            });
            </script>";
                } else {
                    // Check if passwords match
                    if ($Password == $CPassword) {
                        // Check if email or student number already exists
                        $sql = "SELECT * FROM signup WHERE Email = '$Email' OR StudentNumber = '$StudentNumber'";
                        $result = mysqli_query($conn, $sql);

                        if ($result->num_rows > 0) {
                            echo "<script>swal({
                        title: 'Email or Student Number already exists',
                        icon: 'error',
                    });
                    </script>";
                        } else {
                            // Insert new user into the database
                            $sql = "INSERT INTO signup (FirstName, LastName, StudentNumber, Email, Password) 
                        VALUES ('$FirstName', '$LastName', '$StudentNumber', '$Email', '$Password')";
                            $result = mysqli_query($conn, $sql);

                            if ($result) {
                                $_SESSION['usermail'] = $Email; // Set session for login
                                $FirstName = "";
                                $LastName = "";
                                $StudentNumber = "";
                                $Email = "";
                                $Password = "";
                                $CPassword = "";
                                header("Location: ./end-users/users.php"); // Redirect after successful signup
                            } else {
                                echo "<script>swal({
                            title: 'Authentication Failed',
                            icon: 'error',
                        });
                        </script>";
                            }
                        }
                    } else {
                        echo "<script>swal({
                    title: 'Password does not match',
                    icon: 'error',
                });
                </script>";
                    }
                }
            }
            ?>


            <div id="sign_up">
                <h2>Create an account</h2>

                <!-- Signup Form -->
                <form class="user_signup" id="usersignup" action="" method="POST">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="FirstName" placeholder=" ">
                        <label for="FirstName">First Name</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control" name="LastName" placeholder=" ">
                        <label for="LastName">Last Name</label>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control" name="StudentNumber" placeholder=" ">
                        <label for="StudentNumber">Student Number</label>
                    </div>
                    <div class="form-floating">
                        <input type="email" class="form-control" name="Email" placeholder=" ">
                        <label for="Email">Email</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" name="Password" placeholder=" ">
                        <label for="Password">Password</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" name="CPassword" placeholder=" ">
                        <label for="CPassword">Confirm Password</label>
                    </div>

                    <button type="submit" name="user_signup_submit" class="auth_btn">Register</button>

                    <div class="footer_line">
                        <h6>Already have an account? <span class="page_move_btn" onclick="loginpage()">sign in</span></h6>
                    </div>
                </form>
            </div>

    </section>
</body>


<script src="./public/javascript/index.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- aos animation-->
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>

</html>