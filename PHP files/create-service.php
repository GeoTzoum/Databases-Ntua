<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$service_type = "";
$service_type_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $input_service_type = trim($_POST["Service_Type"]);
    if (empty($input_service_type)) {
        $service_type_err = "Please enter service type.";
    } elseif (!filter_var($input_service_type, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[A-Za-zΑ-Ωα-ωίϊΐόάέύϋΰήώπρστυφχψς\s]+_ /")))) {
        $service_type_err = "Please enter a valid service type(Greek or English and underscores only).";
    } else {
        $service_type = $input_service_type;
    }


    // Check input errors before inserting in database
    if (empty($service_type_err)) {
        // Prepare an insert statement

        $sql = "INSERT INTO services (Service_Type) VALUES ('$service_type')";

        if ($stmt = mysqli_prepare($conn, $sql)) {

            if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
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
    <body>
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header">
                            <h2>Create service</h2>
                        </div>
                        <p>Please fill this form and submit to add a service to the database.</p>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group <?php echo (!empty($service_type_err)) ? 'has-error' : ''; ?>">
                                <label>Service Type</label>
                                <input type="text" name="Service_Type" class="form-control" value="<?php echo $service_type; ?>">
                                <span class="help-block"><?php echo $service_type_err; ?></span>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Submit">
                            <a href="index.php" class="btn btn-default">Cancel</a>
                        </form>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
