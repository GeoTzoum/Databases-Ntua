<?php
$services_id = $_REQUEST["id"];

$sql = "SELECT customer_id, Charge_Date_Time
FROM use_services AS U, customers AS C, services AS S
WHERE U.service_id = S.Service_ID AND U.customer_id = C.NFCID AND U.Service_ID = $services_id;";


$query = "Select Service_Type from services
where Service_ID = $services_id;";

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
                            <?php
                            require_once "config.php";
                            $result = mysqli_query($conn, $query);
                            $row = mysqli_fetch_array($result);
                            ?>

                            <h2> <?php echo $row['Service_Type']  ?></h2>
                        </div>

                        <?php

                        if ($result = mysqli_query($conn, $sql)) {
                            //echo $result -> num_rows;
                            if (mysqli_num_rows($result) > 0) {
                                echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                echo "<tr>";
                                echo "<th>NFCID</th>";
                                echo "<th>Charge Date Time</th>";
                                echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";

                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['customer_id'] . "</td>";
                                    echo "<td>" . $row['Charge_Date_Time'] . "</td>";
                                    echo "</tr>";
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
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
