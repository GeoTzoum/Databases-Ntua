<?php
$customers_id = $_REQUEST["id"];

$sql = "SELECT DISTINCT c1.NFCID, c1.First_Name, c1.Last_Name, c1.Birth_Date, c1.ID_Number, c1.ID_Type, c1.ID_Issuing_Authority
FROM customers as c1,customers AS c2, visit as v1,visit as v2, areas AS A
WHERE c2.NFCID = '$customers_id' AND v2.customer_id = c2.NFCID AND v2.areas_id = A.Area_ID AND c1.NFCID = v1.customer_id AND v1.areas_id = v2.areas_id
AND (v1.Entrance_Date_Time BETWEEN DATE_ADD(v2.Entrance_Date_Time, INTERVAL -60 MINUTE) AND DATE_ADD(v2.Exit_Date_Time, INTERVAL 60 MINUTE) OR v2.Entrance_Date_Time BETWEEN v1.Entrance_Date_Time AND v1.Exit_Date_Time)
AND c1.NFCID != '$customers_id' AND v1.areas_id = A.Area_id;";


$query = "Select First_Name, Last_Name from customers
where NFCID = $customers_id;";

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

                            <h2> <?php echo 'Possible Instances'; ?></h2>
                        </div>

                        <?php

                        if ($result = mysqli_query($conn, $sql)) {
                            //echo $result -> num_rows;
                            if (mysqli_num_rows($result) > 0) {
                                echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                echo "<tr>";
                                echo "<th>NFCID</th>";
                                echo "<th>Name</th>";
                                echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";

                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['NFCID'] . "</td>";
                                    echo "<td>" . $row['First_Name'] . ' ' . $row['Last_Name'] . "</td>";
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
                        <p><a href="customers.php" class="btn btn-primary">Back</a></p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
