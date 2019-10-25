<?php 
session_start();
include_once 'config/dbconnect.php';

$recordId = isset($_POST['update']) ? $_POST['update'] : $_SESSION['errId'] ;
//die( 'this is the record i have'.$recordId);

if(isset($_POST['update']) || isset($recordId)){

   // isset($_SESSION['errID']) ? die('tass') : '';
   // die('tadaa');

    ///////////////////////////////////////////////die('will update');
    unset($_SESSION['deviceNameErr']);
    unset($_SESSION['imeiErr']);
    unset($_SESSION['customerErr']);
    unset($_SESSION['servicedByErr']);
    unset($_SESSION['descriptionErr']);
    unset($_SESSION['dateErr']);
    unset($_SESSION['costErr']);

   

    

    //get original data from database
   // $recordId = isset($_POST['update']) ? $_POST['update'] : $_SESSION['errId'] ;
   // die( 'this is the record i have'.$_POST['update']);
   
   
  ////////////////////////////////////////////  die($recordId);

    $sql = "SELECT * FROM repairs WHERE id = ?";
    
    if($stmt = $conn->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);
        
        $param_id = $recordId;
       // die($param_id);
        
        if($stmt->execute()){
            $result = $stmt->get_result();
            
            if($result->num_rows == 1){
                $row = $result->fetch_array(MYSQLI_ASSOC);

               // print_r($row);
            
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    $stmt->close();
    $conn->close();


//check for supbmit button
if(isset($_POST['updatehere'])){

    die('i am here');

    unset($_SESSION['UdeviceNameErr']);
    unset($_SESSION['UimeiErr']);
    unset($_SESSION['UcustomerErr']);
    unset($_SESSION['UservicedByErr']);
    unset($_SESSION['UdescriptionErr']);
    unset($_SESSION['UdateErr']);
    unset($_SESSION['UcostErr']);
//get the data and validate it

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

    echo 'the value od sesdBy is '. $description;

    $sql = "UPDATE repairs SET  deviceName = '$deviceName', servixedBy ='$servicedBy', imeiNumber ='$imei', dateBrought='$date',
                                Customer = '$customer', problemDescription ='$description', cost='$cost' WHERE id ='$recordId";

                                die($sql);

     // $sql = "INSERT INTO repairs(deviceName, Customer, problemDescription, servicedBy, imeiNumber, dateBrought, cost) VALUES('$deviceName', '$customer', '$description', '$servicedBy', '$imei', '$date', '$cost')";

      if(mysqli_query($conn, $sql)){
        header("location: ../index.php");
      } else{
          echo 'ERROR'. mysqli_error($conn);
      }
 
        

} else{

    echo $_session;
   

   // header("location: /update.php");
}
//
}


}

	include ('inc/header.php');
 ?>
	<div class="container">
		<h1 style="text-align: center;">UPDATE RECORD OF A DEVICE FOR REPAIR</h1>

		<form action=" controllers/update.php" method="POST">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-6">
						<label for="deviceName">Device Name:</label>
					<input type="text" name="deviceName" class="form-control <?php echo (!empty($_SESSION['UdeviceNameErr'])) ? 'is-invalid' : '' ?>" value=" <?php echo (!empty($row['deviceName'])) ? $row['deviceName']: ''; ?> "> 
					<span><small id="passwordHelp" class="text-danger"><?php echo (!empty($_SESSION['UdeviceNameErr'])) ? $_SESSION['UdeviceNameErr'] : '' ?></small></span>
					</div>
					<div class="col-sm-6">
						<label for="imei">Device IMEI no:</label>       
						<input type="text" name="imei" class="form-control <?php echo (!empty($_SESSION['UimeiErr'])) ? 'is-invalid' : '' ?>" value="<?php echo (!empty($row['imeiNumber'])) ? $row['imeiNumber']: '';?> ">
						<span><small id="imei" class="text-danger"><?php echo (!empty($_SESSION['UimeiErr'])) ? $_SESSION['UimeiErr'] : '' ?></small></span>
					</div>
				</div>
				
					<div class="row">
						<div class="col-sm-6 col-md-8 col-lg-8">
							<label for="customer">Name of Customer</label>
							<input type="text" name="customer" class="form-control <?php echo (!empty($_SESSION['UcustomerErr'])) ? 'is-invalid' : '' ?>" value="<?php echo (!empty($row['Customer'])) ? $row['Customer']: '';?> ">
							<span><small id="imei" class="text-danger"><?php echo (!empty($_SESSION['UcustomerErr'])) ? $_SESSION['UcustomerErr'] : '' ?></small></span>
						</div>
						<div class="col-sm-6 col-md-4 col-lg-4">
							<label for="servicedBy">Seviced by:</label>
							<select name="servicedBy" id="servicedBy" class="form-control <?php echo (!empty($_SESSION['UservicedByErr'])) ? 'is-invalid' : '' ?>" value="<?php echo $row['servicedBy']; ?>  ">
                                <?php isset($row['servicedBy']) ? '<option value="'.$row['servicedBy'].'">'.$row['servicedBy'].'/option>':'';?>
								<option value=" <?php echo isset($row['servicedBy']) ? $row['servicedBy']:'';?>"><?php echo isset($row['servicedBy']) ? $row['servicedBy']:'';?></option>
								<option value="Daniel">Daniel</option>
								<option value="Emmanuel">Emmanuel</option>
								<option value="Robert">Robert</option>
								<option value="Daisy">Daisy</option>
							</select>
							<span><small id="imei" class="text-danger"><?php echo (!empty($_SESSION['UservicedByErr'])) ? $_SESSION['UservicedByErr'] : '' ?></small></span>
						</div>
					</div>



				
				<label for="description">Device Mulfunction:</label>
				<textarea  name="description" placeholder="Describe the problems with the device in detail.." class="form-control <?php echo (!empty($_SESSION['UdescriptionErr'])) ? 'is-invalid' : '' ?>" style="min-height: 200px !important;"><?php echo (!empty($row['problemDescription'])) ? $row['problemDescription']: ''; ?></textarea> 
				<span><small id="imei" class="text-danger"><?php echo (!empty($_SESSION['UdescriptionErr'])) ? $_SESSION['UdescriptionErr'] : '' ?></small></span>

				<div class="row">
					<div class="col-sm-6">
						<label for="date">Date Brought In:</label>
						<input type="date" class="form-control <?php echo (!empty($_SESSION['UdateErr'])) ? 'is-invalid' : '' ?>" value="<?php echo $row['date']; ?> " name="date">
						<span><small id="imei" class="text-danger"><?php echo (!empty($_SESSION['UdateErr'])) ? $_SESSION['UdateErr'] : '' ?></small></span>
					</div>
					<div class="col-sm-6">
						<label for="cost"> Cost of Repair (KSh):</label>
						<input type="number" placeholder="0.00" class="form-control <?php echo (!empty($_SESSION['UcostErr'])) ? 'is-invalid' : '' ?>" name="cost" value="<?php echo $row['cost']; ?>">
						<span><small id="imei" class="text-danger"><?php echo (!empty($_SESSION['UcostErr'])) ? $_SESSION['UcostErr'] : '' ?></small></span>
					</div>
				</div>

                <input type="hidden" name='id' value="<?php echo $row['id']; ?>">

				<div class="full-width" style="align-content: center !important; text-align: center !important; min-width: 100%; margin-top: 30px;">
					<input type="submit" name="updatehere" class="btn btn-success" value="UPDATE DEVICE" style="text-align: center !important; justify-content: center !important; align-self: center !important;">
				</div>

				
				
			</div>
		</form>

	<!--p><?php echo print_r($_SESSION);   echo '  param id is '.$recordId; ?></p-->

	<!--p><?php echo $_POST['deviceName'] ?></p-->

	</div>
		
 <?php 
 	include('inc/footer.php'); 
 	?>