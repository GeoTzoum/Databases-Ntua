<?php
require_once "config.php";

$services_id = $_REQUEST['id'];

$sql2 = "SELECT * FROM services WHERE Service_ID = '$services_id'";

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
        <title>Service</title>
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
                            <h1>Services's Details</h1>
                        </div>
                        <table class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Type</th>
                                </tr>
                            </thead>
                            <tr>
                                <td><?php echo $row["Service_ID"]; ?></td>
                                <td><?php echo $row["Service_Type"]; ?></td>
                            </tr>
                        </table>
                        <div>
                            <p><a href="index.php" class="btn btn-primary">Back</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
