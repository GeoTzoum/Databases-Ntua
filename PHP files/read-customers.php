<?php
require_once "config.php";

$customer_id = $_REQUEST['id'];

$sql2 = "SELECT * FROM customers WHERE NFCID = '$customer_id'";

if ($result = mysqli_query($conn, $sql2)) {
    $row = mysqli_fetch_array($result);
} else {
    //header("location: error.php");
    exit();
}


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Customer</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css">
            .wrapper{
                width: 900px;
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
                            <h1>Customer's Details</h1>
                        </div>
                        <table class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th>NFCID</th>
                                    <th>Name</th>
                                    <th>Date of birth</th>
                                    <th>ID_Info</th>
                                </tr>
                            </thead>
                            <tr>
                                <td><?php echo $row["NFCID"]; ?></td>
                                <td><?php echo $row["First_Name"] . " " . $row["Last_Name"]; ?></td>
                                <td><?php echo $row["Birth_Date"]; ?></td>
                                <td><?php echo $row["ID_Type"] . "/" . $row["ID_Number"] . "/" . $row["ID_Issuing_Authority"]?></td>
                            </tr>
                        </table>
                        <div>
                            <p><a href="customers.php" class="btn btn-primary">Back</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
