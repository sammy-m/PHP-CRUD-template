<?php
// Include config file
require_once "config/dbconnect.php";
 
// Check existence of id parameter before processing further
/*if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){*/
    
    // Prepare a select statement
    $sql = "DELETE FROM repairs where id = ?";
    
    if($stmt = $conn->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);
        
        // Set parameters
        $param_id = trim($_POST["delete"]); 
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            $result = $stmt->get_result();
            
           // if($result->num_rows > 0){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
               // $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
              /*  $name = $row["name"];
                $address = $row["address"];
                $salary = $row["salary"]; */
               // print_r($rows);
               header("location: index.php");
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    //}
     
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
 