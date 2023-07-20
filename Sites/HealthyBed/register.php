<?php
    include 'config.php';
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    if (!($connection))
        die("No connection to db.");
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
            <form action="admin.php" id="login-form" method="post" enctype="multipart/form-data">
                <h2>Register</h2>
                <label>Username: </label><input type="text" class="form-control loginform" name="username" value="" required>
                <label>Password: </label><input type="text" class="form-control loginform" name="password" value="" required>
                <label>Email: </label><input type="email" class="form-control loginform" name="email" value="" required>
                <label>First Name: </label><input type="text" class="form-control loginform" name="first-name" value="" required>
                <label>Last Name: </label><input type="text" class="form-control loginform" name="last-name" value="" required>
                <label>Position: </label><select name="user-type" class="form-control loginform" required>
                    <option value="doctor">Doctor</option>
                    <option value="nurse">Nurse</option>
                    <option value="receptionist">Receptionist</option>
                    <option value="maintenance">Maintenance</option>    
                    </select>
                <label>Profile Picture:</label><input type="file" class="form-control loginform" name="usr-img" value="">
                    <div id="loginButton">
                        <input type="submit" class="btn submitButton" name="Login">
                        <a href="login.php" class="btn submitButton spaceButton">Login</a>
                    </div>
            </form>
    </div>
</body>
</html>