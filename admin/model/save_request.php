<?php
include('../server/server.php');

if (!isset($_SESSION['username'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

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

if (!empty($fname) && !empty($lname) && !empty($type) && !empty($pickup) && !empty($payment) && !empty($purpose) && !empty($date_req) && !empty($docstatus) && !empty($tracking_code)) {

    $insert  = "INSERT INTO tbldocument (`fname`,`mname`,`lname`,`type`,`pickup`, `payment`, `reference`, `purpose`,`date_req`, `docstatus`, `tracking_code`) 
                    VALUES ('$fname', '$mname', '$lname', '$type', '$pickup','$payment', '$reference','$purpose','$date_req', '$docstatus','$tracking_code')";
    $result  = $conn->query($insert);

    if ($result === true) {
        $_SESSION['message'] = 'Request added!';
        $_SESSION['success'] = 'success';
    } else {
        $_SESSION['message'] = 'Something went wrong!';
        $_SESSION['success'] = 'danger';
    }
} else {

    $_SESSION['message'] = 'Please fill up the form completely!';
    $_SESSION['success'] = 'danger';
}

header("Location: ../request.php");

$conn->close();
