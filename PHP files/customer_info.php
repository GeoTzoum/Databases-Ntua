<?php
// Include config file
require_once "config.php";

$sql = "SELECT * FROM customer_info";

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
                            <h1>Customer's personal details</h1>
                        </div>
                        <?php
                        if ($result = mysqli_query($conn, $sql)) {

                            if (mysqli_num_rows($result) > 0) {
                                echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                echo "<tr>";

                                echo "<th>Name</th>";
                                echo "<th>Birth Date</th>";
                                echo "<th>Id Info</th>";
                                echo "<th>Phone</th>";
                                echo "<th>Email</th>";
                                echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                $row = mysqli_fetch_array($result);
                                while ($row) {
                                    $x = $row['NFCID'];
                                    $phone = array();
                                    $email = array();
                                    echo "<tr>";
                                    echo "<td>" . $row['First_Name'] . ' ' . $row['Last_Name'] . "</td>";
                                    echo "<td>" . $row['Birth_Date'] . "</td>";
                                    echo "<td>" . $row['ID_Number'] . ' / ' . $row['ID_Type'] . ' / ' . $row['ID_Issuing_Authority'] . "</td>";
                                    while ($row['NFCID'] == $x) {
                                        array_push($phone, $row['Phone_Number']);
                                        array_push($email, $row['Email']);
                                        $row = mysqli_fetch_array($result);
                                    }
                                    $prev_phone = '';
                                    echo "<td>";
                                    for ($i = 0; $i < count($phone); $i++) {
                                        if ($prev_phone != $phone[$i])
                                            echo $phone[$i] . "<br>";
                                        $prev_phone = $phone[$i];
                                    }
                                    echo "</td>";
                                    $prev_email = '';
                                    echo "<td>";
                                    for ($i = 0; $i < count($email); $i++) {
                                        if ($prev_email != $email[$i])
                                            echo $email[$i] . "<br>";
                                        $prev_email = $email[$i];
                                    }
                                    echo "</td>";
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
                        <br><br><br>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
