<?php
include 'config.php';
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!($connection))
    die("No connection to db.");
?>

<?php
if (isset($_GET["logout"])) {
    unset($_GET["logout"]);
    session_destroy();
    $redirect = "login.php";
    header('Location:' . $redirect);
}

?>

<?php
    if (!empty($_POST["email"])) {
        $mail = $_POST["email"];
        $pw = $_POST["password"];
        $query = "SELECT * from tbl_217_users WHERE email='" . $mail . "' AND password='" . $pw . "'";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
        if (!($row)) {
            echo "Invalid email or password.";
        }
        else {
            session_start();
            $_SESSION["usr"] = $row["username"];
            $_SESSION["pw"] = $row["password"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["fname"] = $row["f_name"];
            $_SESSION["lname"] = $row["l_name"];
            $_SESSION["type"] = $row["user_type"];
            $_SESSION["img-url"] = $row["imgUrl"];
            $_SESSION["id"] = $row["user_id"];
            $_SESSION["timezone"] = date_default_timezone_set('Asia/Jerusalem');
            unset($_POST["email"]);
            $redirect = "index.php";
            header('Location:' . $redirect);
        }   
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Coda&display=swap" rel="stylesheet">
    <title>HealthyBed</title>
</head>

<body>
        <div id="loginWrapper">
            <div>
                <a href="#" class="logoLogin"></a>
            </div>
            <form action="#" id="login-form" method="post">
                <h2>Login</h2>
                <label>Email: </label><input type="email" class="form-control loginform" name="email" value="" required>
                <label>Password: </label><input type="text" class="form-control loginform" name="password" value="" required>
                <div id="loginButton">
                    <input type="submit" class="btn submitButton" name="Login">
                    <a href="register.php" class="btn submitButton spaceButton">Register</a>
                </div>
            </form>
        </div>
</body>
</html>