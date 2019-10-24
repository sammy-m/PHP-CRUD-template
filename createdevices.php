<?php 
require_once "config/dbconnect.php";
session_start();
?>

<?php 
	include ('inc/header.php');
 ?>
	<div class="container">
		<h1 style="text-align: center;">REGISTER A DEVICE FOR REPAIR</h1>

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
				

				


								 <!--div class="form-group row">
      <label for="inputPassword" class="col-sm-2 col-form-label text-danger">Password</label>
      <div class="col-sm-7">
        <input type="password" class="form-control is-invalid" id="inputPassword" placeholder="Password">
      </div>
      <div class="col-sm-3">
        <small id="passwordHelp" class="text-danger">
          Must be 8-20 characters long.
        </small>      
      </div>
    </div-->



				
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
					<input type="submit" name="submit" class="btn btn-success" value="Add Device" style="text-align: center !important; justify-content: center !important; align-self: center !important;">
				</div>

				
				
			</div>
		</form>

	<!--p><?php echo print_r($_SESSION); ?></p>

	<p><?php echo $_POST['deviceName'] ?></p-->

	</div>
		
 <?php 
 	include('inc/footer.php'); 
 	?>