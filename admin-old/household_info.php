<?php include 'server/server.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'templates/header.php' ?>
    <title>Household - Barangay Management System</title>
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
                            // Select households and count members and rows from database
                            $sql = "SELECT tblhousehold.id, tblhousehold.house_no, COUNT(tblresident.id) as member_count, COUNT(*) as row_count 
                                    FROM tblhousehold 
                                    LEFT JOIN tblresident ON tblhousehold.id = tblresident.household_id 
                                    GROUP BY tblhousehold.id";
                            $result = $conn->query($sql);

                            // Check if there are any households
                            if ($result->num_rows > 0) {
                            ?>
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <div class="card-title">List of Household</div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table
                                            class="table nowrap table-borderless table-hover table-sm align-middle mb-0 bg-white"
                                            style="width:100%">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th scope="col">No.</th>
                                                    <th scope="col">Household No.</th>
                                                    <th scope="col">Members</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $no = 0;
                                                    while ($row = $result->fetch_assoc()) {
                                                        $no++;
                                                    ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><a
                                                            href="household_members.php?household_id=<?= $row["id"]; ?>"><?= $row["house_no"]; ?></a>
                                                    </td>
                                                    <td><?= $row["member_count"]; ?></td>
                                                </tr>
                                                <?php
                                                    }
                                                    ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <?php
                            } else {
                            ?>
                            <div class="alert alert-warning">
                                No households found.
                            </div>
                            <?php
                            }
                            $conn->close();
                            ?>
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