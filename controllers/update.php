<?php
session_start();
include_once '../config/dbconnect.php';
if(isset($_POST['updatehere'])){

///die('i am here');

unset($_SESSION['UdeviceNameErr']);
unset($_SESSION['UimeiErr']);
unset($_SESSION['UcustomerErr']);
unset($_SESSION['UservicedByErr']);
unset($_SESSION['UdescriptionErr']);
unset($_SESSION['UdateErr']);
unset($_SESSION['UcostErr']);
unset($_SESSION['errId']);
//get the data and validate it
$recordId = trim($_POST['id']);

$IdeviceName = trim($_POST['deviceName']);

 if(empty($IdeviceName)){
    $deviceNameErr = "Please enter a name.";
    $_SESSION['UdeviceNameErr'] = $deviceNameErr;

    //header("location : ../createdevices.php");
} elseif(strlen($IdeviceName) < 2 ){
    $deviceNameErr = "Please enter a valid name.";
    $_SESSION['UdeviceNameErr'] = $deviceNameErr;

    //header("location: ../createdevices.php");
} else{
    $deviceName =  mysqli_real_escape_string($conn, $IdeviceName);
}

$Iimei = trim($_POST['imei']);
 if(empty($Iimei)){
    $imeiErr = "Please enter an IMEI number";
    $_SESSION['UimeiErr'] = $imeiErr;

    //header("location : ../createdevices.php");
} elseif(strlen($Iimei) < 2 ){
    $imeiErr = "Please enter a valid IMEI number.";
    $_SESSION['UimeiErr'] = $imeiErr;

    //header("location: ../createdevices.php");
} else{
    $imei = mysqli_real_escape_string($conn, $Iimei);
}

$Icustomer = trim($_POST['customer']);
 if(empty($Icustomer)){
    $customerErr = "Please enter the customer's name";
    $_SESSION['UcustomerErr'] = $customerErr;

    //header("location : ../createdevices.php");
} elseif(strlen($Icustomer) < 2 ){
    $customerErr = "name cannot be that short.";
    $_SESSION['UcustomerErr'] = $customerErr;

    //header("location: ../createdevices.php");
} else{
    $customer =  mysqli_real_escape_string($conn, $Icustomer);
}

$IservicedBy = trim($_POST['servicedBy']);
 if(empty($IservicedBy)){
    $servicedByErr = "enter the name of the person servicing";
    $_SESSION['UservicedByErr'] = $servicedByErr;

   // echo 'i am empty';

    //header("location : ../createdevices.php");
} else{
    $servicedBy =  mysqli_real_escape_string($conn, $IservicedBy);
    //echo 'i am here';
}

$Idescription = trim($_POST['description']);
 if(empty($Idescription)){
    $descriptionErr = "Please describe the device mulfunction";
    $_SESSION['UdescriptionErr'] = $descriptionErr;

    //header("location : ../createdevices.php");
} elseif(strlen($Idescription) < 10 ){
    $descriptionErr = "minimum 10 words";
    $_SESSION['UdescriptionErr'] = $descriptionErr;

    //header("location: ../createdevices.php");
} else{
    $description =  mysqli_real_escape_string($conn, $Idescription);
}


    $Idate = trim($_POST['date']);
 if(empty($Idate)){
    $dateErr = "Please input the date";
    $_SESSION['UdateErr'] = $dateErr;

    //header("location : ../createdevices.php");
} else{
    $date =  mysqli_real_escape_string($conn, $Idate);
}

    $Icost = trim($_POST['cost']);
 if($Icost == 0){
    $costErr = "Service is not free";
    $_SESSION['UcostErr'] = $costErr;

    //header("location : ../createdevices.php");
} elseif($Icost < 0 ){
    $costErr = "enter a valid cost";
    $_SESSION['UcostErr'] = $costErr;

    //header("location: ../createdevices.php");
} else{
    $cost =  mysqli_real_escape_string($conn, $Icost);
}



if(empty($_SESSION['UdeviceNameErr']) && empty($_SESSION['UimeiErr']) && empty($_SESSION['UcustomerErr']) && empty($_SESSION['UservicedByErr']) && empty($_SESSION['UdateErr']) && empty($_SESSION['UcostErr']) && empty($_SESSION['UdescriptionErr'])){

//echo 'the value od sesdBy is '. $description;

$sql = "UPDATE repairs SET  deviceName = '$deviceName', servicedBy ='$servicedBy', imeiNumber ='$imei', dateBrought='$date',
                            Customer = '$customer', problemDescription ='$description', cost='$cost' WHERE id =$recordId";

                           // die($sql);

 // $sql = "INSERT INTO repairs(deviceName, Customer, problemDescription, servicedBy, imeiNumber, dateBrought, cost) VALUES('$deviceName', '$customer', '$description', '$servicedBy', '$imei', '$date', '$cost')";

  if(mysqli_query($conn, $sql)){
    header("location: ../index.php");
  } else{
      echo 'ERROR'. mysqli_error($conn);
  }

    

} else{

    //die('this is the record id'.$recordId);

 $_SESSION['errId'] = $recordId;
 header("location: ../update.php");
}

}
//
?>