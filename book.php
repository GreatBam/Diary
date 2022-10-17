<?php

session_start();

$log = $_GET['log'];
$userId = $_SESSION['id'];
// comment test

include("config.php");

if(empty($_SESSION['email'])) {
    header("location:secret.php");
} else {
    $message = "<div class='alert alert-success' role='alert'>Welcome in your secret online diary !</div>";
    $query = "SELECT lesson.users.*, lesson.diaries.* FROM users INNER JOIN diaries ON diaries.fk_userId = '$userId'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    // echo "<pre>";
    // print_r([$result,$result,$result,$result,$result]);
    // echo "</pre>";
    // phpinfo();
}

if(isset($_POST['submit'])) {
    $book = $_POST['book'];
    $query = "SELECT * FROM diaries where fk_userId = '$userId'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $count = $stmt->rowCount();
    if($count >= 1) {
        $query = "UPDATE diaries SET diariesContent='$book' WHERE fk_userId='$userId'";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        if($log == "") {
            session_destroy();
            header("location:secret.php");
        }
    } else {
        $query = "INSERT INTO `diaries` (`diariesContent`, `fk_userId`) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->execute([$book, $userId]);
        if($log == "") {
            session_destroy();
            header("location:secret.php");
        }
    }
}

if(isset($_POST['clear'])) {
    $query = "DELETE FROM diaries WHERE fk_userId='$userId'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
}

if(isset($_POST['logout'])) {
    session_destroy();
    header("location:secret.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="boot/js/bootstrap.js"></script>
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="boot/css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Book</title>
</head>
<body>
    <form method="post">
        <div><?echo $message ?></div>
        <textarea name="book" id="book" cols="189" rows="25"><? echo $result['diariesContent'] ?></textarea><br>
        <div id="button">
            <button type="submit" class="btn btn-primary" id="submit" name="submit" value="save">Save</button>
            <button type="submit" class="btn btn-primary" id="clear" name="clear" value="clear">Clear</button>
            <button type="submit" class="btn btn-primary" id="logout" name="logout" value="logout">Logout</button>
        </div>
    </form>
</body>
</html>