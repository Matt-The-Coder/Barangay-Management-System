<?php include 'server/server.php' ?>
<?php
$sql = "SELECT * FROM tblpayments ORDER BY `date` DESC";
$result = $conn->query($sql);

$revenue = array();
while ($row = $result->fetch_assoc()) {
    $revenue[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'templates/header.php' ?>
    <title>Barangay Revenues - Barangay Management System</title>
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
                                <h2 class="fw-bold">Barangay Revenues</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner">
                    <div class="row mt--2">
                        <div class="col-md-12">

                            <?php if (isset($_SESSION['message'])) : ?>
                                <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success'] == 'danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                                <?php unset($_SESSION['message']); ?>
                            <?php endif ?>

                            <div class="card">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <div class="card-title">Revenue Informations</div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3 w-50">
                                        <div class="col">
                                            <label>Minimum Date</label>
                                            <input type="text" class="form-control" placeholder="Enter date" id="min">
                                        </div>
                                        <div class="col">
                                            <label>Maximum Date</label>
                                            <input type="text" class="form-control" placeholder="Enter date" id="max">
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="revenuetable" class="display table table-bordered nowrap table-sm align-middle mb-0 bg-white" style="width:100%">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Recipient</th>
                                                    <th scope="col">Details</th>
                                                    <th scope="col">Amount</th>
                                                    <th scope="col">Username</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($revenue)) : ?>
                                                    <?php $no = 1;
                                                    foreach ($revenue as $row) : ?>
                                                        <tr>
                                                            <td><?= $row['date'] ?></td>
                                                            <td><?= $row['name'] ?></td>
                                                            <td><?= $row['details'] ?></td>
                                                            <td>P <?= number_format($row['amounts'], 2) ?></td>
                                                            <td><?= $row['user'] ?></td>
                                                        </tr>
                                                    <?php $no++;
                                                    endforeach ?>
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

            <!-- Main Footer -->
            <?php include 'templates/main-footer.php' ?>
            <!-- End Main Footer -->

        </div>

    </div>
    <?php include 'templates/footer.php' ?>
    <script src="assets/js/plugin/moment/moment.min.js"></script>
    <script>
        var minDate, maxDate;

        // Custom filtering function which will search data in column four between two values
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = minDate.val();
                var max = maxDate.val();
                var date = new Date(data[0]);

                if (
                    (min === null && max === null) ||
                    (min === null && date <= max) ||
                    (min <= date && max === null) ||
                    (min <= date && date <= max)
                ) {
                    return true;
                }
                return false;
            }
        );
        $(document).ready(function() {
            // Create date inputs
            minDate = new DateTime($('#min'), {
                format: 'MMMM Do YYYY'
            });
            maxDate = new DateTime($('#max'), {
                format: 'MMMM Do YYYY'
            });

            var table = $('#revenuetable').DataTable({
                "order": [
                    [0, "desc"]
                ],
                dom: 'Bfrtip',
                buttons: [
                    'print', 'copy', 'excel', 'pdf', 'csv'
                ]
            });

            // Refilter the table
            $('#min, #max').on('change', function() {
                table.draw();
            });
        });
    </script>
</body>

</html>