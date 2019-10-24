<?php 
require_once "../../config/dbconnect.php";

?>

<?php 
	include ('../../inc/header.php');
 ?>
	<div class="container">
		<h1 style="text-align: center;">REGISTER A DEVICE FOR REPAIR</h1>

		<form action="controllers/createdevice.php" method="POST">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-6">
						<label for="deviceName">Device Name:</label>
						<input type="text" name="deviceName" class="form-control <?php echo (!empty($deviceNameErr)) ? 'is-invalid' : ''; ?>">
					</div>
					<div class="col-sm-6">
						<label for="imei">Device IMEI no:</label>
						<input type="text" name="imei" class="form-control">
					</div>
				</div>
				
					<div class="row">
						<div class="col-sm-6 col-md-8 col-lg-8">
							<label for="customer">Name of Customer</label>
							<input type="text" name="customer" class="form-control">
						</div>
						<div class="col-sm-6 col-md-4 col-lg-4">
							<label for="servicedBy">Seviced by:</label>
							<select name="servicedBy" id="servicedBy" class="form-control">
								<option value=""></option>
								<option value="Daniel">Daniel</option>
								<option value="Emmanuel">Emmanuel</option>
								<option value="Robert">Robert</option>
								<option value="Daisy">Daisy</option>
							</select>
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
				<textarea  placeholder="Describe the problems with the device in detail.." class="form-control" style="min-height: 200px !important;"></textarea> 

				<div class="row">
					<div class="col-sm-6">
						<label for="date">Date Brought In:</label>
						<input type="date" class="form-control" value="<?php date(dd,mm,Y); ?>">
					</div>
					<div class="col-sm-6">
						<label for="cost"> Cost of Repair (KSh):</label>
						<input type="number" placeholder="0.00" class="form-control">
					</div>
				</div>

				<div class="full-width" style="align-content: center !important; text-align: center !important; min-width: 100%; margin-top: 30px;">
					<input type="submit" name="submit" class="btn btn-success" value="Add Device" style="text-align: center !important; justify-content: center !important; align-self: center !important;">
				</div>

				
				
			</div>
		</form>

	</div>
		
 <?php 
 	include('../../inc/footer.php'); 
 	?>