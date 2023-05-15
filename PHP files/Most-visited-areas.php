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
                            <h2 class="pull-left">Top ares with most visits</h2>
                        </div>
                        <?php
                        // Include config file
                        require_once "config.php";
                        // Attempt select query execution
                        $sql = "SELECT areas.Area_ID, Number_Of_Beds, Area_Name, Area_Description, A.counter
                                FROM areas JOIN (
	                              SELECT COUNT(*) AS counter, areas_id AS area FROM visit
	                              GROUP BY areas_id) AS A
                                ON areas.Area_ID = A.area
                                ORDER BY counter DESC";

                        if ($result = mysqli_query($conn, $sql)) {
                            if (mysqli_num_rows($result) > 0) {
                                echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                echo "<tr>";
                                echo "<th>Area ID</th>";
                                echo "<th>Area Name</th>";
                                echo "<th>Area description</th>";
                                echo "<th>Counter</th>";
                                echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['Area_ID'] .  "</td>";
                                    echo "<td>" . $row['Area_Name'] . "</td>";
                                    echo "<td>" . $row['Area_Description'] . "</td>";
                                    echo "<td>" . $row['counter'] . "</td>";
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
                        <a href="areas.php" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
