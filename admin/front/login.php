<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

$username = $_SESSION['username'];

include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE username=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['username'] = $username;
                header("Location: dashboard.php");
                exit();
            } else {
                $login_error = "Invalid username or password";
            }
        } else {
            $login_error = "Invalid username or password";
        }
    }

    if (isset($_POST['register'])) {
        $fullname = $_POST['fullname'];
        $username = $_POST['reg_username'];
        $email = $_POST['email'];
        $password = $_POST['reg_password'];

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (fullname, username, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $fullname, $username, $email, $hashed_password);
        if ($stmt->execute()) {
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit();
        } else {
            $register_error = "Registration failed: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Education Admin | Login/Register</title>
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="build/css/custom.min.css" rel="stylesheet">
</head>
<body class="login">
<div>
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form method="post">
                    <h1>Login Form</h1>
                    <?php if(isset($login_error)) echo "<p>$login_error</p>"; ?>
                    <div>
                        <input type="text" name="username" class="form-control" placeholder="Username" required="" />
                    </div>
                    <div>
                        <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                    </div>
                    <div>
                        <button type="submit" name="login" class="btn btn-default submit">Log in</button>
                        <a class="reset_pass" href="#">Lost your password?</a>
					</div>
                    <div class="clearfix"></div>
                    <div class="separator">
                        <p class="change_link">New to site?
                            <a href="#signup" class="to_register"> Create Account </a>
                        </p>
                        <div class="clearfix"></div>
                        <br />
                        <div>
                            <h1><i class="fa fa-graduation-cap"></i> Education Admin</h1>
                            <p>©2016 All Rights Reserved. Education Admin is a Bootstrap 4 template. Privacy and Terms</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>

        <div id="register" class="animate form registration_form">
            <section class="login_content">
                <form method="post">
                    <h1>Create Account</h1>
                    <?php if(isset($register_error)) echo "<p>$register_error</p>"; ?>
                    <div>
                        <input type="text" name="fullname" class="form-control" placeholder="Fullname" required="required" />
                    </div>
                    <div>
                        <input type="text" name="reg_username" class="form-control" placeholder="Username" required="required" />
                    </div>
                    <div>
                        <input type="email" name="email" class="form-control" placeholder="Email" required="required" />
                    </div>
                    <div>
                        <input type="password" name="reg_password" class="form-control" placeholder="Password" required="required" />
                    </div>
                    <div>
                        <button type="submit" name="register" class="btn btn-default submit" value="Register">Submit</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
</body>
</html>
