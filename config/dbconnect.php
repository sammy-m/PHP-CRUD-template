<?php
require('conf.php');

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	#check connection
if(mysqli_connect_errno()) {
	echo 'Database error!'.' '.mysqli_connect_errno();
}

 ?>

