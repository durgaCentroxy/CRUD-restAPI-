<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper {
            width: 650px;
            margin: 0 auto;
        }

        .page-header h2 {
            margin-top: 0;
        }

        table tr td:last-child a {
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function() {
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
                        <h2 class="pull-left">Employees Details</h2>
                        <div class="pull-left" style="margin-left: 125px">
                            <?php
                            echo "<a href='logout.php?token=" . $_SESSION['token'] . "'>logout</a>";
                            ?>
                        </div>
                        <div class="pull-left" style="margin-left: 40px">
                            <?php
                            echo "<a href='create.php?token=" . $_SESSION['token'] . "'>Add New Employee</a>";
                            ?>
                        </div>

                        <!-- <a href="create.php?token="></a> -->
                    </div>
                    <?php
                    // Include config file

                    require_once "config.php";
                    // require_once "login.php";
                    $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']
                        === 'on' ? "https" : "http") . "://" .
                        $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
                    $get_random_string = $_GET['token'];
                    if ($get_random_string == $_SESSION['token']) {
                        // Attempt select query execution
                        $sql = "SELECT * FROM employees";
                        if ($result = $mysqli->query($sql)) {
                            if ($result->num_rows > 0) {
                                echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                echo "<tr>";
                                echo "<th>#</th>";
                                echo "<th>Name</th>";
                                echo "<th>Address</th>";
                                echo "<th>Salary</th>";
                                echo "<th>Action</th>";
                                echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while ($row = $result->fetch_array()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['name'] . "</td>";
                                    echo "<td>" . $row['address'] . "</td>";
                                    echo "<td>" . $row['salary'] . "</td>";
                                    echo "<td>";
                                    echo "<a href='read.php?token=" . $_SESSION['token'] . "&id=" . $row['id'] . "' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                    echo "<a href='update.php?token=" . $_SESSION['token'] . "&id=" . $row['id'] . "' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                    echo "<a href='delete.php?token=" . $_SESSION['token'] . "&id=" . $row['id'] . "' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                                echo "</table>";
                                // Free result set
                                $result->free();
                            } else {
                                echo "<p class='lead'><em>No records were found.</em></p>";
                            }
                        } else {
                            echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
                        }

                        // Close connection
                        $mysqli->close();
                    } else {
                        echo "You're not authorized";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>