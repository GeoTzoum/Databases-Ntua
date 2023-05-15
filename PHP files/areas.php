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
                            <h2 class="pull-left">Areas</h2>
                            <a href="create-area.php" class="btn btn-success pull-right">Add new area</a>
                            <a href="Most-visited-areas.php" class="btn btn-primary pull-right" style="margin-right: 10px" title="Top visited areas!" data-toggle='tooltip'>Best areas</a>
                        </div>
<?php
require_once "config.php";
// Attempt select query execution
$sql = "SELECT * FROM areas";
if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        echo "<table class='table table-bordered table-striped'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Area_ID</th>";
        echo "<th>Area_Name</th>";
        echo "<th>Area_Description</th>";
        echo "<th>Number_Of_Beds</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['Area_ID'] . "</td>";
            echo "<td>" . $row['Area_Name'] . "</td>";
            echo "<td>" . $row['Area_Description']  . "</td>";
            echo "<td>" . $row['Number_Of_Beds'] . "</td>";
            echo "<td>";
            echo "<a href='read-areas.php?id=" . $row['Area_ID'] . "' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
            echo "<a href='update-areas.php?id=" . $row['Area_ID'] . "' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
            echo "<a href='delete-areas.php?id=" . $row['Area_ID'] . "' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
            echo "<a href='areasvisitedby.php?id=" . $row['Area_ID'] . "' title='Areas visited' data-toggle='tooltip'><span class='glyphicon glyphicon-map-marker'></span></a>";
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
