<?php
include 'server/server.php';
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
?>
<?php

$query = "SELECT * FROM tblresident WHERE resident_type=1";
$result = $conn->query($query);
$total = $result->num_rows;

$query1 = "SELECT * FROM tblresident WHERE gender='Male' AND resident_type=1";
$result1 = $conn->query($query1);
$male = $result1->num_rows;

$query2 = "SELECT * FROM tblresident WHERE gender='Female' AND resident_type=1";
$result2 = $conn->query($query2);
$female = $result2->num_rows;

$query3 = "SELECT * FROM tblresident WHERE voterstatus='Yes' AND resident_type=1";
$result3 = $conn->query($query3);
$totalvoters = $result3->num_rows;

$query4 = "SELECT * FROM tblresident WHERE voterstatus='No' AND resident_type=1";
$non = $conn->query($query4)->num_rows;

$query5 = "SELECT * FROM tblpurok";
$purok = $conn->query($query5)->num_rows;

$query6 = "SELECT * FROM tblprecinct";
$precinct = $conn->query($query6)->num_rows;

$query7 = "SELECT * FROM tblblotter";
$blotter = $conn->query($query7)->num_rows;

$date = date('Y-m-d');
$query8 = "SELECT SUM(amounts) as am FROM tblpayments WHERE `date`='$date'";
$revenue = $conn->query($query8)->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'templates/header.php' ?>
    <title>Dashboard - Barangay Management System</title>
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
                                <h2 class="fw-bold">Dashboard</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner mt--2">
                    <?php if (isset($_SESSION['message'])) : ?>
                    <div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success'] == 'danger' ? 'bg-danger text-light' : null ?>"
                        role="alert">
                        <?php echo $_SESSION['message']; ?>
                    </div>
                    <?php unset($_SESSION['message']); ?>
                    <?php endif ?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card card-stats card-secondary card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6 col-stats">
                                            <div class="numbers mt-2">
                                                <h4 class="fw-bold text-uppercase">Population</h4>
                                                <h3 class="fw-bold text-uppercase"><?= number_format($total) ?></h3>
                                            </div>
                                        </div>
                                        <div class="col-3 col-stats">
                                        </div>
                                        <div class="col-3">
                                            <div class="icon-big text-center">
                                                <i class="ri-team-line" style="font-size: 3.4rem"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body card-round" style="background: #6e4caa;">
                                    <a href="resident_info.php?state=all"
                                        class="card-link text-light text-decoration-none">Total Population
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-stats card-primary card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 col-stats">
                                            <div class="numbers mt-2">
                                                <h4 class="fw-bold text-uppercase">Male</h4>
                                                <h3 class="fw-bold"><?= number_format($male) ?></h3>
                                            </div>
                                        </div>
                                        <div class="col-5 col-stats">
                                        </div>
                                        <div class="col-3">
                                            <div class="icon-big text-center">
                                                <i class="ri-men-line" style="font-size: 3.4rem"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body card-round" style="background: #3666b4;">
                                    <a href=" resident_info.php?state=male"
                                        class="card-link text-light text-decoration-none">Total Male </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-stats card-round" style="background-color:#F06292; color:#fff">
                                <div class=" card-body">
                                    <div class="row">
                                        <div class="col-5 col-stats">
                                            <div class="numbers mt-2">
                                                <h4 class="fw-bold text-uppercase">Female</h4>
                                                <h3 class="fw-bold text-uppercase"><?= number_format($female) ?></h3>
                                            </div>
                                        </div>
                                        <div class="col-4 col-stats">
                                        </div>
                                        <div class="col-3">
                                            <div class="icon-big text-center">
                                                <i class="ri-women-line" style="font-size: 3.4rem"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body card-round" style="background: #db5783;">
                                    <a href=" resident_info.php?state=female"
                                        class="card-link text-light text-decoration-none">Total Female
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if (isset($_SESSION['username']) && $_SESSION['role'] == 'administrator') : ?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card card-stats card-success card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5 col-stats">
                                            <div class="numbers mt-2">
                                                <h4 class="fw-bold text-uppercase">Voters</h4>
                                                <h3 class="fw-bold text-uppercase"><?= number_format($totalvoters) ?>
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="col-4 col-stats">
                                        </div>
                                        <div class="col-3">
                                            <div class="icon-big text-center">
                                                <i class="ri-user-follow-line" style="font-size: 3.4rem"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body card-round" style="background: #139145;">
                                    <a href=" resident_info.php?state=voters"
                                        class="card-link text-light text-decoration-none">Total Voters
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-stats card-danger card-round">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6 col-stats">
                                            <div class="numbers mt-2">
                                                <h4 class="fw-bold text-uppercase">Non-Voters</h4>
                                                <h3 class="fw-bold text-uppercase"><?= number_format($non) ?></h3>
                                            </div>
                                        </div>
                                        <div class="col-3 col-stats">
                                        </div>
                                        <div class="col-3">
                                            <div class="icon-big text-center">
                                                <i class="ri-user-unfollow-line" style="font-size: 3.4rem"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body card-round" style="background: #c03f54;">
                                    <a href="resident_info.php?state=non_voters"
                                        class="card-link text-light text-decoration-none">Total Non-Voters </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-stats card-round" style="background-color:#BA68C8; color:#fff">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6 col-stats">
                                            <div class="numbers mt-2">
                                                <h4 class="fw-bold text-uppercase">Precinct</h4>
                                                <h3 class="fw-bold"><?= number_format($precinct) ?></h3>
                                            </div>
                                        </div>
                                        <div class="col-3 col-stats">
                                        </div>
                                        <div class="col-3">
                                            <div class="icon-big text-center">
                                                <i class="ri-building-line" style="font-size: 3.4rem"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body card-round" style="background: #a45ab1;">
                                    <a href="purok_info.php?state=precinct"
                                        class="card-link text-light text-decoration-none">Precint
                                        Information</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-stats card-round" style="background-color:#26A69A; color:#fff">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5 col-stats">
                                            <div class="numbers mt-2">
                                                <h4 class="fw-bold text-uppercase">Purok</h4>
                                                <h3 class="fw-bold text-uppercase"><?= number_format($purok) ?></h3>
                                            </div>
                                        </div>
                                        <div class="col-4 col-stats">
                                        </div>
                                        <div class="col-3">
                                            <div class="icon-big text-center">
                                                <i class="ri-community-line" style="font-size: 3.4rem"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body card-round" style="background: #219589;">
                                    <a href="purok_info.php?state=purok"
                                        class="card-link text-light text-decoration-none">Purok
                                        Information</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-stats card-round card-info">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-5 col-stats">
                                            <div class="numbers mt-2">
                                                <h4 class="fw-bold text-uppercase">Blotter</h4>
                                                <h3 class="fw-bold text-uppercase"><?= number_format($blotter) ?></h3>
                                            </div>
                                        </div>
                                        <div class="col-4 col-stats">
                                        </div>
                                        <div class="col-3">
                                            <div class="icon-big text   -center">
                                                <i class="ri-stack-line" style="font-size: 3.4rem"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body card-round" style="background: #4ba1be;">
                                    <a href="blotter.php" class="card-link text-light text-decoration-none">Blotter
                                        Information</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-stats card-round card-warning">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6 col-stats">
                                            <div class="numbers mt-2">
                                                <h4 class="fw-bold text-uppercase">Revenue(Day)</h4>
                                                <h3 class="fw-bold text-uppercase">P
                                                    <?= number_format($revenue['am'], 2) ?></h3>
                                            </div>
                                        </div>
                                        <div class="col-3 col-stats">
                                        </div>
                                        <div class="col-3">
                                            <div class="icon-big text-center">
                                                <i class="ri-wallet-line" style="font-size: 3.4rem"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body card-round" style="background: #cd9016;">
                                    <a href="revenue.php" class="card-link text-light text-decoration-none">All
                                        Revenues</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <div class="card-title fw-bold">LGU Mission Statement</div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p><?= !empty($db_txt) ? $db_txt : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque in ipsum id orci porta dapibus. Donec rutrum congue leo eget malesuada. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Quisque velit nisi, pretium ut lacinia in, elementum id enim.' ?>
                                    </p>
                                    <div class="text-center">
                                        <img class="img-fluid"
                                            src="<?= !empty($db_img) ? 'assets/uploads/' . $db_img : 'assets/img/bg-abstract.png' ?>" />
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

</html>