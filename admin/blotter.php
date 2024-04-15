<?php include 'server/server.php' ?>
<?php
$query = "SELECT * FROM tblblotter";
$result = $conn->query($query);

$blotter = array();
while ($row = $result->fetch_assoc()) {
    $blotter[] = $row;
}

$query1 = "SELECT * FROM tblblotter WHERE `status`='Active'";
$result1 = $conn->query($query1);
$active = $result1->num_rows;

$query2 = "SELECT * FROM tblblotter WHERE `status`='Scheduled'";
$result2 = $conn->query($query2);
$scheduled = $result2->num_rows;

$query3 = "SELECT * FROM tblblotter WHERE `status`='Settled'";
$result3 = $conn->query($query3);
$settled = $result3->num_rows;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'templates/header.php' ?>
    <title>Blotter/Incident Complaint - Barangay Management System</title>
</head>

<body>
    <?php include 'templates/loading_screen.php' ?>
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
                                <h2 class="fw-bold">Blotter/Incident Complaint</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner">
                    <?php if (isset($_SESSION['message'])) : ?>
                    <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success'] == 'danger' ? 'bg-danger text-light' : null ?>"
                        role="alert">
                        <?php echo $_SESSION['message']; ?>
                    </div>
                    <?php unset($_SESSION['message']); ?>
                    <?php endif ?>
                    <div class="row mt--2">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <div class="card-title">All Resident</div>
                                        <?php if (isset($_SESSION['username'])) : ?>
                                        <div class="card-tools">
                                            <a href="#add" data-bs-toggle="modal"
                                                class="btn btn-info btn-round btn-sm text-white">
                                                <i class="ri-add-fill" style="font-size: 1rem;"></i>
                                            </a>
                                        </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="blottertable"
                                            class="display table nowrap table-borderless table-hover table-sm align-middle mb-0 bg-white"
                                            style="width:100%">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th scope="col">Complainant</th>
                                                    <th scope="col">Respondent</th>
                                                    <th scope="col">Victim(s)</th>
                                                    <th scope="col">Blotter/Incident</th>
                                                    <th scope="col">Status</th>
                                                    <?php if (isset($_SESSION['username'])) : ?>
                                                    <th scope="col">Action</th>
                                                    <?php endif ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($blotter)) : ?>
                                                <?php foreach ($blotter as $row) : ?>
                                                <tr>
                                                    <td><?= ucwords($row['complainant']) ?></td>
                                                    <td><?= ucwords($row['respondent']) ?></td>
                                                    <td><?= ucwords($row['victim']) ?></td>
                                                    <td><?= ucwords($row['type']) ?></td>
                                                    <td>
                                                        <?php if ($row['status'] == 'Scheduled') : ?>
                                                        <span
                                                            class="badge rounded-pill badge-warning text-warning">Scheduled</span>
                                                        <?php elseif ($row['status'] == 'Active') : ?>
                                                        <span class="badge rounded-pill badge-danger">Active</span>
                                                        <?php else : ?>
                                                        <span class="badge rounded-pill badge-success">Settled</span>
                                                        <?php endif ?>
                                                    </td>
                                                    <?php if (isset($_SESSION['username'])) : ?>
                                                    <td>
                                                        <a type="button" href="#edit" data-bs-toggle="modal"
                                                            class="btn btn-warning text-white btn-sm"
                                                            title="Edit Blotter" onclick="editBlotter1(this)"
                                                            data-id="<?= $row['id'] ?>"
                                                            data-complainant="<?= $row['complainant'] ?>"
                                                            data-respondent="<?= $row['respondent'] ?>"
                                                            data-victim="<?= $row['victim'] ?>"
                                                            data-type="<?= $row['type'] ?>"
                                                            data-l="<?= $row['location'] ?>"
                                                            data-date="<?= $row['date'] ?>"
                                                            data-time="<?= $row['time'] ?>"
                                                            data-details="<?= $row['details'] ?>"
                                                            data-status="<?= $row['status'] ?>">
                                                            <?php if (isset($_SESSION['username'])) : ?>
                                                            <i class="ri-edit-2-line" style="font-size: 1rem;"></i>
                                                            <?php else : ?>
                                                            <i class="ri-eye-2-line" style="font-size: 1rem;"></i>
                                                            <?php endif ?>
                                                        </a>
                                                        <a type="button" data-bs-toggle="tooltip"
                                                            href="generate_blotter_report.php?id=<?= $row['id'] ?>"
                                                            class="btn btn-primary text-white btn-sm"
                                                            data-original-title="Generate Report">
                                                            <i class="ri-file-download-fill"
                                                                style="font-size: 1rem;"></i>
                                                        </a>
                                                        <?php if (isset($_SESSION['username']) && $_SESSION['role'] == 'administrator') : ?>
                                                        <a type="button" data-bs-toggle="tooltip"
                                                            href="model/remove_blotter.php?id=<?= $row['id'] ?>"
                                                            onclick="return confirm('Are you sure you want to delete this blotter?');"
                                                            class="btn btn-danger text-white btn-sm"
                                                            data-original-title="Remove">
                                                            <i class="ri-delete-bin-2-fill"
                                                                style="font-size: 1rem;"></i>
                                                        </a>
                                                        <?php endif ?>
                                                    </td>
                                                    <?php endif ?>
                                                </tr>
                                                <?php endforeach ?>
                                                <?php endif ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-stats card-danger card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="icon-big text-center">
                                                <i class="ri-error-warning-line" style="font-size: 3.4rem;"></i>
                                            </div>
                                        </div>
                                        <div class="col-6 col-stats">
                                        </div>
                                        <div class="col-3 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Active</p>
                                                <h4 class="card-title"><?= number_format($active) ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body card-round" style="background: #c03f54;">
                                    <a href="javascript:void(0)" id="activeCase"
                                        class="card-link text-light text-decoration-none">Active
                                        Case </a>
                                </div>
                            </div>
                            <div class="card card-stats card-success card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="icon-big text-center">
                                                <i class="ri-thumb-up-line" style="font-size: 3.4rem;"></i>
                                            </div>
                                        </div>
                                        <div class="col-6 col-stats">
                                        </div>
                                        <div class="col-3 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Settled</p>
                                                <h4 class="card-title"><?= number_format($settled) ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body card-round" style="background: #139145;">
                                    <a href=" javascript:void(0)" id="settledCase"
                                        class="card-link text-light text-decoration-none">Settled
                                        Case </a>
                                </div>
                            </div>
                            <div class="card card-stats card-warning card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="icon-big text-center">
                                                <i class="ri-calendar-event-line" style="font-size: 3.4rem;"></i>
                                            </div>
                                        </div>
                                        <div class="col-6 col-stats">
                                        </div>
                                        <div class="col-3 col-stats">
                                            <div class="numbers">
                                                <p class="card-category">Scheduled</p>
                                                <h4 class="card-title"><?= number_format($scheduled) ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body card-round" style="background: #cd9016;">
                                    <a href="javascript:void(0)" id="scheduledCase"
                                        class="card-link text-light text-decoration-none">Scheduled Case </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Manage Blotter</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_blotter.php">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Complainant</label>
                                            <input type="text" class="form-control" placeholder="Enter Complainant Name"
                                                name="complainant" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Respondent</label>
                                            <input type="text" class="form-control" placeholder="Enter Respondent Name"
                                                name="respondent" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Victim(s)</label>
                                            <input type="text" class="form-control" placeholder="Enter Victim(s) Name"
                                                name="victim" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Type</label>
                                            <select class="form-control" name="type">
                                                <option disabled selected>Select Blotter Type</option>
                                                <option value="Amicable">Amicable</option>
                                                <option value="Incident">Incident</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Location</label>
                                            <input type="text" class="form-control" placeholder="Enter Location"
                                                name="location" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input type="date" class="form-control" name="date"
                                                value="<?= date('Y-m-d'); ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Time</label>
                                            <input type="time" class="form-control" name="time" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="status">
                                                <option disabled selected>Select Blotter Status</option>
                                                <option value="Active">Active</option>
                                                <option value="Settled">Settled</option>
                                                <option value="Scheduled">Scheduled</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Details</label>
                                    <textarea class="form-control" placeholder="Enter Blotter or Incident here..."
                                        name="details" required></textarea>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Blotter</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/edit_blotter.php">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Complainant</label>
                                            <input type="text" class="form-control" placeholder="Enter Complainant Name"
                                                id="complainant" name="complainant" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Respondent</label>
                                            <input type="text" class="form-control" placeholder="Enter Respondent Name"
                                                id="respondent" name="respondent" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Victim(s)</label>
                                            <input type="text" class="form-control" placeholder="Enter Victim(s) Name"
                                                id="victim" name="victim" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Type</label>
                                            <select class="form-control" name="type" id="type">
                                                <option disabled selected>Select Blotter Type</option>
                                                <option value="Amicable">Amicable</option>
                                                <option value="Incident">Incident</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Location</label>
                                            <input type="text" class="form-control" placeholder="Enter Location"
                                                id="location" name="location" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input type="date" class="form-control" name="date" id="date" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Time</label>
                                            <input type="time" class="form-control" name="time" id="time" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="status" id="status">
                                                <option disabled selected>Select Blotter Status</option>
                                                <option value="Active">Active</option>
                                                <option value="Settled">Settled</option>
                                                <option value="Scheduled">Scheduled</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Details</label>
                                    <textarea class="form-control" placeholder="Enter Blotter or Incident here..."
                                        id="details" name="details" required></textarea>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="blotter_id" name="id">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <?php if (isset($_SESSION['username'])) : ?>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <?php endif ?>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Main Footer -->
            <?php include 'templates/main-footer.php' ?>
            <!-- End Main Footer -->

        </div>

    </div>
    <?php include 'templates/footer.php' ?>
    <script>
    $(document).ready(function() {
        var oTable = $('#blottertable').DataTable({
            "order": [
                [4, "asc"]
            ]
        });

        $("#activeCase").click(function() {
            var textSelected = 'Active';
            oTable.columns(4).search(textSelected).draw();
        });
        $("#settledCase").click(function() {
            var textSelected = 'Settled';
            oTable.columns(4).search(textSelected).draw();
        });
        $("#scheduledCase").click(function() {
            var textSelected = 'Scheduled';
            oTable.columns(4).search(textSelected).draw();
        });
    });
    </script>
</body>

</html>