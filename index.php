<?php
// Include config file
require_once "config/dbconnect.php";
 
// Check existence of id parameter before processing further
/*if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){*/
    
    // Prepare a select statement
    $sql = "SELECT * FROM repairs";
    
    if($stmt = $conn->prepare($sql)){
        // Bind variables to the prepared statement as parameters
     /*   $stmt->bind_param("i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]); */
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            $result = $stmt->get_result();
            
            if($result->num_rows > 0){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
              /*  $name = $row["name"];
                $address = $row["address"];
                $salary = $row["salary"]; */
               // print_r($rows);
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
 /*else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
} */
?>
 

<?php include 'inc/header.php'; ?>
<div class="container back-grounder">

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
        <div class="container-fluid">
        <h1 style="text-align: center; margin: 0px 0 50px 0; ">Available Repairs</h1>
<a href="createdevices.php" class="btn btn-primary" style="text-align: center !important;">CREATE A NEW REPAIR RECORD</a>

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
                        <th scope="col" colspan="3" style="text-align: center !important;">Actions</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($rows as $row) {?>
                        <tr>
                        <th scope="row"> <?php echo $row['id']; ?> </th>
                        <td> <?php echo $row['deviceName']; ?> </td>
                        <td> <?php echo $row['imeiNumber']; ?> </td>
                        <td> <?php echo $row['Customer']; ?> </td>
                        <td> <?php echo $row['servicedBy']; ?> </td>
                        <td> <?php echo $row['dateBrought']; ?> </td>
                        <td> <?php echo $row['cost']; ?>/= </td>
                        <td> <?php echo $row['problemDescription']; ?> </td>
                        <td> <a href="read.php?id=<?php echo $row['id']; ?>" class="btn btn-success" style="width: 100px !important;"><img src="https://desktop.github.com/images/octicons/file-media.svg">READ</a> </td>
                        <!--td> <a href="/update.php" class="btn btn-warning"><img src="https://img.icons8.com/material-sharp/24/000000/update-file.png">UPDATE</a> </td-->
                        <td><form action="<?php echo ''.'update.php'; ?>" method="POST"><button class="btn btn-warning" type="submit" style="width: 110px !important;" value="<?php  echo $row['id']; ?>" name="update"><img src="https://img.icons8.com/material-sharp/24/000000/update-file.png">UPDATE</button></form></td>
                        <!--td> <a href="/delete.php" class="btn btn-danger"><img src="https://img.icons8.com/material-rounded/24/000000/delete-forever.png">DELETE</a> </td-->
                        <td><form action="delete.php" method="POST"><button class="btn btn-danger" type="submit" value="<?php  echo $row['id']; ?>" style="width: 110px !important;" name="delete"><img src="https://img.icons8.com/material-rounded/24/000000/delete-forever.png">DELETE</button></form></td>
                            
                        </tr>
                    <?php } ?>
                       
                    </tbody>
                </table>

                           
                  
        </div>
    </div>

    
    <?php include 'inc/footer.php'; ?>
<!--/body>
</html-->