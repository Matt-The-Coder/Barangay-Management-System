<?php include 'server/server.php' ?>
<?php
$query = "SELECT * FROM tbldocument";
$result = $conn->query($query);

$request = array();
while ($row = $result->fetch_assoc()) {
    $request[] = $row;
}

$query1 = "SELECT * FROM tbldocument WHERE `docstatus`='Released'";
$result1 = $conn->query($query1);
$released = $result1->num_rows;

$query2 = "SELECT * FROM tbldocument WHERE `docstatus`='Ready'";
$result2 = $conn->query($query2);
$ready = $result2->num_rows;

$query3 = "SELECT * FROM tbldocument WHERE `docstatus`='Processing'";
$result3 = $conn->query($query3);
$processing = $result3->num_rows;

$query4 = "SELECT * FROM tbldocument WHERE `docstatus`='Pending'";
$result4 = $conn->query($query4);
$pending = $result4->num_rows;

$query5 = "SELECT * FROM tbldocument WHERE `docstatus`='Canceled'";
$result5 = $conn->query($query5);
$cancelled = $result5->num_rows;

function generateTrackingCode()
{
    $uniqueId = uniqid();
    $tracking_code = "BMS" . $uniqueId;
    return $tracking_code;
}

$tracking_code = generateTrackingCode();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'templates/header.php' ?>
    <title>Requested Documents - Barangay Management System</title>
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
                                <h2 class="fw-bold">Requested Documents</h2>
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
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <div class="card-title">List of Requested Documents</div>
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
                                        <table id="requesttable"
                                            class="display table nowrap table-borderless table-hover table-sm align-middle mb-0 bg-white"
                                            style="width:100%">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th scope="col">Full Name</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Pickup Date</th>
                                                    <th scope="col">Payment Method</th>
                                                    <th scope="col">Reference No.</th>
                                                    <th scope="col">Purpose</th>
                                                    <th scope="col">Date Requested</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Tracking Code</th>
                                                    <?php if (isset($_SESSION['username'])) : ?>
                                                    <th scope="col">Action</th>
                                                    <?php endif ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($request)) : ?>
                                                <?php foreach ($request as $row) : ?>
                                                <tr>
                                                    <td><?= ucwords($row['lname'] . ', ' . $row['fname'] . ' ' . $row['mname']) ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($row['type'] == 'Barangay Clearance') : ?>
                                                        <span class="badge rounded-pill badge-secondary">Barangay
                                                            Clearance</span>
                                                        <?php elseif ($row['type'] == 'Certificate of Indigency') : ?>
                                                        <span class="badge rounded-pill badge-info">Certificate of
                                                            Indigency</span>
                                                        <?php else : ?>
                                                        <span class="badge rounded-pill badge-primary">Business
                                                            Permit</span>
                                                        <?php endif ?>
                                                    </td>
                                                    <td><?= ucwords($row['pickup']) ?></td>
                                                    <td>
                                                        <?php if ($row['payment'] == 'Gcash') : ?>
                                                        <span>Gcash</span>
                                                        <?php else : ?>
                                                        <span>Cash on Pick-up</span>
                                                        <?php endif ?>
                                                    </td>
                                                    <td><?= ucwords($row['reference']) ?></td>
                                                    <td><?= ucwords($row['purpose']) ?></td>
                                                    <td><?= ucwords($row['date_req']) ?></td>
                                                    <td>
                                                        <?php if ($row['docstatus'] == 'Released') : ?>
                                                        <span class="badge rounded-pill badge-success">Released</span>
                                                        <?php elseif ($row['docstatus'] == 'Ready') : ?>
                                                        <span class="badge rounded-pill badge-primary">Ready to
                                                            Pickup</span>
                                                        <?php elseif ($row['docstatus'] == 'Processing') : ?>
                                                        <span class="badge rounded-pill badge-warning">Processing</span>
                                                        <?php elseif ($row['docstatus'] == 'Cancelled') : ?>
                                                        <span class="badge rounded-pill badge-danger">Cancelled</span>
                                                        <?php else : ?>
                                                        <span class="badge rounded-pill badge-info">Pending</span>
                                                        <?php endif ?>
                                                    </td>
                                                    <td><?= ucwords($row['tracking_code']) ?></td>
                                                    <?php if (isset($_SESSION['username'])) : ?>
                                                    <td>
                                                        <a type="button" href="#edit" data-bs-toggle="modal"
                                                            class="btn btn-warning text-white btn-sm"
                                                            title="Edit Request" onclick="editRequest(this)"
                                                            data-id="<?= $row['id'] ?>"
                                                            data-fname="<?= $row['fname'] ?>"
                                                            data-mname="<?= $row['mname'] ?>"
                                                            data-lname="<?= $row['lname'] ?>"
                                                            data-type="<?= $row['type'] ?>"
                                                            data-pickup="<?= $row['pickup'] ?>"
                                                            data-payment="<?= $row['payment'] ?>"
                                                            data-reference="<?= $row['reference'] ?>"
                                                            data-purpose="<?= $row['purpose'] ?>"
                                                            data-date_req="<?= $row['date_req'] ?>"
                                                            data-docstatus="<?= $row['docstatus'] ?>"
                                                            data-tracking_code="<?= $row['tracking_code'] ?>">
                                                            <?php if (isset($_SESSION['username'])) : ?>
                                                            <i class="ri-edit-2-line" style="font-size: 1rem;"></i>
                                                            <?php else : ?>
                                                            <i class="ri-eye-2-line" style="font-size: 1rem;"></i>
                                                            <?php endif ?>
                                                        </a>
                                                        <?php if (isset($_SESSION['username']) && $_SESSION['role'] == 'administrator') : ?>
                                                        <a type="button" data-bs-toggle="tooltip"
                                                            href="model/remove_request.php?id=<?= $row['id'] ?>"
                                                            onclick="return confirm('Are you sure you want to delete this request?');"
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
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Request</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_request.php">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Tracking Code</label>
                                            <input type="text" class="form-control" name="tracking_code"
                                                value="<?php echo strtoupper($tracking_code); ?>" readonly required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" class="form-control" placeholder="Enter first name"
                                                name="fname" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Middle Name <small class="text-secondary">Optional</small></label>
                                            <input type="text" class="form-control" placeholder="Enter middle name"
                                                name="mname">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control" placeholder="Enter last name"
                                                name="lname" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Document Type</label>
                                            <select class="form-control" name="type" required>
                                                <option disabled selected>Select--</option>
                                                <option value="Barangay Clearance">Barangay Clearance</option>
                                                <option value="Certificate of Indigency">Certificate of Indigency
                                                </option>
                                                <option value="Business Permit">Business Permit</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pickup Date</label>
                                            <input type="date" class="form-control" placeholder="" name="pickup"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Payment Method</label>
                                            <select class="form-control" name="payment" required>
                                                <option disabled selected>Select--</option>
                                                <option value="Gcash">Gcash</option>
                                                <option value="Cash">Cash on Pickup</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Reference No.<small class="text-secondary">Optional</small></label>
                                            <input type="text" class="form-control" placeholder="Enter reference no"
                                                name="reference">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Date Requested</label>
                                            <input type="date" class="form-control" placeholder="" name="date_req"
                                                value="<?= date('Y-m-d'); ?>" required readonly>
                                        </div>
                                    </div>
                                    <div class=" col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="docstatus" required>
                                                <option disabled>Select--</option>
                                                <option value="Released">Released</option>
                                                <option value="Ready">Ready for Pick-up</option>
                                                <option value="Processing">Processing</option>
                                                <option value="Pending" selected>Pending</option>
                                                <option value="Cancelled">Cancelled</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Purpose</label>
                                    <textarea class="form-control" placeholder="Enter purpose here..." name="purpose"
                                        required></textarea>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
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
                            <h5 class="modal-title" id="exampleModalLabel">Edit Request</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/edit_request.php">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Tracking Code</label>
                                            <input type="text" class="form-control" name="tracking_code"
                                                id="tracking_code" readonly required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" class="form-control" placeholder="Enter first name"
                                                id="fname" name="fname" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Middle Name <small class="text-secondary">Optional</small></label>
                                            <input type="text" class="form-control" placeholder="Enter middle name"
                                                id="mname" name="mname">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control" placeholder="Enter last name"
                                                id="lname" name="lname" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Document Type</label>
                                            <select class="form-control" name="type" id="type" required>
                                                <option value="Barangay Clearance">Barangay Clearance</option>
                                                <option value="Certificate of Indigency">Certificate of Indigency
                                                </option>
                                                <option value="Business Permit">Business Permit</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pickup Date</label>
                                            <input type="date" class="form-control" placeholder="" id="pickup"
                                                name="pickup" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Payment Method</label>
                                            <select class="form-control" name="payment" id="payment" required>
                                                <option disabled selected>Select--</option>
                                                <option value="Gcash">Gcash</option>
                                                <option value="Cash">Cash on Pickup</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Reference No.<small class="text-secondary">Optional</small></label>
                                            <input type="text" class="form-control" placeholder="Enter reference no"
                                                id="reference" name="reference">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Date Requested</label>
                                            <input type="date" class="form-control" placeholder="" id="date_req"
                                                name="date_req" readonly required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="docstatus" id="docstatus" required>
                                                <option value="Released">Released</option>
                                                <option value="Ready">Ready for Pick-up</option>
                                                <option value="Processing">Processing</option>
                                                <option value="Pending">Pending</option>
                                                <option value="Cancelled">Cancelled</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Purpose</label>
                                    <textarea class="form-control" placeholder="Enter purpose here..." id="purpose"
                                        name="purpose" readonly required></textarea>
                                </div>

                                <div class="modal-footer">
                                    <input type="hidden" id="request_id" name="id">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <?php if (isset($_SESSION['username'])) : ?>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <?php endif ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main Footer -->
            <?php include 'templates/main-footer.php' ?>
            <!-- End Main Footer -->
        </div>
        <?php include 'templates/footer.php' ?>
        <script>
        $(document).ready(function() {
            var oTable = $('#requesttable').DataTable({
                "order": [
                    [7, "asc"]
                ]
            });

            $("#releasedReq").click(function() {
                var textSelected = 'Released';
                oTable.columns(7).search(textSelected).draw();
            });
            $("#readyReq").click(function() {
                var textSelected = 'Ready';
                oTable.columns(7).search(textSelected).draw();
            });
            $("#processingReq").click(function() {
                var textSelected = 'Processing';
                oTable.columns(7).search(textSelected).draw();
            });
            $("#pendingReq").click(function() {
                var textSelected = 'Pending';
                oTable.columns(7).search(textSelected).draw();
            });
        });
        </script>
</body>

</html>