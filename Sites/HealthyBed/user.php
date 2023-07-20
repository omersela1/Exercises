<?php
    session_start();
    if ((empty($_SESSION["usr"]))) {
        $redirect = "login.php";
        header('Location:' . $redirect);
    }
    $type = $_SESSION["type"];
    $fname = $_SESSION["fname"];
    $lname = $_SESSION["lname"];
?>

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
    <title><?php echo 'User Profile | ' .$_SESSION["usr"];?></title>
</head>

<body>
    <header><a href="#" class="logo"></a>
        <div class="connected1">
        <div class="userImage"><?php echo '<img class="userImage" src="'.$_SESSION["img-url"].'">';?></div>
            <div class="connected2">
                <h5>
                    <?php
                        echo '<a href="user.php?id=' .$_SESSION["usr"]. '">';
                        if ($type == "doctor")
                            echo "Dr. ";   
                        echo $fname . " " . $lname ."</a>";
                    ?>
                </h5>
                    <div class="circleMiniG">
                        <div class="connected3">
                            <p>Active</p>
                        </div>
                    </div>
            </div>
        </div>
       
        <div class="verticalLineNavbar"></div>
        <nav class="navbar navbar-inverse navbar-static-top">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="search.php">Search</a></li>
                <li><a href="#">Notifications</a></li>
                <li><a href="#">Settings</a></li>
            </ul>
        </nav>

    </header>
    <div id="userWrapper">
        <div class="displayUserDetails">
        <h1>User Profile</h1>
        
        <h2>Name:</h2>
        <p>
            <?php
                if ($type == "doctor")
                    echo "Dr. ";
                echo "".$fname. " " .$lname 
            ?>
        </p>
        <h2>Username:</h2>
            <p>
                <?php
                    echo $_SESSION["usr"];
                ?>
            </p>
        </h2>
        <h2>Email:</h2>
        <p>
            <?php
                echo $_SESSION["email"];
            ?>
        </p>
        <h2>Password:</h2>
        <p>
            <?php
                echo $_SESSION["pw"];
            ?>
        </p>
    </div>
        <?php
            $getImgQuery = 'select username,imgUrl from tbl_217_users where username="'.$_SESSION["usr"].'"';
            $imgResult = mysqli_query($connection, $getImgQuery);
            $row = mysqli_fetch_assoc($imgResult);
            echo '<div class="displayUserImage"><img src="'.$row["imgUrl"].'">
            <br><a href="admin.php?logout=1" class="btn submitButton logoutButton userLogout">Logout</a></div>';
        ?>
        
    </div>

    <footer>
        <nav class="navbar-mobile navbar-inverse navbar-static-top">
            <ul>
                <li><a href="index.php"><svg fill="white" fill-opacity="100%" version="1.1" id="Capa_1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="35px"
                            height="35px" viewBox="0 0 547.596 547.596" xml:space="preserve">
                            <g>
                                <path
                                    d="M540.76,254.788L294.506,38.216c-11.475-10.098-30.064-10.098-41.386,0L6.943,254.788
                       c-11.475,10.098-8.415,18.284,6.885,18.284h75.964v221.773c0,12.087,9.945,22.108,22.108,22.108h92.947V371.067
                       c0-12.087,9.945-22.108,22.109-22.108h93.865c12.239,0,22.108,9.792,22.108,22.108v145.886h92.947
                       c12.24,0,22.108-9.945,22.108-22.108v-221.85h75.965C549.021,272.995,552.081,264.886,540.76,254.788z" />
                            </g>
                        </svg></a></li>
                <li><a href="search.php"><svg width="35px" height="35px" viewBox="0 0 24 24" fill="white"
                            fill-opacity="70%" xmlns="http://www.w3.org/2000/svg">
                            <g id="Interface / Search_Magnifying_Glass">
                                <path id="Vector"
                                    d="M15 15L21 21M10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10C17 13.866 13.866 17 10 17Z"
                                    stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </g>
                        </svg></a></li>
                <li><a href="#"><svg width="35px" height="35px" viewBox="0 0 192 192" xmlns="http://www.w3.org/2000/svg"
                            fill="white" fill-opacity="70%">
                            <path fill="#000000"
                                d="m80.16 29.054-5.958-.709 5.958.71Zm31.68 0-5.958.71 5.958-.71Zm34.217 19.756-2.365-5.515 2.365 5.514Zm10.081 3.352 5.196-3-5.196 3Zm7.896 13.676 5.196-3-5.196 3Zm-2.137 10.407-3.594-4.805 3.594 4.805Zm0 39.51 3.593-4.805-3.593 4.805Zm2.137 10.407 5.196 3-5.196-3Zm-7.896 13.676-5.196-3 5.196 3Zm-10.081 3.353 2.364-5.515-2.364 5.515Zm-34.217 19.755 5.958.709-5.958-.709Zm-31.68 0-5.958.709 5.958-.709Zm-34.217-19.755-2.364-5.515 2.364 5.515Zm-10.08-3.353-5.197 3 5.196-3Zm-7.897-13.676 5.196-3-5.196 3Zm2.137-10.407 3.594 4.805-3.594-4.805Zm0-39.51L26.51 81.05l3.593-4.805Zm-2.137-10.407 5.196 3-5.196-3Zm7.896-13.676-5.196-3 5.196 3Zm10.081-3.352-2.364 5.514 2.364-5.514Zm7.85 3.365-2.365 5.515 2.364-5.515Zm0 87.65 2.364 5.514-2.365-5.514ZM36.235 111.17l-3.594-4.805 3.594 4.805Zm76.823 41.535 5.958.71-5.958-.71Zm39.854-69.742-3.593-4.805 3.593 4.805Zm-16.369-30.074 2.364 5.514-2.364-5.514Zm-23.485-13.594-5.958.709 5.958-.71ZM88.104 16a14 14 0 0 0-13.902 12.345l11.916 1.419A2 2 0 0 1 88.104 28V16Zm15.792 0H88.104v12h15.792V16Zm13.902 12.345A14 14 0 0 0 103.896 16v12a2 2 0 0 1 1.986 1.764l11.916-1.419Zm1.219 10.24-1.219-10.24-11.916 1.419 1.219 10.24 11.916-1.419Zm24.675 4.71-9.513 4.08 4.729 11.028 9.513-4.08-4.729-11.028Zm17.642 5.867a14 14 0 0 0-17.642-5.867l4.729 11.029a2 2 0 0 1 2.521.838l10.392-6Zm7.896 13.676-7.896-13.676-10.392 6 7.896 13.676 10.392-6Zm-3.74 18.212a14 14 0 0 0 3.74-18.212l-10.392 6a2 2 0 0 1-.535 2.602l7.187 9.61Zm-8.984 6.718 8.984-6.718-7.187-9.61-8.983 6.718 7.186 9.61Zm8.984 23.182-8.984-6.718-7.186 9.61 8.983 6.718 7.187-9.61Zm3.74 18.212a14 14 0 0 0-3.74-18.212l-7.187 9.61a2 2 0 0 1 .535 2.602l10.392 6Zm-7.896 13.676 7.896-13.676-10.392-6-7.896 13.676 10.392 6Zm-17.642 5.867a14 14 0 0 0 17.642-5.867l-10.392-6a2.001 2.001 0 0 1-2.521.838l-4.729 11.029Zm-9.513-4.08 9.513 4.08 4.729-11.029-9.512-4.079-4.73 11.028Zm-16.381 19.03 1.219-10.24-11.916-1.419-1.219 10.24 11.916 1.419ZM103.896 176a14 14 0 0 0 13.902-12.345l-11.916-1.419a2 2 0 0 1-1.986 1.764v12Zm-15.792 0h15.792v-12H88.104v12Zm-13.902-12.345A14 14 0 0 0 88.104 176v-12a2 2 0 0 1-1.986-1.764l-11.916 1.419Zm-1.012-8.504 1.012 8.504 11.916-1.419-1.012-8.504-11.916 1.419ZM51.428 134.31l-7.85 3.366 4.73 11.029 7.849-3.366-4.73-11.029Zm-7.85 3.366a2 2 0 0 1-2.52-.838l-10.392 6a14 14 0 0 0 17.642 5.867l-4.73-11.029Zm-2.52-.838-7.896-13.676-10.392 6 7.896 13.676 10.392-6Zm-7.896-13.676a2 2 0 0 1 .535-2.602l-7.187-9.61a14 14 0 0 0-3.74 18.212l10.392-6Zm.535-2.602 6.132-4.585-7.187-9.61-6.132 4.585 7.187 9.61ZM26.51 81.05l6.132 4.586 7.187-9.61-6.132-4.586-7.187 9.61Zm-3.74-18.212a14 14 0 0 0 3.74 18.212l7.187-9.61a2 2 0 0 1-.535-2.602l-10.392-6Zm7.896-13.676L22.77 62.838l10.392 6 7.896-13.676-10.392-6Zm17.642-5.867a14 14 0 0 0-17.642 5.867l10.392 6a2 2 0 0 1 2.52-.838l4.73-11.029Zm7.849 3.366-7.85-3.366-4.729 11.029 7.85 3.366 4.729-11.029Zm18.045-18.316-1.012 8.504 11.916 1.419 1.012-8.504-11.916-1.419Zm-1.754 27.552c6.078-3.426 11.69-9.502 12.658-17.63L73.19 36.85c-.382 3.209-2.769 6.415-6.635 8.595l5.893 10.453Zm-21.02 1.793c7.284 3.124 15.055 1.57 21.02-1.793l-5.893-10.453c-3.704 2.088-7.481 2.468-10.398 1.217l-4.73 11.029ZM49 96c0-7.1-2.548-15.022-9.171-19.975l-7.187 9.61C35.36 87.668 37 91.438 37 96h12Zm23.448 40.103c-5.965-3.363-13.736-4.917-21.02-1.793l4.729 11.029c2.917-1.251 6.694-.871 10.398 1.218l5.893-10.454Zm-32.62-20.128C46.452 111.022 49 103.1 49 96H37c0 4.563-1.64 8.333-4.358 10.365l7.187 9.61Zm78.679 19.575c-5.536 3.298-10.517 8.982-11.406 16.446l11.916 1.419c.329-2.765 2.318-5.582 5.632-7.557l-6.142-10.308Zm20.402-1.953c-7.094-3.042-14.669-1.463-20.402 1.953l6.142 10.308c3.382-2.015 6.872-2.372 9.53-1.233l4.73-11.028Zm-53.803 20.135c-.968-8.127-6.58-14.202-12.658-17.629l-5.893 10.454c3.866 2.179 6.253 5.385 6.635 8.594l11.916-1.419ZM141 96c0 6.389 2.398 13.414 8.32 17.842l7.186-9.61C154.374 102.638 153 99.668 153 96h-12Zm8.32-17.842C143.398 82.586 141 89.61 141 96h12c0-3.668 1.374-6.638 3.506-8.232l-7.186-9.61ZM118.507 56.45c5.733 3.416 13.308 4.995 20.401 1.953l-4.729-11.029c-2.658 1.14-6.148.782-9.53-1.233l-6.142 10.31Zm-11.406-16.446c.889 7.464 5.87 13.148 11.406 16.446l6.142-10.309c-3.314-1.974-5.303-4.79-5.632-7.556l-11.916 1.419Z" />
                            <path stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"
                                d="M96 120c13.255 0 24-10.745 24-24s-10.745-24-24-24-24 10.745-24 24 10.745 24 24 24Z" />
                        </svg></a></li>
                        <li><a <?php echo 'href="user.php?id='.$_SESSION["usr"].'"'?>><svg fill="white" fill-opacity="70%" width="35px" height="35px" viewBox="0 0 32 32"
                            id="Outlined" xmlns="http://www.w3.org/2000/svg">
                            <g id="Fill">
                                <path
                                    d="M24,17H8a5,5,0,0,0-5,5v7H5V22a3,3,0,0,1,3-3H24a3,3,0,0,1,3,3v7h2V22A5,5,0,0,0,24,17Z" />
                                <path d="M16,15a6,6,0,1,0-6-6A6,6,0,0,0,16,15ZM16,5a4,4,0,1,1-4,4A4,4,0,0,1,16,5Z" />
                            </g>
                        </svg></a></li>
            </ul>
        </nav>
    </footer>
</body>
</html>