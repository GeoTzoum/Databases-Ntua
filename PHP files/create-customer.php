<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$first_name = $last_name = $birth_date = $id_number = $id_type = $id_issuing_authority = "";
$first_name_err = $last_name_err = $birth_date_err = $id_number_err = $id_type_err = $id_issuing_authority_err  = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate first name
    $input_first_name = trim($_POST["First_Name"]);
    if (empty($input_first_name)) {
        $first_name_err = "Please enter customer's first name.";
    } elseif (!filter_var($input_first_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[A-Za-zΑ-Ωα-ωίϊΐόάέύϋΰήώπρστυφχψς\s]+$/")))) {
        $first_name_err = "Please enter a valid name(Greek or English).";
    } else {
        $first_name = $input_first_name;
    }

    // Validate last name
    $input_last_name = trim($_POST["Last_Name"]);
    if (empty($input_last_name)) {
        $last_name_err = "Please enter customer's last name.";
    } elseif (!filter_var($input_last_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[A-Za-zΑ-Ωα-ωίϊΐόάέύϋΰήώπρστυφχψς\s]+$/")))) {
        $last_name_err = "Please enter a valid name(Greek or English).";
    } else {
        $last_name = $input_last_name;
    }

    // Validate date of birth
    $input_birth_date = trim($_POST["Birth_Date"]);

    $dateExploded = explode("-", $input_birth_date);

    if (empty($input_birth_date)) {
        $birth_date_err = "Please enter customer's date of birth.";
    } elseif (count($dateExploded) == 3) {
        $day = $dateExploded[2];
        $month = $dateExploded[1];
        $year = $dateExploded[0];
        if (!checkdate($month, $day, $year)) {
            $birth_date_err = $input_birth_date . ' is not a valid date!';
        } else {
            $birth_date = $input_birth_date;
        }
    } else {
        $birth_date_err = "Invalid date format!";
    }

    // Validate id number
    $input_id_number = trim($_POST["ID_Number"]);
    if (empty($input_id_number)) {
        $id_number_err = "Please enter id_number.";
    } elseif (!ctype_digit($input_id_number))  {
        $id_number_err = "Please enter a number";
    } else {
        $id_number = $input_id_number;
    }

    // Validate type
    $input_id_type = trim($_POST["ID_Type"]);
    if (empty($input_id_type)) {
        $id_type_err = "Please enter id type.";
    } elseif (!filter_var($input_first_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[A-Za-zΑ-Ωα-ωίϊΐόάέύϋΰήώπρστυφχψς\s]+$/"))))  {
        $id_type_err = "Please enter a valid type.";
    } else {
        $id_type = $input_id_type;
    }

    // Validate authority
    $input_id_issuing_authority = trim($_POST["ID_Issuing_Authority"]);
    if (empty($input_id_issuing_authority)) {
        $id_issuing_authority_err = "Please enter id issuing authority.";
    } elseif (!filter_var($input_id_issuing_authority, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[A-Za-zΑ-Ωα-ωίϊΐόάέύϋΰήώπρστυφχψς\s]+$/")))) {
        $id_issuing_authority_err = "Please enter a valid ID_Issuing_Authority(Greek or English).";
    } else {
        $id_issuing_authority = $input_id_issuing_authority;
    }


    // Check input errors before inserting in database
    if (empty($first_name_err) && empty($last_name_err) && empty($birth_date_err) && empty($id_number_err) && empty($id_type_err) && empty($id_issuing_authority_err)) {
        // Prepare an insert statement

        $sql = "INSERT INTO customers (First_Name, Last_Name, Birth_Date, ID_number, ID_Type, ID_Issuing_Authority) VALUES ('$first_name', '$last_name', '$birth_date', '$id_number', '$id_type', '$id_issuing_authority')";

        if ($stmt = mysqli_prepare($conn, $sql)) {

            if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to landing page
                header("location: customers.php");
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
                            <h2>Create Customer</h2>
                        </div>
                        <p>Please fill this form and submit to add a customer to the database.</p>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group <?php echo (!empty($first_name_err)) ? 'has-error' : ''; ?>">
                                <label>First Name</label>
                                <input type="text" name="First_Name" class="form-control" value="<?php echo $first_name; ?>">
                                <span class="help-block"><?php echo $first_name_err; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($last_name_err)) ? 'has-error' : ''; ?>">
                                <label>Last Name</label>
                                <input type="text" name="Last_Name" class="form-control" value="<?php echo $last_name; ?>">
                                <span class="help-block"><?php echo $last_name_err; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($birth_date_err)) ? 'has-error' : ''; ?>">
                                <label>Date of Birth</label>
                                <input type="date" name="Birth_Date" class="form-control" value="<?php echo $birth_date; ?>" >
                                <span class="help-block"><?php echo $birth_date_err; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($id_number_err)) ? 'has-error' : ''; ?>">
                                <label>ID Number</label>
                                <input type="text" name="ID_Number" class="form-control" value="<?php echo $id_number; ?>">
                                <span class="help-block"><?php echo $id_number_err; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($id_type_err)) ? 'has-error' : ''; ?>">
                                <label>Id Type</label>
                                <input type="text" name="ID_Type" class="form-control" value="<?php echo $id_type; ?>">
                                <span class="help-block"><?php echo $id_type_err; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($id_issuing_authority_err)) ? 'has-error' : ''; ?>">
                                <label>ID Issuing Authority</label>
                                <input type="text" name="ID_Issuing_Authority" class="form-control" value="<?php echo $id_issuing_authority; ?>">
                                <span class="help-block"><?php echo $id_issuing_authority_err; ?></span>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Submit">
                            <a href="customers.php" class="btn btn-default">Cancel</a>
                        </form>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
