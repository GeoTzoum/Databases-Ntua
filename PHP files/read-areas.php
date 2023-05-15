<?php
require_once "config.php";

$areas_id = $_REQUEST['id'];

$sql2 = "SELECT * FROM areas WHERE Area_ID = '$areas_id'";

if ($result = mysqli_query($conn, $sql2)) {
    $row = mysqli_fetch_array($result);
} else {
    header("location: error.php");
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
                            <h1>Area's Details</h1>
                        </div>
                        <table class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Number of beds</th>
                                </tr>
                            </thead>
                            <tr>
                                <td><?php echo $row["Area_ID"]; ?></td>
                                <td><?php echo $row["Area_Name"]; ?></td>
                                <td><?php echo $row["Area_Description"]; ?></td>
                                <td><?php echo $row["Number_Of_Beds"]; ?></td>
                            </tr>
                        </table>
                        <div>
                            <p><a href="areas.php" class="btn btn-primary">Back</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
