<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Dashboard</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
        <style type="text/css">
            .wrapper{
                width: 690px;
                margin: 0 auto;
            }
            .page-header h2{
                margin-top: 0;
            }
            table tr td:last-child a{
                margin-right: 15px;
            }
        </style>
        <script type="text/javascript">
            $(document).ready(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
    </head>
    <body>
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header clearfix">
                            <h2 class="pull-left">Hotel_GND</h2>
                            <a href="create-service.php" class="btn btn-success pull-right">Add new service</a>
                            <a href="servicecost-view.php" class="btn btn-primary pull-right" style="margin-right: 10px" title="Service cost" data-toggle='tooltip'>Sales per service</a>
                            <a href="best-services.php" class="btn btn-primary pull-right" style="margin-right: 10px" title="Most used services" data-toggle='tooltip'>Best services</a>
                            <a href="best-services2.php" class="btn btn-primary pull-right" style="margin-top:  20px" title="Services used by most customers" data-toggle='tooltip'>Most used services</a>
                        </div>
<?php
require_once "config.php";
// Attempt select query execution
$sql = "SELECT * FROM services";
if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        echo "<table class='table table-bordered table-striped'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Service_ID</th>";
        echo "<th>Service_Type</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['Service_ID'] . "</td>";
            echo "<td>" . $row['Service_Type'] . "</td>";
            echo "<td>";
            echo "<a href='read-services.php?id=" . $row['Service_ID'] . "' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
            echo "<a href='update-services.php?id=" . $row['Service_ID'] . "' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
            echo "<a href='delete-services.php?id=" . $row['Service_ID'] . "' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
            echo "<a href='servicesusedby.php?id=" . $row['Service_ID'] . "' title='Customers using service' data-toggle='tooltip'><span class='glyphicon glyphicon-star-empty'></span></a>";
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
<a href="customers.php" class="btn btn-primary">View Customers</a>
<a href="areas.php" class="btn btn-primary">View Areas</a>
<a href="customer_info.php" class="btn btn-primary">Customer's Personal Details</a>
                   </div>
                  </div>
               </div>
             </div>
          </div>
    </body>

</html>
