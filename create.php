<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name = $email = $address = $department = $staffID =  "";
$name_err = $email_err = $address_err = $department_err = $staffID_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    // Validate email
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Please enter your email.";     
    } elseif(!preg_match("/[a-zA-Z0-9._-]{3,}@[a-zA-Z0-9._-]{3,}[.]{1}[a-zA-Z0-9._-]{2,}/",$input_email)){
        $email_err = "Please enter a valid email";
    }else{
        $email = $input_email;
    }

    // Validate address
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Please enter an address.";     
    } else{
        $address = $input_address;
    }

    // Validate department
    $input_department = trim($_POST["department"]);
    if(empty($input_department)){
        $department_err = "Please enter Staff's department.";     
    } elseif(!preg_match("/^[A-Za-z\. ]*$/",$input_department)){
        $department_err = "Invalid Input";
    }else{
        $department = $input_department;
    }
    
    // Validate Staff ID
    $input_staffID = trim($_POST["staffID"]);
    if(empty($input_staffID)){
        $staffID_err = "Please enter the Staff ID.";     
    } elseif(!abs($input_staffID)){
        $staffID_err = "Please enter a positive staffID.";
    } else{
        $staffID = $input_staffID;
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($email_err) && empty($address_err) && empty($department_err) && empty($staffID_err)) {
        // Prepare an insert statement
        $insert_details = "INSERT INTO details (name, email, address, department, staffID) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $insert_details)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_name, $param_email, $param_address, $param_department, $param_staffID);
            
            // Set parameters
            $param_name = $name;
            $param_email = $email;
            $param_address = $address;
            $param_department = $department;
            $param_staffID = $staffID;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                echo "<script> alert('Records has been successfully Created!!') </script>";
                echo "<script> window.open('index.php','_self') </script>";
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<body style="background-color:Khaki;">
<head>
    <meta charset="UTF-8">
    <title>Create Staff Record</title>
    <link rel = "stylesheet" href = "include/style.css">
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
                        <h2 style = "font-family: Colonna MT; font-size:40px; color: Maroon;">Create Record</h2>
                    </div>
                    <p style = "font-family: Colonna MT; font-size: 20px;">Please fill this form and submit to add Staff record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label style = "font-family: Colonna MT; font-size: 20px;">Name :</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" style = "font-family: Century Gothic;">
                            <span class="help-block" style = "font-family: Colonna MT; font-size: 20px;"><?php echo $name_err;?></span>
                        </div> 
                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <label style = "font-family: Colonna MT; font-size: 20px;">Email :</label>
                            <input name="email" class="form-control" value = "<?php echo $email; ?>" style = "font-family: Century Gothic;">
                            <span class="help-block" style = "font-family: Colonna MT; font-size: 20px;"><?php echo $email_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                            <label style = "font-family: Colonna MT; font-size: 20px;">Address :</label>
                            <textarea name="address" class="form-control" style = "font-family: Century Gothic;"><?php echo $address; ?></textarea>
                            <span class="help-block" style = "font-family: Colonna MT; font-size: 20px;"><?php echo $address_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($department_err)) ? 'has-error' : ''; ?>">
                            <label style = "font-family: Colonna MT; font-size: 20px;">Department :</label>
                            <input name="department" class="form-control" value = "<?php echo $department; ?>" style = "font-family: Century Gothic;">
                            <span class="help-block" style = "font-family: Colonna MT; font-size: 20px;"><?php echo $department_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($staffID_err)) ? 'has-error' : ''; ?>">
                            <label style = "font-family: Colonna MT; font-size: 20px;">Staff ID :</label>
                            <input type="text" name="staffID" class="form-control" value="<?php echo $staffID; ?>" style = "font-family: Century Gothic;">
                            <span class="help-block" style = "font-family: Colonna MT; font-size: 20px;"><?php echo $staffID_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit" style = "font-family: Colonna MT;">
                        <a href="index.php" class="btn btn-default" style = "font-family: Colonna MT;">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>