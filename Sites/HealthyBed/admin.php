<?php
if (isset($_GET["logout"])) {
    session_destroy();
    unset($_GET["logout"]);
    $redirect = "login.php";
    header('Location:' . $redirect);
}
?>

<?php
    include 'config.php';

    session_start();

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    if (!($connection))
    die("No connection to db.");

    if (!empty($_POST["username"])) {
        $usr = $_POST["username"];
        $pw = $_POST["password"];
        $mail = $_POST["email"];
        $fname = $_POST["first-name"];
        $lname = $_POST["last-name"];
        $type = $_POST["user-type"];

        $checkEmailQuery = "select * from tbl_217_users where email='" .$mail. "'";
        $checkResult = mysqli_query($connection, $checkEmailQuery);
        if (mysqli_num_rows($checkResult) != 0) {
            echo '<script>alert("Email address already exists!");</script>';
            $redirect = "register.php";
            header('Location:' . $redirect);
            exit;
        }

        $imgUrl = 'images/profile-default.svg';

        if (isset($_FILES["usr-img"]) && $_FILES["usr-img"]["error"] == UPLOAD_ERR_OK) {
            $fileName = ''.$usr .'_profile_photo.jpeg';
            if (move_uploaded_file($_FILES["usr-img"]["tmp_name"], 'images/'.$fileName)) 
                $imgUrl = 'images/'.$fileName;
        }
    
        
        $query = "INSERT INTO tbl_217_users values
        ('" . $usr . "','" . $fname . "','" . $lname . 
        "','" .$pw . "','" . $mail . "','" . $type . "','".$imgUrl."')";
        $result = mysqli_query($connection, $query);
        if ($result) {
            echo "<h1>Success!</h1>";
            $redirect = "login.php";
            header('Location:' . $redirect);
        }

    }
?>




<?php
    if ((isset($_GET["id"])) && (!isset($_POST["patientName"]))) {
        $getPatientQuery = 'select * from tbl_217_beds where bed_id=' .$_GET["id"];
        $patient = mysqli_query($connection, $getPatientQuery);
        $row = mysqli_fetch_assoc($patient);
        $removePatientQuery = 'delete from tbl_217_patients where patient_id=' .$row["patient_id"];
        mysqli_query($connection, $removePatientQuery);


        $releaseQuery = 'update tbl_217_beds 
        set patient_id=1, bed_status="unoccupied"
        where bed_id=' .$_GET["id"];
        $release = mysqli_query($connection, $releaseQuery);


        
        $updateQuery = 'insert into tbl_217_updates values(0,'.$_GET["id"].',1,"'.$_SESSION["usr"].'
        ","The status of bed # '.$_GET["id"].' has been changed to unoccupied by Dr. ' .$_SESSION["fname"]. ' ' .$_SESSION["lname"]. '. ",DATE_ADD(now(), interval 10 hour))';

        $updateResult = mysqli_query($connection, $updateQuery);
        $redirect = "bed.php?id=" .$_GET["id"];
        header('Location:' . $redirect);
    }
?>

<?php
    if ((isset($_GET["id"])) && (isset($_POST["patientName"]))) {
        $checkPatientsQuery = "select * from tbl_217_patients where real_id=" .$_POST["patientId"];
        $checkPatientsResult = mysqli_query($connection, $checkPatientsQuery);
        if (mysqli_num_rows($checkPatientsResult) != 0) {
            $redirect = "bed.php?id=" .$_GET["id"];
            header('Location:'.$redirect);
        }

        $name = explode(" ", $_POST["patientName"]); 
        $insertQuery = 'insert into tbl_217_patients values(0, "' 
        .$_POST["patientId"]. '","' .$name[0]. '","' .$name[1]. '","' 
        .$_POST["insurance"]. '","' .$_POST["status"]. '","'
        .$_POST["description"]. '")';
        $insertResult = mysqli_query($connection, $insertQuery);
        
        $getNewPatientQuery = 'select * from tbl_217_patients where real_id="' .$_POST["patientId"]. '"';
        $newPatientResult = mysqli_query($connection, $getNewPatientQuery);
        $newPatientRow = mysqli_fetch_assoc($newPatientResult);
        $bedQuery = 'update tbl_217_beds
        set patient_id=' .$newPatientRow["patient_id"].', bed_status="occupied"
        where bed_id=' .$_GET["id"];
        $assignResult = mysqli_query($connection, $bedQuery);

        if ($_SESSION["type"] == "doctor") 
        $updateQuery = 'insert into tbl_217_updates values(0,'.$_GET["id"].','.$newPatientRow["patient_id"].',"'.$_SESSION["usr"].'
        ","The status of bed # '.$_GET["id"].' has been changed to occupied by Dr. ' .$_SESSION["fname"]. ' ' .$_SESSION["lname"]. '. ",DATE_ADD(now(), interval 10 hour))';
        
        else
        $updateQuery = 'insert into tbl_217_updates values(0,'.$_GET["id"].','.$newPatientRow["patient_id"].',"'.$_SESSION["usr"].'
        ","The status of bed # '.$_GET["id"].' has been changed to occupied by ' .$_SESSION["fname"]. ' ' .$_SESSION["lname"]. '. ",DATE_ADD(now(), interval 10 hour))';

        $updateResult = mysqli_query($connection, $updateQuery);

        unset($_POST["patientName"]);
        $redirect = "bed.php?id=" .$_GET["id"];
        header('Location:' . $redirect);
    }

    
?>

<?php
    if (isset($_GET["task"])) {
        $insertTaskQuery = 'insert into tbl_217_tasks values('.$_GET["task"].',0,"'.$_SESSION["usr"].'",
        "Active","'.$_POST["newTaskName"].'",DATE_ADD(now(), interval 10 hour),"Not Completed")';
        $insertTaskResult = mysqli_query($connection, $insertTaskQuery);

        if ($_SESSION["type"] == "doctor") 
        $updateQuery = 'insert into tbl_217_updates values(0,'.$_GET["task"].',1,"'.$_SESSION["usr"].'
        ","The task list of bed # '.$_GET["task"].' has been updated by Dr. ' .$_SESSION["fname"]. ' ' .$_SESSION["lname"]. '. ",DATE_ADD(now(), interval 10 hour))';
        
        else
        $updateQuery = 'insert into tbl_217_updates values(0,'.$_GET["task"].',1,"'.$_SESSION["usr"].'
        ","The task list of bed # '.$_GET["task"].' has been updated by ' .$_SESSION["fname"]. ' ' .$_SESSION["lname"]. '. ",DATE_ADD(now(), interval 10 hour))';

        $updateResult = mysqli_query($connection, $updateQuery);
        $redirect = "tasks.php?id=" .$_GET["task"];
        unset($_GET["task"]);
        header('Location:'.$redirect);
    }


