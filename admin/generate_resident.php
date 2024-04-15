<?php
include 'server/server.php';
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
?>
<?php
$id = $_GET['id'];
$query = "SELECT * FROM tblresident WHERE id='$id'";
$result = $conn->query($query);
$resident = $result->fetch_assoc();

$household_id = $resident["household_id"];
$query_household = "SELECT house_no FROM tblhousehold WHERE id='$household_id'";
$result_household = $conn->query($query_household);
$household = $result_household->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'templates/header.php' ?>
    <title>Generate Resident Profile - Barangay Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-print-css/css/bootstrap-print.min.css"
        media="print">
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
                                <h2 class="fw-bold">Generate Resident Profile</h2>
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
                                        <div class="card-title">Resident Profile</div>
                                        <div class="card-tools">
                                            <button class="btn btn-info btn-border btn-round btn-sm"
                                                onclick="printDiv('printThis')">
                                                <i class="fa fa-print"></i>
                                                Print Report
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body m-5" id="printThis">
                                    <div class="d-flex flex-wrap justify-content-center"
                                        style="border-bottom:1px solid red">
                                        <div class="text-center">
                                            <h4 class="mb-0">Republic of the Philippines</h3>
                                                <h4 class="mb-0">Province of <?= ucwords($province) ?></h4>
                                                <h4 class="mb-0"><?= ucwords($town) ?></h5>
                                                    <h2 class="fw-bold mb-0"><?= ucwords($brgy) ?></i></h1>
                                                        <p><i>Mobile No. <?= $number ?></i></p>
                                                        <h2 class="fw-bold mb-3">Resident Profile</h2>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-3">
                                            <div class="mt-4 text-center p-1" style="border:1px solid red">
                                                <img src="<?= preg_match('/data:image/i', $resident['picture']) ? $resident['picture'] : 'assets/uploads/resident_profile/' . $resident['picture'] ?>"
                                                    alt="Resident Profile" class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group row">
                                                        <h5
                                                            class="mt-5 col-lg-5 col-md-5 col-sm-5 mt-sm-2 text-left fw-bold">
                                                            National ID:</h5>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <input type="text" class="form-control" style="font-size:20px"
                                                            value="<?= $resident['national_id'] ?>" readonly>
                                                    </div>

                                                    <div class="form-group row">
                                                        <h5
                                                            class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left fw-bold">
                                                            Name:</h5>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <input type="text" class="form-control" style="font-size:20px"
                                                            value="<?= ucwords($resident['firstname'] . ' ' . $resident['middlename'] . ' ' . $resident['lastname']) ?>"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group row">
                                                        <h5
                                                            class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left fw-bold">
                                                            Status:</h5>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <input type="text" class="form-control" style="font-size:20px"
                                                            value="<?= $resident['resident_type'] == 1 ? 'Alive' : 'Deceased' ?>"
                                                            readonly>
                                                    </div>

                                                    <div class="form-group row">
                                                        <h5
                                                            class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left fw-bold">
                                                            Alias:</h5>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                        <input type="text" class="form-control" style="font-size:20px"
                                                            value="<?= $resident['alias'] ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <h5 class="mt-5 col-lg-5 col-md-5 col-sm-5 mt-sm-2 text-left fw-bold">
                                                    Birthdate:
                                                </h5>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                <input type="text" class="form-control" style="font-size:20px"
                                                    value="<?= date('F d, Y', strtotime($resident['birthdate'])) ?>"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group row">
                                                <h5 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left fw-bold">
                                                    Age:</h5>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                <input type="text" class="form-control" style="font-size:20px"
                                                    value="<?= $resident['age'] ?> yrs. old" readonly>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group row">
                                                <h5 class="mt-5 col-lg-6 col-md-6 col-sm-6 mt-sm-2 text-left fw-bold">
                                                    Civil
                                                    Status:</h5>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                <input type="text" class="form-control" style="font-size:20px"
                                                    value="<?= $resident['civilstatus'] ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <h5 class="mt-5 col-lg-5 col-md-5 col-sm-5 mt-sm-2 text-left fw-bold">
                                                    Gender:
                                                </h5>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                <input type="text" class="form-control" style="font-size:20px"
                                                    value="<?= $resident['gender'] ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group row">
                                                <h5 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left fw-bold">
                                                    Purok:
                                                </h5>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                <input type="text" class="form-control" style="font-size:20px"
                                                    value="<?= $resident['purok'] ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group row">
                                                <h5 class="mt-5 col-lg-7 col-md-7 col-sm-7 mt-sm-2 text-left fw-bold">
                                                    Voters
                                                    Status:</h5>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                <input type="text" class="form-control" style="font-size:20px"
                                                    value="<?= $resident['voterstatus'] ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <h5 class="mt-5 col-lg-6 col-md-6 col-sm-6 mt-sm-2 text-left fw-bold">
                                                    Household:</h5>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                <input type="text" class="form-control text-left" style="font-size:20px"
                                                    value="<?= $household['house_no'] ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group row">
                                                <h5 class="mt-5 col-lg-7 col-md-7 col-sm-7 mt-sm-2 text-left fw-bold">
                                                    Phone
                                                    number:</h5>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                <input type="text" class="form-control" style="font-size:20px"
                                                    value="<?= $resident['phone'] ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group row">
                                                <h5 class="mt-5 col-lg-7 col-md-7 col-sm-7 mt-sm-2 text-left fw-bold">
                                                    Email
                                                    Address:</h5>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                <input type="text" class="form-control" style="font-size:20px"
                                                    value="<?= $resident['email'] ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <h5 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left fw-bold">
                                                    Occupation:</h5>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                <textarea class="form-control" style="font-size:20px" rows="3"
                                                    readonly><?= ucwords(trim($resident['occupation'])) ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <h5 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left fw-bold">
                                                    Address:
                                                </h5>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                <textarea class="form-control" style="font-size:20px" rows="3"
                                                    readonly><?= ucwords(trim($resident['address'])) ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <h5 class="mt-5 col-lg-4 col-md-4 col-sm-4 mt-sm-2 text-left fw-bold">
                                                    Remarks:
                                                </h5>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 text-left">
                                                <textarea class="form-control" style="font-size:20px" rows="3"
                                                    readonly><?= ucwords(trim($resident['remarks'])) ?></textarea>
                                            </div>
                                        </div>
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
    <script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
    </script>
</body>

</html>