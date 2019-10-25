<?php 
session_start();
include_once 'config/dbconnect.php';
if(isset($_POST['update'])){
    unset($_SESSION['deviceNameErr']);
    unset($_SESSION['imeiErr']);
    unset($_SESSION['customerErr']);
    unset($_SESSION['servicedByErr']);
    unset($_SESSION['descriptionErr']);
    unset($_SESSION['dateErr']);
    unset($_SESSION['costErr']);

    //get original data from database
    $recordId = $_POST['update'];

    $sql = "SELECT * FROM repairs WHERE id = ?";
    
    if($stmt = $conn->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);
        
        $param_id = trim($_POST["update"]);
        
        if($stmt->execute()){
            $result = $stmt->get_result();
            
            if($result->num_rows == 1){
                $row = $result->fetch_array(MYSQLI_ASSOC);

                print_r($row);
            
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

    header("location: ../update.php");
}
//


}

	include ('inc/header.php');
 ?>
	<div class="container">
		<h1 style="text-align: center;">UPDATE RECORD OF A DEVICE FOR REPAIR</h1>

		<form action="controllers/createdevice.php" method="POST">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-6">
						<label for="deviceName">Device Name:</label>
					<input type="text" name="deviceName" class="form-control <?php echo (!empty($_SESSION['deviceNameErr'])) ? 'is-invalid' : '' ?>" value=" <?php echo isset($_POST['deviceName']) ? 'haha' : ''; ?> "> 
					<span><small id="passwordHelp" class="text-danger"><?php echo (!empty($_SESSION['deviceNameErr'])) ? $_SESSION['deviceNameErr'] : '' ?></small></span>
					</div>
					<div class="col-sm-6">
						<label for="imei">Device IMEI no:</label>       
						<input type="text" name="imei" class="form-control <?php echo (!empty($_SESSION['imeiErr'])) ? 'is-invalid' : '' ?>" value=" <?php echo isset($_POST['imei']) ? $_POST['imei'] : ''?> ">
						<span><small id="imei" class="text-danger"><?php echo (!empty($_SESSION['imeiErr'])) ? $_SESSION['imeiErr'] : '' ?></small></span>
					</div>
				</div>
				
					<div class="row">
						<div class="col-sm-6 col-md-8 col-lg-8">
							<label for="customer">Name of Customer</label>
							<input type="text" name="customer" class="form-control <?php echo (!empty($_SESSION['customerErr'])) ? 'is-invalid' : '' ?>" value=" <?php echo isset($_POST['customer']) ? $_POST['customer'] : ''?> ">
							<span><small id="imei" class="text-danger"><?php echo (!empty($_SESSION['customerErr'])) ? $_SESSION['customerErr'] : '' ?></small></span>
						</div>
						<div class="col-sm-6 col-md-4 col-lg-4">
							<label for="servicedBy">Seviced by:</label>
							<select name="servicedBy" id="servicedBy" class="form-control <?php echo (!empty($_SESSION['servicedByErr'])) ? 'is-invalid' : '' ?>" value=" <?php echo isset($_POST['servicedBy']) ? $_POST['servicedBy'] : ''?> ">
								<option value=""></option>
								<option value="Daniel">Daniel</option>
								<option value="Emmanuel">Emmanuel</option>
								<option value="Robert">Robert</option>
								<option value="Daisy">Daisy</option>
							</select>
							<span><small id="imei" class="text-danger"><?php echo (!empty($_SESSION['servicedByErr'])) ? $_SESSION['servicedByErr'] : '' ?></small></span>
						</div>
					</div>



				
				<label for="description">Device Mulfunction:</label>
				<textarea  name="description" placeholder="Describe the problems with the device in detail.." class="form-control <?php echo (!empty($_SESSION['descriptionErr'])) ? 'is-invalid' : '' ?>" style="min-height: 200px !important;" value=" <?php echo isset($_POST['description']) ? $_POST['description'] : ''?> "></textarea> 
				<span><small id="imei" class="text-danger"><?php echo (!empty($_SESSION['descriptionErr'])) ? $_SESSION['descriptionErr'] : '' ?></small></span>

				<div class="row">
					<div class="col-sm-6">
						<label for="date">Date Brought In:</label>
						<input type="date" class="form-control <?php echo (!empty($_SESSION['dateErr'])) ? 'is-invalid' : '' ?>" value="<?php date(d,m,Y); ?>" name="date">
						<span><small id="imei" class="text-danger"><?php echo (!empty($_SESSION['dateErr'])) ? $_SESSION['dateErr'] : '' ?></small></span>
					</div>
					<div class="col-sm-6">
						<label for="cost"> Cost of Repair (KSh):</label>
						<input type="number" placeholder="0.00" class="form-control <?php echo (!empty($_SESSION['costErr'])) ? 'is-invalid' : '' ?>" name="cost" value=" <?php echo isset($_POST['cost']) ? $_POST['cost'] : ''?> ">
						<span><small id="imei" class="text-danger"><?php echo (!empty($_SESSION['costErr'])) ? $_SESSION['costErr'] : '' ?></small></span>
					</div>
				</div>

				<div class="full-width" style="align-content: center !important; text-align: center !important; min-width: 100%; margin-top: 30px;">
					<input type="submit" name="update" class="btn btn-success" value="UPDATE DEVICE" style="text-align: center !important; justify-content: center !important; align-self: center !important;">
				</div>

				
				
			</div>
		</form>

	<!--p><?php echo print_r($_SESSION); ?></p>

	<p><?php echo $_POST['deviceName'] ?></p-->

	</div>
		
 <?php 
 	include('inc/footer.php'); 
 	?>