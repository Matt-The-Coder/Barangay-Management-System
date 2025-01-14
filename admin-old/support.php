<?php include 'server/server.php' ?>
<?php
$query = "SELECT * FROM tbl_support ORDER BY `date` DESC";
$result = $conn->query($query);

$ticket = array();
while ($row = $result->fetch_assoc()) {
    $ticket[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'templates/header.php' ?>
    <title>Support Management - Barangay Management System</title>
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
                                <h2 class="fw-bold">Settings</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner">
                    <div class="row mt--2">
                        <div class="col-md-12">

                            <?php if (isset($_SESSION['message'])) : ?>
                            <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success'] == 'danger' ? 'bg-danger text-light' : null ?>"
                                role="alert">
                                <?php echo $_SESSION['message']; ?>
                            </div>
                            <?php unset($_SESSION['message']); ?>
                            <?php endif ?>

                            <div class="card">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <div class="card-title">Support Management</div>
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
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Number</th>
                                                    <th scope="col">Subject</th>
                                                    <th scope="col">Message</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($ticket)) : ?>
                                                <?php $no = 1;
                                                    foreach ($ticket as $row) : ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $row['name'] ?></td>
                                                    <td><a href="mailto:<?= $row['email'] ?>"><?= $row['email'] ?></a>
                                                    </td>
                                                    <td><a href="tel:<?= $row['number'] ?>"><?= $row['number'] ?></a>
                                                    </td>
                                                    <td><?= $row['subject'] ?></td>
                                                    <td><?= $row['message'] ?></td>
                                                    <td><?= $row['date'] ?></td>
                                                    <td>
                                                        <div class="form-button-action">
                                                            <a type="button" data-toggle="tooltip"
                                                                href="model/remove_ticket.php?id=<?= $row['id'] ?>"
                                                                onclick="return confirm('Are you sure you want to remove this support/ticket?');"
                                                                class="btn btn-danger" data-original-title="Remove">
                                                                <i class="ri-delete-bin-2-fill"
                                                                    style="font-size: 1rem;"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php $no++;
                                                    endforeach ?>
                                                <?php else : ?>
                                                <tr>
                                                    <td colspan="8" class="text-center">No Available Data</td>
                                                </tr>
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
</body>

</html>