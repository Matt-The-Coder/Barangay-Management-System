<?php include 'server/server.php' ?>
<?php
$query = "SELECT * FROM tblchairmanship";
$result = $conn->query($query);

$chair = array();
while ($row = $result->fetch_assoc()) {
    $chair[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'templates/header.php' ?>
    <title>Barangay Chairmanship - Barangay Management System</title>
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
                            <div class="alert alert-<?php echo $_SESSION['success']; ?><?= $_SESSION['success'] == 'danger' ? 'bg-danger text-light' : null ?>"
                                role="alert">
                                <?php echo $_SESSION['message']; ?>
                            </div>
                            <?php unset($_SESSION['message']); ?>
                            <?php endif ?>

                            <div class="card">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <div class="card-title">Chairmanship</div>
                                        <div class="card-tools">
                                            <a href="#add" data-bs-toggle="modal"
                                                class="btn btn-info btn-round btn-sm text-white">
                                                <i class="ri-add-fill" style="font-size: 1rem;"></i>
                                            </a>
                                        </div>
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
                                                    <th scope="col">Title</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($chair)) : ?>
                                                <?php $no = 1;
                                                    foreach ($chair as $row) : ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $row['title'] ?></td>
                                                    <td>
                                                        <div class="form-button-action">
                                                            <a type="button" href="#edit" data-bs-toggle="modal"
                                                                class="btn btn-warning text-white btn-sm"
                                                                title="Edit Title" onclick="editChair(this)"
                                                                data-title="<?= $row['title'] ?>"
                                                                data-id="<?= $row['id'] ?>">
                                                                <i class="ri-edit-2-line" style="font-size: 1rem;"></i>
                                                            </a>
                                                            &nbsp;
                                                            <a type="button" data-bs-toggle="tooltip"
                                                                href="model/remove_chair.php?id=<?= $row['id'] ?>"
                                                                onclick="return confirm('Are you sure you want to delete this title?');"
                                                                class="btn btn-danger text-white btn-sm"
                                                                data-original-title="Remove">
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
                                                    <td colspan="3" class="text-center">No Available Data</td>
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

            <!-- Modal -->
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Chairmanship</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_chairmanship.php">
                                <div class="form-group">
                                    <label>Chairmanship</label>
                                    <input type="text" class="form-control" placeholder="Enter Chairmanship"
                                        name="chair" required>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Position</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/edit_chairmanship.php">
                                <div class="form-group">
                                    <label for="position">Chairmanship</label>
                                    <input type="text" class="form-control" id="chair" placeholder="Chairmanship"
                                        name="chair" required>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="chair_id" name="id">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
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
</body>

</html>