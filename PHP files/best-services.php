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
                            <h2 class="pull-left">Top services with most uses</h2>
                        </div>
                        <?php
                        // Include config file
                        require_once "config.php";
                        // Attempt select query execution
                        $sql = "SELECT services.Service_ID, Service_Type, S.counter
                                FROM services JOIN (
	                              SELECT COUNT(*) AS counter, service_id AS service FROM use_services
	                              GROUP BY service_id) AS S
                                ON services.Service_ID = S.service
                                ORDER BY counter DESC";

                        if ($result = mysqli_query($conn, $sql)) {
                            if (mysqli_num_rows($result) > 0) {
                                echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                echo "<tr>";
                                echo "<th>Service ID</th>";
                                echo "<th>Service Type</th>";
                                echo "<th>Counter</th>";
                                echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['Service_ID'] .  "</td>";
                                    echo "<td>" . $row['Service_Type'] . "</td>";
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
                        <a href="index.php" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
