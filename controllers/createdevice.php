<?php 
session_start();
include_once '../config/dbconnect.php';
if(isset($_POST['submit'])){

    unset($_SESSION['deviceNameErr']);
    unset($_SESSION['imeiErr']);
    unset($_SESSION['customerErr']);
    unset($_SESSION['servicedByErr']);
    unset($_SESSION['descriptionErr']);
    unset($_SESSION['dateErr']);
    unset($_SESSION['costErr']);



//get the data and validate it

	$IdeviceName = trim($_POST['deviceName']);

	 if(empty($IdeviceName)){
        $deviceNameErr = "Please enter a name.";
        $_SESSION['deviceNameErr'] = $deviceNameErr;

        //header("location : ../createdevices.php");
    } elseif(strlen($IdeviceName) < 2 ){
        $deviceNameErr = "Please enter a valid name.";
        $_SESSION['deviceNameErr'] = $deviceNameErr;

        //header("location: ../createdevices.php");
    } else{
        $deviceName =  mysqli_real_escape_string($conn, $IdeviceName);
    }

	$Iimei = trim($_POST['imei']);
     if(empty($Iimei)){
        $imeiErr = "Please enter an IMEI number";
        $_SESSION['imeiErr'] = $imeiErr;

        //header("location : ../createdevices.php");
    } elseif(strlen($Iimei) < 2 ){
        $imeiErr = "Please enter a valid IMEI number.";
        $_SESSION['imeiErr'] = $imeiErr;

        //header("location: ../createdevices.php");
    } else{
        $imei = mysqli_real_escape_string($conn, $Iimei);
    }

    $Icustomer = trim($_POST['customer']);
     if(empty($Icustomer)){
        $customerErr = "Please enter the customer's name";
        $_SESSION['customerErr'] = $customerErr;

        //header("location : ../createdevices.php");
    } elseif(strlen($Icustomer) < 2 ){
        $customerErr = "name cannot be that short.";
        $_SESSION['customerErr'] = $customerErr;

        //header("location: ../createdevices.php");
    } else{
        $customer =  mysqli_real_escape_string($conn, $Icustomer);
    }

    $IservicedBy = trim($_POST['servicedBy']);
     if(empty($IservicedBy)){
        $servicedByErr = "enter the name of the person servicing";
        $_SESSION['servicedByErr'] = $servicedByErr;

       // echo 'i am empty';

        //header("location : ../createdevices.php");
    } else{
        $servicedBy =  mysqli_real_escape_string($conn, $IservicedBy);
        //echo 'i am here';
    }

    $Idescription = trim($_POST['description']);
     if(empty($Idescription)){
        $descriptionErr = "Please describe the device mulfunction";
        $_SESSION['descriptionErr'] = $descriptionErr;

        //header("location : ../createdevices.php");
    } elseif(strlen($Idescription) < 10 ){
        $descriptionErr = "minimum 10 words";
        $_SESSION['descriptionErr'] = $descriptionErr;

        //header("location: ../createdevices.php");
    } else{
        $description =  mysqli_real_escape_string($conn, $Idescription);
    }


        $Idate = trim($_POST['date']);
     if(empty($Idate)){
        $dateErr = "Please input the date";
        $_SESSION['dateErr'] = $dateErr;

        //header("location : ../createdevices.php");
    } else{
        $date =  mysqli_real_escape_string($conn, $Idate);
    }

        $Icost = trim($_POST['cost']);
     if($Icost == 0){
        $costErr = "Service is not free";
        $_SESSION['costErr'] = $costErr;

        //header("location : ../createdevices.php");
    } elseif($Icost < 0 ){
        $costErr = "enter a valid cost";
        $_SESSION['costErr'] = $costErr;

        //header("location: ../createdevices.php");
    } else{
        $cost =  mysqli_real_escape_string($conn, $Icost);
    }



if(empty($_SESSION['deviceNameErr']) && empty($_SESSION['imeiErr']) && empty($_SESSION['customerErr']) && empty($_SESSION['servicedByErr']) && empty($_SESSION['dateErr']) && empty($_SESSION['costErr']) && empty($_SESSION['descriptionErr'])){

    echo 'the value od sesdBy is '. $description;

      $sql = "INSERT INTO repairs(deviceName, Customer, problemDescription, servicedBy, imeiNumber, dateBrought, cost) VALUES('$deviceName', '$customer', '$description', '$servicedBy', '$imei', '$date', '$cost')";

      if(mysqli_query($conn, $sql)){
        header("location: ../index.php");
      } else{
          echo 'ERROR'. mysqli_error($conn);
      }
 
        

} else{

    header("location: ../createdevices.php");
}
//
}




