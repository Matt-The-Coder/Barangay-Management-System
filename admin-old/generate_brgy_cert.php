<?php include 'server/server.php' ?>
<?php
$id = $_GET['id'];
$query = "SELECT * FROM tblresident WHERE id='$id'";
$result = $conn->query($query);
$resident = $result->fetch_assoc();

$query1 = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblposition.position NOT IN ('SK Chairrman','Secretary','Treasurer')
                AND `status`='Active' ORDER BY `order` ASC";
$result1 = $conn->query($query1);
$officials = array();
while ($row = $result1->fetch_assoc()) {
    $officials[] = $row;
}

$c = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblposition.position='Captain'";
$captain = $conn->query($c)->fetch_assoc();
$s = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblposition.position='Secretary'";
$sec = $conn->query($s)->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'templates/header.php' ?>
    <title>Barangay Certificate - Barangay Management System</title>
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
                                <h2 class="fw-bold">Generate Certificate</h2>
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
                                        <div class="card-title">Barangay Certificate</div>
                                        <div class="card-tools">
                                            <button class="btn btn-info btn-border btn-round btn-sm"
                                                onclick="printDiv('printThis')">
                                                <i class="fa fa-print"></i>
                                                Print Certificate
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body m-5" id="printThis">
                                    <div class="d-flex flex-wrap justify-content-center"
                                        style="border-bottom:1px solid red">
                                        <div class="text-center">
                                            <h4 class="mb-0">Republic of the Philippines</h4>
                                            <h4 class="mb-0">Province of <?= ucwords($province) ?></h4>
                                            <h4 class="mb-0"><?= ucwords($town) ?></h4>
                                            <h2 class="fw-bold mb-0"><?= ucwords($brgy) ?></i></h2>
                                            <p><i>Mobile No. <?= $number ?></i></p>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-3">
                                            <div class="text-center p-3" style="border:2px dotted red">
                                                <img src="assets/uploads/<?= $brgy_logo ?>" class="img-fluid"
                                                    width="200" />
                                                <?php if (!empty($officials)) : ?>
                                                <?php foreach ($officials as $row) : ?>
                                                <h6 class="mt-3 fw-bold mb-0 text-uppercase">
                                                    <?= ucwords($row['name']) ?></h6>
                                                <h6 class="mb-2 text-uppercase"><?= ucwords($row['position']) ?>
                                                </h6>
                                                <?php endforeach ?>
                                                <?php endif ?>

                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="text-center">
                                                <h4 class="mt-4 fw-bold">OFFICE OF THE BARANGAY CAPTAIN</h4>
                                            </div>
                                            <div class="text-center">
                                                <h4 class="mt-4 fw-bold mb-5">BARANGAY CLEARANCE</h4>
                                            </div>
                                            <h5 class="mt-5">TO WHOM IT MAY CONCERN:</h5>
                                            <h5 class="mt-3" style="text-indent: 40px;">This is to certify that <span
                                                    class="fw-bold"
                                                    style="font-size:20px"><?= ucwords($resident['firstname'] . ' ' . $resident['middlename'] . ' ' . $resident['lastname']) ?></span>,
                                                is a permanent resident of
                                                <span class="fw-bold"
                                                    style="font-size:20px"><?= ucwords($brgy) ?></span> and that he/she
                                                is known to me to be of good moral character.
                                            </h5>
                                            <h5 class="mt-3" style="text-indent: 40px;">This certification/clearance is
                                                hereby issued to the above-named person for whatever legal purpose it
                                                may serve him/her best.</h5>
                                            <h5 class="mt-5">Given this <span class="fw-bold"
                                                    style="font-size:21px"><?= date('m/d/Y') ?>.</span></h5>
                                            <h5 class="text-uppercase" style="margin-top:180px;">NOT VALID WITHOUT SEAL:
                                            </h5>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="p-3 text-right mr-3">
                                                <h3 class="fw-bold mb-0 text-uppercase"><?= ucwords($captain['name']) ?>
                                                </h3>
                                                <p class="mr-3">PUNONG BARANGAY</p>
                                            </div>
                                            <div class="p-3 text-left">
                                                <h3 class="fw-bold mb-0 text-uppercase">
                                                    <?= empty($sec['name']) ? 'Please Create Official with Secretary Position' : ucwords($sec['name']) ?>
                                                </h3>
                                                <p class="ml-2">BARANGAY SECRETARY</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 d-flex flex-wrap justify-content-end">
                                            <div class="p-3 text-center">
                                                <div class="border mb-3" style="height:150px;width:290px">
                                                    <p class="mt-5 mb-0 pt-5">Right Thumb Mark</p>
                                                </div>
                                                <h3 class="fw-bold mb-0">
                                                    <?= ucwords($resident['firstname'] . ' ' . $resident['middlename'] . ' ' . $resident['lastname']) ?>
                                                </h3>
                                                <p>Tax Payer's Signature</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Payment</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_payment.php">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number" class="form-control" name="amount"
                                        placeholder="Enter amount to pay" required>
                                </div>
                                <div class="form-group">
                                    <label>Date Issued</label>
                                    <input type="date" class="form-control" name="date" value="<?= date('Y-m-d') ?>">
                                </div>
                                <div class="form-group">
                                    <label>Payment Details(Optional)</label>
                                    <textarea class="form-control" placeholder="Enter Payment Details"
                                        name="details">Barangay Clearance Payment</textarea>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="name"
                                value="<?= ucwords($resident['firstname'] . ' ' . $resident['middlename'] . ' ' . $resident['lastname']) ?>">
                            <button type="button" class="btn btn-secondary" onclick="goBack()">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Main Footer -->
            <?php include 'templates/main-footer.php' ?>
            <!-- End Main Footer -->
            <?php if (!isset($_GET['closeModal'])) { ?>

            <script>
            setTimeout(function() {
                openModal();
            }, 1000);
            </script>
            <?php } ?>
        </div>

    </div>
    <?php include 'templates/footer.php' ?>
    <script>
    function openModal() {
        $('#payment').modal('show');
    }

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