?>

<?php
    if (isset($_GET["taskCompleted"])) {
        $completeTaskQuery = 'update tbl_217_tasks 
        set staff_id="'.$_SESSION["usr"]. '", task_status="Completed", 
        time_performed=DATE_ADD(now(), interval 10 hour) where task_id='.$_GET["taskCompleted"];
        $completeTaskResult = mysqli_query($connection, $completeTaskQuery);

        if ($_SESSION["type"] == "doctor") 
        $updateQuery = 'insert into tbl_217_updates values(0,'.$_GET["bed"].',1,"'.$_SESSION["usr"].'
        ","The task list of bed # '.$_GET["bed"].' has been updated by Dr. ' .$_SESSION["fname"]. ' ' .$_SESSION["lname"]. '. ",DATE_ADD(now(), interval 10 hour))';
        
        else
        $updateQuery = 'insert into tbl_217_updates values(0,'.$_GET["bed"].',1,"'.$_SESSION["usr"].'
        ","The task list of bed # '.$_GET["bed"].' has been updated by ' .$_SESSION["fname"]. ' ' .$_SESSION["lname"]. '. ",DATE_ADD(now(), interval 10 hour))';

        $updateResult = mysqli_query($connection, $updateQuery);
        $redirect = "tasks.php?id=".$_GET["bed"];
        unset($_GET["taskCompleted"]);
        unset($_GET["bed"]);
        header('Location:'.$redirect);
    }
?>



<?php
    if (isset($_GET["maintenance"])) {

        if ($_SESSION["type"] == "doctor") 
        $updateQuery = 'insert into tbl_217_updates values(0,'.$_GET["maintenance"].',1,"'.$_SESSION["usr"].'
        ","Dr. '.$_SESSION["fname"].' ' .$_SESSION["lname"]. ' has requested maintenance for bed # ' .$_GET["maintenance"]. '.",DATE_ADD(now(), interval 10 hour))';
        
        else
        $updateQuery = 'insert into tbl_217_updates values(0,'.$_GET["maintenance"].',1,"'.$_SESSION["usr"].'
        ","'.$_SESSION["fname"].' ' .$_SESSION["lname"]. ' has requested maintenance for bed # ' .$_GET["maintenance"]. '.",DATE_ADD(now(), interval 10 hour))';

        $updateResult = mysqli_query($connection, $updateQuery);
        unset($_GET["maintenance"]);
        $redirect = "notifications.php";
        header('Location:' . $redirect);
    }



?>



<?php
    if (isset($_POST["newBedId"])) {
        $insertQuery = 'insert into tbl_217_beds values(' .$_POST["newBedId"]. ',' .$_POST["newBedWard"]. ',' .$_POST["newBedRoom"]. ',1,"unoccupied")';
        $insert = mysqli_query($connection, $insertQuery);
        $redirect = "index.php";
        header('Location:' . $redirect);
    }
?>