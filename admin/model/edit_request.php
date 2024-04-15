<?php
include '../server/server.php';

if (!isset($_SESSION['username'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

$id     = $conn->real_escape_string($_POST['id']);
$fname    = $conn->real_escape_string($_POST['fname']);
$mname    = $conn->real_escape_string($_POST['mname']);
$lname    = $conn->real_escape_string($_POST['lname']);
$type     = $conn->real_escape_string($_POST['type']);
$pickup     = $conn->real_escape_string($_POST['pickup']);
$payment         = $conn->real_escape_string($_POST['payment']);
$reference             = $conn->real_escape_string($_POST['reference']);
$purpose         = $conn->real_escape_string($_POST['purpose']);
$date_req           = $conn->real_escape_string($_POST['date_req']);
$docstatus             = $conn->real_escape_string($_POST['docstatus']);
$tracking_code         = $conn->real_escape_string($_POST['tracking_code']);

if (!empty($id)) {

    $query         = "UPDATE tbldocument SET `fname`='$fname', `mname`='$mname', `lname`='$lname', `type`='$type', `pickup`='$pickup', `payment`='$payment',`reference`='$reference', `purpose`='$purpose', `date_req`='$date_req', `docstatus`='$docstatus', `tracking_code`='$tracking_code' WHERE id=$id;";
    $result     = $conn->query($query);

    if ($result === true) {

        $_SESSION['message'] = 'Requested document details has been updated!';
        $_SESSION['success'] = 'success';
    } else {

        $_SESSION['message'] = 'Something went wrong!';
        $_SESSION['success'] = 'danger';
    }
} else {
    $_SESSION['message'] = 'No request ID found!';
    $_SESSION['success'] = 'danger';
}

header("Location: ../request.php");

$conn->close();
