<?php
// Include config file
require_once "config.php";

$sql = "SELECT * FROM servicecost_view";

if ($result = mysqli_query($conn, $sql)) {
    $row = mysqli_fetch_array($result);
} else {
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<meta charset="utf-8">


<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>View Record</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css">
            .wrapper{
                width: 1200px;
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
                            <h1>Services's cost</h1>
                        </div>
                        <?php
                        if ($result = mysqli_query($conn, $sql)) {

                            if (mysqli_num_rows($result) > 0) {
                                echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                echo "<tr>";

                                echo "<th>Customer ID</th>";
                                echo "<th>Service ID</th>";
                                echo "<th>Charge Amount</th>";
                                echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                $row = mysqli_fetch_array($result);
                                while ($row) {
                                    $x = $row['NFCID'];
                                    $y = $row['Service_ID'];
                                    $customer = array();
                                    $services = array();
                                    echo "<tr>";
                                    echo "<td>" . $row['NFCID'] . "</td>";
                                    echo "<td>" . $row['Service_ID'] . "</td>";
                                    while ($row['NFCID'] == $x && $row['Service_ID'] == $y) {
                                        array_push($customer, $row['Charge_Amount']);
                                        $row = mysqli_fetch_array($result);
                                    }
                                    $prev_customer = '';
                                    echo "<td>";
                                    for ($i = 0; $i < count($customer); $i++) {
                                        if ($prev_customer != $customer[$i])
                                            echo $customer[$i] . "<br>";
                                        $prev_customer = $customer[$i];
                                    }
                                    //echo "<td>";
                                    $prev_services = '';
                                    //echo "<td>";
                                    for ($i = 0; $i < count($services); $i++) {
                                        if ($prev_services != $services[$i])
                                            echo $services[$i] . "<br>";
                                        $prev_services = $services[$i];
                                    }
                                }
                                echo "</tbody>";
                                echo "</table>";
                                // Free result set
                                mysqli_free_result($result);
                            } else {
                                echo "<p class='lead'><em>No records were found.</em></p>";
                            }
                        } else {
                            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                        }

// Close connection
                        mysqli_close($conn);
                        ?>
                        <p><a href="index.php" class="btn btn-primary">Back</a></p>
                        <br><br><br>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
