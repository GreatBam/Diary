<?php
session_start();

include('config.php');

if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $mailCheck = "%".$email."%";
    $hash = password_hash($password, PASSWORD_DEFAULT);

    if(empty($email) || empty($password)) {
        if(empty($email)) {
            $message = "<div class='alert alert-danger' role='alert'>Please enter your email</div>";
        } else if(empty($password)) {
            $message = "<div class='alert alert-danger' role='alert'>Please create a password</div>";
        }
    } else {
        $query = "SELECT * FROM lesson.users where email like '".$mailCheck."'";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result['email'] == $email) {
            $message = "<div class='alert alert-danger' role='alert'>You're already registered</div>";
        } else {
            $query = "INSERT INTO lesson.users (email, password) VALUES (?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->execute([$email, $hash]);
            header("location:book.php");
        }
    }
}

// $message = "<div class='alert alert-danger' role='alert'>You'r already registered</div>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="boot/js/bootstrap.js"></script>
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="boot/css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Sign up</title>
</head>
<body>
    <div id="title">
        <h1 class="title">Secret Diary</h1>
        <p class="intro">Please enter your email and create a password</p>
    </div>
    <div id="error"><?echo $message?></div>
    <div id="formContainer">
        <form method="post" id="form">
        <div class="mb-3">
            <!-- <label for="email" class="form-label">Email address</label> -->
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" placeholder="Enter your email">
        </div>
        <div class="mb-3">
            <!-- <label for="password" class="form-label">Password</label> -->
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
        </div>
        <div id="button">
            <button type="submit" class="btn btn-primary" id="submit" name="submit" value="signup">Sign up</button><br><br>
            <p class="signup">or</p>
            <a href="secret.php" class="signup">Log in</a>
        </div>
        </form>
    </div>
</body>
</html>