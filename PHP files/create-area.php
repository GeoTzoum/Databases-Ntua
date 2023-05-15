<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$number_of_beds = $area_name = $area_description = "";
$number_of_beds_err = $area_name_err = $area_description_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $input_number_of_beds = trim($_POST["Number_Of_Beds"]);
    if(!empty($input_number_of_beds) && !ctype_digit($input_number_of_beds)){
      $number_of_beds_err = "Please enter a number or nothing";
    } else{
        $number_of_beds = $input_number_of_beds;
}

    $input_area_name = trim($_POST["Area_Name"]);
    if (empty($input_area_name)) {
        $area_name_err = "Please enter Area Name.";
    } else {
        $area_name = $input_area_name;
    }

    $input_area_description = trim($_POST["Area_Description"]);
    if (empty($input_area_description)) {
        $area_description_err = "Please enter area description.";
    } elseif (!filter_var($input_area_description, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[A-Za-zΑ-Ωα-ωίϊΐόάέύϋΰήώπρστυφχψς\s]+$ /")))) {
        $area_description_err = "Please enter a valid area description(Greek or English).";
    } else {
        $area_description = $input_area_description;
    }


    // Check input errors before inserting in database
    if (empty($area_name_err) && empty($number_of_beds_err) && empty($area_description_err)) {
        // Prepare an insert statement

        $sql = "INSERT INTO areas (Area_Name, Number_Of_Beds, Area_Description) VALUES ('$area_name', '$number_of_beds', '$area_description')";

        if ($stmt = mysqli_prepare($conn, $sql)) {

            if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to landing page
                header("location: areas.php");
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
                            <h2>Create area</h2>
                        </div>
                        <p>Please fill this form and submit to add an area to the database.</p>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group <?php echo (!empty($area_name_err)) ? 'has-error' : ''; ?>">
                                <label>Area Name</label>
                                <input type="text" name="Area_Name" class="form-control" value="<?php echo $area_name; ?>">
                                <span class="help-block"><?php echo $area_name_err; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($number_of_beds_err)) ? 'has-error' : ''; ?>">
                                <label>Number of Beds</label>
                                <input type="text" name="Number_Of_Beds" class="form-control" value="<?php echo $number_of_beds; ?>">
                                <span class="help-block"><?php echo $number_of_beds_err; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($area_description_err)) ? 'has-error' : ''; ?>">
                                <label>Area description</label>
                                <input type="text" name="Area_Description" class="form-control" value="<?php echo $area_description; ?>" >
                                <span class="help-block"><?php echo $area_description_err; ?></span>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Submit">
                            <a href="areas.php" class="btn btn-default">Cancel</a>
                        </form>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
