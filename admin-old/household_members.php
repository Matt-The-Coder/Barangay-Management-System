<?php include 'server/server.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'templates/header.php' ?>
    <title>Household Members - Barangay Management System</title>
</head>

<body>
    <div class="wrapper">
        <!-- Main Header -->
        <?php include 'templates/main-header.php' ?>
        <!-- End Main Header -->

        <!-- Sidebar -->
        <?php include 'templates/sidebar.php' ?>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="content">
                <div class="panel-header">
                    <div class="page-inner">
                        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                            <div>
                                <h2 class="fw-bold">Household Information</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner">
                    <div class="row mt--2">
                        <div class="col-md-12">

                            <?php
                            // Get the household ID from the URL parameter
                            if (isset($_GET["household_id"])) {
                                $household_id = $_GET["household_id"];

                                // Select household name from database
                                $sql_household = "SELECT `house_no` FROM tblhousehold WHERE `id` = '$household_id'";
                                $result_household = $conn->query($sql_household);
                                $row_household = $result_household->fetch_assoc();
                                $household_name = $row_household["house_no"];

                                // Select members of the household from database
                                $sql_resident = "SELECT `id`, `national_id`, `citizenship`, `picture`, `firstname`, `middlename`, `lastname`, `alias`, `birthplace`, `birthdate`, `age`, `civilstatus`, `gender`, `purok`, `voterstatus`, `household_id`, `phone`, `email`, `occupation`, `address`, `resident_type`, `remarks` FROM tblresident WHERE household_id = '$household_id'";
                                $result_resident = $conn->query($sql_resident);

                                // Check if there are any members
                                if ($result_resident->num_rows > 0) {
                                    // Display members in a table
                            ?>
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="card-head-row">
                                                <div class="card-title"><?php echo $household_name; ?> Household Members</div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table nowrap table-borderless table-hover table-sm align-middle mb-0 bg-white" style="width:100%">
                                                    <thead class="bg-light">
                                                        <tr>
                                                            <th scope="col">No.</th>
                                                            <th scope="col">Name</th>
                                                            <th scope="col">Phone</th>
                                                            <th scope="col">Email</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $count = 1; // Initialize the counter
                                                        while ($row_resident = $result_resident->fetch_assoc()) : ?>
                                                            <tr>
                                                                <td><?= $count ?></td>
                                                                <td><?php echo $row_resident["firstname"] . " " . $row_resident["middlename"] . " " . $row_resident["lastname"]; ?>
                                                                </td>
                                                                <td><?php echo $row_resident["phone"]; ?></td>
                                                                <td><?php echo $row_resident["email"]; ?></td>
                                                            </tr>
                                                        <?php
                                                            $count++; // Increment the counter
                                                        endwhile; ?>
                                                    </tbody>
                                                </table>
                                                <p>Total Members: <?php echo $result_resident->num_rows; ?></p>
                                                <!-- Display the total number of members -->
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                } else {
                                    echo "No members found for this household.";
                                }
                            } else {
                                echo "Invalid request. Please provide a household ID.";
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main Footer -->
            <?php include 'templates/main-footer.php' ?>
            <!-- End Main Footer -->

        </div>
    </div>

    <!-- Scripts -->
    <?php include 'templates/footer.php' ?>
    <!-- End Scripts -->
</body>

</html>