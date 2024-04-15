<?php include 'server/server.php' ?>
<?php
$query = "SELECT * FROM tblresident";
$result = $conn->query($query);

$resident = array();
while ($row = $result->fetch_assoc()) {
    $resident[] = $row;
}

$query1 = "SELECT * FROM tblpurok ORDER BY `name`";
$result1 = $conn->query($query1);

$purok = array();
while ($row = $result1->fetch_assoc()) {
    $purok[] = $row;
}

$query2 = "SELECT id, house_no FROM tblhousehold ORDER BY `house_no`";
$result2 = $conn->query($query2);

$options = array();
while ($row = $result2->fetch_assoc()) {
    $options[$row["id"]] = $row["house_no"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'templates/header.php' ?>
    <title>Resident Information - Barangay Management System</title>
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
                                <h2 class="fw-bold">Residents</h2>
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
                                        <div class="card-title">Resident Information</div>
                                        <?php if (isset($_SESSION['username'])) : ?>
                                        <div class="card-tools">
                                            <a href="#add" data-bs-toggle="modal"
                                                class="btn btn-info btn-round btn-sm text-white">
                                                <i class="ri-user-add-fill" style="font-size: 1rem;"></i>
                                            </a>
                                            <a href="model/export_resident_csv.php"
                                                class="btn btn-success btn-round btn-sm">
                                                <i class="ri-file-excel-2-fill" style="font-size: 1rem;"></i>
                                            </a>
                                        </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="residenttable"
                                            class="display table nowrap table-borderless table-hover table-sm align-middle mb-0 bg-white"
                                            style="width:100%">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th scope="col">Fullname</th>
                                                    <th scope="col">National ID</th>
                                                    <th scope="col">Alias</th>
                                                    <th scope="col">Birthdate</th>
                                                    <th scope="col">Age</th>
                                                    <th scope="col">Civil Status</th>
                                                    <th scope="col">Gender</th>
                                                    <th scope="col">Purok</th>
                                                    <?php if (isset($_SESSION['username'])) : ?>
                                                    <?php if ($_SESSION['role'] == 'administrator') : ?>
                                                    <th scope="col">Voter Status</th>
                                                    <?php endif ?>
                                                    <th scope="col">Action</th>
                                                    <?php endif ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($resident)) : ?>
                                                <?php $no = 1;
                                                    foreach ($resident as $row) : ?>
                                                <tr>
                                                    <td>
                                                        <div class="avatar avatar-xs">
                                                            <img src="<?= preg_match('/data:image/i', $row['picture']) ? $row['picture'] : 'assets/uploads/resident_profile/' . $row['picture'] ?>"
                                                                alt="Resident Profile"
                                                                class="avatar-img rounded-circle">
                                                        </div>
                                                        <?= ucwords($row['lastname'] . ', ' . $row['firstname'] . ' ' . $row['middlename']) ?>
                                                    </td>
                                                    <td><?= $row['national_id'] ?></td>
                                                    <td><?= $row['alias'] ?></td>
                                                    <td><?= $row['birthdate'] ?></td>
                                                    <td><?= $row['age'] ?></td>
                                                    <td><?= $row['civilstatus'] ?></td>
                                                    <td><?= $row['gender'] ?></td>
                                                    <td><?= $row['purok'] ?></td>
                                                    <?php if (isset($_SESSION['username'])) : ?>
                                                    <?php if ($_SESSION['role'] == 'administrator') : ?>
                                                    <td><?= $row['voterstatus'] ?></td>
                                                    <?php endif ?>
                                                    <td>
                                                        <div class="form-button-action">
                                                            <a type="button" href="#edit" data-bs-toggle="modal"
                                                                class="btn btn-warning text-white btn-sm"
                                                                title="View Resident" onclick="editResident(this)"
                                                                data-id="<?= $row['id'] ?>"
                                                                data-national="<?= $row['national_id'] ?>"
                                                                data-fname="<?= $row['firstname'] ?>"
                                                                data-mname="<?= $row['middlename'] ?>"
                                                                data-lname="<?= $row['lastname'] ?>"
                                                                data-alias="<?= $row['alias'] ?>"
                                                                data-bplace="<?= $row['birthplace'] ?>"
                                                                data-bdate="<?= $row['birthdate'] ?>"
                                                                data-age="<?= $row['age'] ?>"
                                                                data-cstatus="<?= $row['civilstatus'] ?>"
                                                                data-gender="<?= $row['gender'] ?>"
                                                                data-purok="<?= $row['purok'] ?>"
                                                                data-vstatus="<?= $row['voterstatus'] ?>"
                                                                data-household_id="<?= $row['household_id'] ?>"
                                                                data-number="<?= $row['phone'] ?>"
                                                                data-email="<?= $row['email'] ?>"
                                                                data-address="<?= $row['address'] ?>"
                                                                data-img="<?= $row['picture'] ?>"
                                                                data-citi="<?= $row['citizenship']; ?>"
                                                                data-occu="<?= $row['occupation'] ?>"
                                                                data-dead="<?= $row['resident_type']; ?>"
                                                                data-remarks="<?= $row['remarks'] ?>">
                                                                <?php if (isset($_SESSION['username'])) : ?>
                                                                <i class="ri-edit-2-line" style="font-size: 1rem;"></i>
                                                                <?php else : ?>
                                                                <i class="ri-eye-2-line" style="font-size: 1rem;"></i>
                                                                <?php endif ?>
                                                            </a>
                                                            &nbsp;
                                                            <?php if (isset($_SESSION['username']) && $_SESSION['role'] == 'administrator') : ?>
                                                            <a type="button" data-bs-toggle="tooltip"
                                                                href="generate_resident.php?id=<?= $row['id'] ?>"
                                                                class="btn btn-primary text-white btn-sm"
                                                                data-original-title="Generate">
                                                                <i class="ri-file-download-fill"
                                                                    style="font-size: 1rem;"></i>
                                                            </a>
                                                            &nbsp;
                                                            <a type="button" data-bs-toggle="tooltip"
                                                                href="model/remove_resident.php?id=<?= $row['id'] ?>"
                                                                onclick="return confirm('Are you sure you want to delete this resident?');"
                                                                class="btn btn-danger text-white btn-sm"
                                                                data-original-title="Remove">
                                                                <i class="ri-delete-bin-2-fill"
                                                                    style="font-size: 1rem;"></i>
                                                            </a>
                                                            <?php endif ?>
                                                        </div>
                                                    </td>
                                                    <?php endif ?>

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

            <!-- Modal -->
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New Resident Registration Form</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_resident.php" enctype="multipart/form-data">
                                <input type="hidden" name="size" value="1000000">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div style="width: 370px; height: 250;" class="text-center" id="my_camera">
                                            <img src="assets/img/person.png" alt="..." class="img img-fluid"
                                                width="250">
                                        </div>
                                        <div class="form-group d-flex justify-content-center">
                                            <button type="button" class="btn btn-danger btn-sm mr-2" id="open_cam">Open
                                                Camera</button>
                                            &nbsp;
                                            <button type="button" class="btn btn-secondary btn-sm ml-2"
                                                onclick="save_photo()">Capture</button>
                                        </div>
                                        <div id="profileImage">
                                            <input type="hidden" name="profileimg">
                                        </div>
                                        <div class="form-group">
                                            <input type="file" class="form-control" name="img" accept="image/*">
                                        </div>
                                        <div class="form-group">
                                            <label>National ID No.</label>
                                            <input type="text" class="form-control" name="national"
                                                placeholder="Enter National ID No." required>
                                        </div>
                                        <div class="form-group">
                                            <label>Citizenship</label>
                                            <input type="text" class="form-control" name="citizenship"
                                                placeholder="Enter citizenship" required>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter first name" name="fname" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Middle Name <small
                                                            class="text-secondary">Optional</small></label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter middle name" name="mname">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter last name" name="lname" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Alias <small class="text-secondary">Optional</small></label>
                                                    <input type="text" class="form-control" placeholder="Enter alias"
                                                        name="alias">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Place of Birth</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter birth place" name="bplace" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Birth Date</label>
                                                    <input type="date" class="form-control" placeholder="" name="bdate"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Age</label>
                                                    <input type="number" class="form-control" placeholder="Enter age"
                                                        min="1" name="age" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Civil Status</label>
                                                    <select class="form-control" name="cstatus">
                                                        <option disabled selected>Select civil status</option>
                                                        <option value="Single">Single</option>
                                                        <option value="Married">Married</option>
                                                        <option value="Widowed">Widowed</option>
                                                        <option value="Separated">Separated</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Gender</label>
                                                    <select class="form-control" required name="gender">
                                                        <option disabled selected value="">Select gender</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Purok</label>
                                                    <select class="form-control" required name="purok">
                                                        <option disabled selected>Select purok</option>
                                                        <?php foreach ($purok as $row) : ?>
                                                        <option value="<?= ucwords($row['name']) ?>"><?= $row['name'] ?>
                                                        </option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Household</label>
                                                    <select class="form-control" required name="household_id">
                                                        <option disabled selected>Select household</option>
                                                        <?php foreach ($options as $id => $household_id) {
                                                            echo "<option value='$id'>$household_id</option>";
                                                        } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Voters Status</label>
                                                    <select class="form-control vstatus" required name="vstatus">
                                                        <option disabled selected>Select voters status</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Email Address</label>
                                                    <input type="email" class="form-control" placeholder="Enter email"
                                                        name="email">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Contact number</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter contact number" name="number">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Occupation</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter occupation" name="occupation">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea class="form-control" name="address" required
                                                placeholder="Enter address"></textarea>
                                        </div>
                                    </div>
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
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit/View Resident Information</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/edit_resident.php" enctype="multipart/form-data">
                                <input type="hidden" name="size" value="1000000">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div id="my_camera1" style="width: 370px; height: 250;" class="text-center">
                                            <img src="assets/img/person.png" alt="..." class="img img-fluid" width="250"
                                                id="image">
                                        </div>
                                        <?php if (isset($_SESSION['username'])) : ?>
                                        <div class="form-group d-flex justify-content-center">
                                            <button type="button" class="btn btn-danger btn-sm mr-2" id="open_cam1">Open
                                                Camera</button>
                                            &nbsp;
                                            <button type="button" class="btn btn-secondary btn-sm ml-2"
                                                onclick="save_photo1()">Capture</button>
                                        </div>
                                        <div id="profileImage1">
                                            <input type="hidden" name="profileimg">
                                        </div>
                                        <div class="form-group">
                                            <input type="file" class="form-control" name="img" accept="image/*">
                                        </div>
                                        <?php endif ?>
                                        <div class="form-group">
                                            <div class="selectgroup selectgroup-secondary selectgroup-pills">
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="deceased" value="1"
                                                        class="selectgroup-input" checked="" id="alive">
                                                    <span class="selectgroup-button selectgroup-button-icon"><i
                                                            class="fa fa-walking"></i></span>
                                                </label>
                                                <p class="mt-1 mr-3"><b>Alive</b></p>
                                                &nbsp;&nbsp;&nbsp;
                                                <label class="selectgroup-item ml-10">
                                                    <input type="radio" name="deceased" value="0"
                                                        class="selectgroup-input" id="dead">
                                                    <span class="selectgroup-button selectgroup-button-icon"><i
                                                            class="fa fa-people-carry"></i></span>
                                                </label>
                                                <p class="mt-1 mr-3"><b>Deceased</b></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>National ID No.</label>
                                            <input type="text" class="form-control" name="national" id="nat_id"
                                                placeholder="Enter National ID No.">
                                        </div>
                                        <div class="form-group">
                                            <label>Citizenship</label>
                                            <input type="text" class="form-control" name="citizenship" id="citizenship"
                                                placeholder="Enter citizenship" required>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter first name" name="fname" id="fname" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Middle Name <small
                                                            class="text-secondary">Optional</small></label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter middle name" name="mname" id="mname">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter last name" name="lname" id="lname" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Alias <small class="text-secondary">Optional</small></label>
                                                    <input type="text" class="form-control" placeholder="Enter alias"
                                                        id="alias" name="alias">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Place of Birth</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter birth place" name="bplace" id="bplace"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Birth Date</label>
                                                    <input type="date" class="form-control" placeholder="" name="bdate"
                                                        id="bdate" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Age</label>
                                                    <input type="number" class="form-control" placeholder="Enter age"
                                                        min="1" name="age" id="age" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Civil Status</label>
                                                    <select class="form-control" required name="cstatus" id="cstatus">
                                                        <option disabled selected>Select civil status</option>
                                                        <option value="Single">Single</option>
                                                        <option value="Married">Married</option>
                                                        <option value="Widowed">Widowed</option>
                                                        <option value="Separated">Separated</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Gender</label>
                                                    <select class="form-control" required name="gender" id="gender">
                                                        <option disabled selected value="">Select gender</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Purok</label>
                                                    <select class="form-control" required name="purok" id="purok">
                                                        <option disabled selected>Select purok</option>
                                                        <?php foreach ($purok as $row) : ?>
                                                        <option value="<?= ucwords($row['name']) ?>"><?= $row['name'] ?>
                                                        </option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Household</label>
                                                    <select class="form-control household_id" name="household_id"
                                                        id="household_id">
                                                        <option disabled selected>Select household</option>
                                                        <?php foreach ($options as $id => $household_id) {
                                                            echo "<option value='$id'>$household_id</option>";
                                                        } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Voters Status</label>
                                                    <select class="form-control vstatus" required name="vstatus"
                                                        id="vstatus">
                                                        <option disabled selected>Select voters status</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Email Address</label>
                                                    <input type="email" class="form-control" placeholder="Enter email"
                                                        name="email" id="email">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Contact Number</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter contact number" name="number" id="number">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Occupation</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter occupation" name="occupation"
                                                        id="occupation">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea class="form-control" required name="address"
                                                placeholder="Enter address" id="address"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Remarks</label>
                                            <textarea class="form-control" name="remarks" placeholder="Enter remarks"
                                                id="remarks"></textarea>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" id="res_id">
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
        $('#residenttable').DataTable();
    });
    </script>
</body>

</html>