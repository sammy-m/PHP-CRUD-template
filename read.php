<?php
// Include config file
require_once "config/dbconnect.php";
 
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    
    // Prepare a select statement
    $sql = "SELECT * FROM repairs WHERE id = ?";
    
    if($stmt = $conn->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            $result = $stmt->get_result();
            
            if($result->num_rows == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = $result->fetch_array(MYSQLI_ASSOC);
                
                // Retrieve individual field value
               /* $deviceName = $row["deviceName"];
                $id = $row["id"];
                $salary = $row["salary"];*/
              //  print_r($row);
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    $stmt->close();
    
    // Close connection
    $conn->close();
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
 
<!--DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body-->
<?php include 'inc/header.php'; ?>

<style>
.back-grounder {
    background: rgb(2,0,36);
background: linear-gradient(180deg, rgba(2,0,36,1) 0%, rgba(196,66,15,1) 0%, rgba(231,40,11,0.74831931063441) 0%, rgba(250,227,6,0.933193260214242) 100%);  
height: 100% !important;
min-width: 100% !important;
height: 100vh !important;
padding-top: 100px;
}
table tbody td{
    color: white;
}
</style>

<div class="container back-grounder">

<h1 style="text-align: center; padding-bottom: 70px;">Read a specific repair instance</h1>

<a href="index.php" class="btn btn-primary" style="text-align: center !important;">BACK</a>

    <table class="table table-hover">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Device Name</th>
            <th scope="col">IMEI Number</th>
            <th scope="col">Customer</th>
            <th scope="col">Serviced By</th>
            <th scope="col">Date</th>
            <th scope="col">Cost</th>
            <th scope="col">Description</th>
            
            
            </tr>
        </thead>
        <tbody>
        
            <tr>
            <th scope="row"> <?php echo $row['id']; ?> </th>
            <td> <?php echo $row['deviceName']; ?> </td>
            <td> <?php echo $row['imeiNumber']; ?> </td>
            <td> <?php echo $row['Customer']; ?> </td>
            <td> <?php echo $row['servicedBy']; ?> </td>
            <td> <?php echo $row['dateBrought']; ?> </td>
            <td> <?php echo $row['cost']; ?>/= </td>
            <td> <?php echo $row['problemDescription']; ?> </td>
            
            </tr>
        
            
        </tbody>
    </table>
</div>


    <?php include 'inc/footer.php'; ?>
<!--/body>
</html-->