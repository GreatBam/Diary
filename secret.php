<?php
session_start();

include('config.php');

if($_SESSION['log'] === true) {
    header("location:book.php");
}

if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $check = $_POST['check'];
    $mailCheck = "%".$email."%";
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $_SESSION['email'] = $_POST['email'];
    if(empty($email) || empty($password)) {
        if(empty($email)) {
            $message = "<div class='alert alert-danger' role='alert'>Please enter your email</div>";
        }
        if(empty($password)) {
            $message = "<div class='alert alert-danger' role='alert'>Please enter your password</div>";
        }
    } else {
        $query = "SELECT * FROM lesson.users where email like '".$mailCheck."'";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['id'] = $result['userId'];
        if(empty($result['email'])) {
            $message = "<div class='alert alert-danger' role='alert'>Please create an account</div>";
        } else if(password_verify($password, $result['password'])) {
            if($check === "on") {
                header("location:book.php?log=1");
            } else {
                header("location:book.php");
            }
        } else {
            $message = "<div class='alert alert-danger' role='alert'>Invalid password</div>";
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="boot/js/bootstrap.js"></script>
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="boot/css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Secret Diary</title>
</head>
<body>
    <div id="title">
        <h1 class="title">Secret Diary</h1>
        <p class="intro">Store your thoughts permanently and securely</p>
        <p class="intro">Interessed ? Sign up now !</p>
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
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="check" name="check">
            <label class="form-check-label" for="check">Stay logged</label>
        </div>
        <div id="button">
            <button type="submit" class="btn btn-primary" id="submit" name="submit" value="login">Log in</button><br><br>
            <p class="signup">or</p>
            <a href="signup.php" class="signup">Sign up</a>
        </div>
        </form>
    </div>
</body>
</html>