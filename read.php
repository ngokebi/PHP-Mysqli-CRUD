<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $read_details = "SELECT * FROM details WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $read_details)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $name = $row["name"];
                $email = $row["email"];
                $address = $row["address"];
                $department = $row["department"];
                $staffID = $row["staffID"];
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
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<body style="background-color:Khaki;">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1 style = "font-family: Colonna MT; font-size:40px; color: Maroon;">View Record</h1>
                    </div>
                    <div class="form-group">
                        <label style = "font-family: Colonna MT; font-size: 20px;">Name :</label>
                        <p class="form-control-static" style = "font-family: Century Gothic;"><?php echo $row["name"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label style = "font-family: Colonna MT; font-size: 20px;">Email :</label>
                        <p class="form-control-static" style = "font-family: Century Gothic;"><?php echo $row["email"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label style = "font-family: Colonna MT; font-size: 20px;">Address :</label>
                        <p class="form-control-static" style = "font-family: Century Gothic;"><?php echo $row["address"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label style = "font-family: Colonna MT; font-size: 20px;">Department :</label>
                        <p class="form-control-static" style = "font-family: Century Gothic;"><?php echo $row["department"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label style = "font-family: Colonna MT; font-size: 20px;">Staff ID</label>
                        <p class="form-control-static" style = "font-family: Century Gothic;"><?php echo $row["staffID"]; ?></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary" style = "font-family: Colonna MT;">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>