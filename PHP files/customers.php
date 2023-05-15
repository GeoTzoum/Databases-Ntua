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
                width: 650px;
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
                            <h2 class="pull-left">Customers</h2>
                            <a href="create-customer.php" class="btn btn-success pull-right">Add new customer</a>
                        </div>
<?php
require_once "config.php";
// Attempt select query execution
$sql = "SELECT * FROM customers";
if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        echo "<table class='table table-bordered table-striped'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>NFCID</th>";
        echo "<th>First_Name</th>";
        echo "<th>Last_Name</th>";
        echo "<th>Birth_Date</th>";
        echo "<th>ID_Number</th>";
        echo "<th>ID_Type</th>";
        echo "<th>ID_Issuing_Authority</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['NFCID'] . "</td>";
            echo "<td>" . $row['First_Name'] . "</td>";
            echo "<td>" . $row['Last_Name']  . "</td>";
            echo "<td>" . $row['Birth_Date'] . "</td>";
            echo "<td>" . $row['ID_Number'] . "</td>";
            echo "<td>" . $row['ID_Type'] . "</td>";
            echo "<td>" . $row['ID_Issuing_Authority'] . "</td>";
            echo "<td>";
            echo "<a href='read-customers.php?id=" . $row['NFCID'] . "' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
            echo "<a href='update-customers.php?id=" . $row['NFCID'] . "' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
            echo "<a href='delete-customers.php?id=" . $row['NFCID'] . "' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
            echo "<a href='visitedareas.php?id=" . $row['NFCID'] . "' title='Areas visited' data-toggle='tooltip'><span class='glyphicon glyphicon-map-marker'></span></a>";
            echo "<a href='Possible_instance.php?id=" . $row['NFCID'] . "' title='Possible instance' data-toggle='tooltip'><span class='glyphicon glyphicon-signal'></span></a>";
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
<a href="index.php" class="btn btn-primary">Back to first page</a>

<br><br><br>
                  </div>
              </div>
          </div>
      </div>
  </body>
</html>
