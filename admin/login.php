<?php
session_start(); // Start the session

include 'db_connection.php';

// Register User
if (isset($_POST['register'])) {
    // Retrieve form data
    $full_name = $_POST["fullname"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $active = isset($_POST["active"]) ? 1 : 0; // Check if active checkbox is checked
    
    // Retrieve file data
    $pimage = $_FILES['image_path2']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image_path2"]["name"]);
    
    // Move the uploaded image to the uploads folder
    if (!move_uploaded_file($_FILES["image_path2"]["tmp_name"], $target_file)) {
        die("Error: Failed to upload image.");
    }

    // Insert user data into the database
    $sql = "INSERT INTO users (full_name, username, email, password, active, image_path2) VALUES ('$full_name', '$username', '$email', '$hashed_password', '$active', '$pimage')";
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Login User
if (isset($_POST['login'])) {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if user exists in the database
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Verify password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location: dashboard.php"); // Redirect to dashboard after successful login
            exit(); // Stop further execution
        } else {
            $loginError = "Invalid username or password";
        }
    } else {
        $userNotFoundError = "User not found";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Education Admin | Login/Register</title>
    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

</head>

<body class="login">
<div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <h1>Login Form</h1>
					<?php if(!empty($loginError)): ?>
                        <div class="alert alert-danger" role="alert"><?php echo $loginError; ?></div>
                    <?php endif; ?>
                    <?php if(!empty($userNotFoundError)): ?>
                        <div class="alert alert-danger" role="alert"><?php echo $userNotFoundError; ?></div>
                    <?php endif; ?>
                    <div>
                        <input type="text" class="form-control" name="username" placeholder="Username" required=""/>
                    </div>
                    <div>
                        <input type="password" class="form-control" name="password" placeholder="Password" required=""/>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-default submit" name="login">Log in</button>
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
                  <h1><i class="fa fa-graduation-cap"></i></i> Education Admin</h1>
                  <p>©2016 All Rights Reserved. Education Admin is a Bootstrap 4 template. Privacy and Terms</p>
                </div>
              </div>
                </form>
            </section>
        </div>
		

        <div class="animate form registration_form">
            <section class="login_content">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                    <h1>Create Account</h1>
                    <div>
                        <input type="text" class="form-control" name="fullname" placeholder="Fullname" required="yes"/>
                    </div>
                    <div>
                        <input type="text" class="form-control" name="username" placeholder="Username" required="yes"/>
                    </div>
                    <div>
                        <input type="email" class="form-control" name="email" placeholder="Email" required="yes"/>
                    </div>
                    <div>
                        <input type="password" class="form-control" name="password" placeholder="Password" required="yes"/>
                    </div>
                    <div>
                        <label for="active">Active:</label><br>
                        <input type="checkbox" name="active" class="flat">
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="image">Image <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <input type="file" id="image_path2" name="image_path2" required="required" class="form-control">
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-default submit" name="register">Submit</button>
                    </div>
					
					 <div class="clearfix"></div>

      <div class="separator">
        <p class="change_link">Already a member ?
          <a href="#signin" class="to_register"> Log in </a>
        </p>

        <div class="clearfix"></div>
        <br />

        <div>
          <h1><i class="fa fa-graduation-cap"></i></i> Education Admin</h1>
          <p>©2016 All Rights Reserved. Education Admin is a Bootstrap 4 template. Privacy and Terms</p>
        </div>
      </div>
                </form>
            </section>
        </div>
    </div>
</div>
</body>
</html>