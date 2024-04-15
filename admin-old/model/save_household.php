<?php
include('../server/server.php');

if (!isset($_SESSION['username'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

$house_no     = $conn->real_escape_string($_POST['house_no']);
$address     = $conn->real_escape_string($_POST['address']);

if (!empty($house_no)) {

    $insert  = "INSERT INTO tblhousehold (`house_no`, `address`) VALUES ('$house_no', '$address')";
    $result  = $conn->query($insert);

    if ($result === true) {
        $_SESSION['message'] = 'Household added!';
        $_SESSION['success'] = 'success';
    } else {
        $_SESSION['message'] = 'Something went wrong!';
        $_SESSION['success'] = 'danger';
    }
} else {

    $_SESSION['message'] = 'Please fill up the form completely!';
    $_SESSION['success'] = 'danger';
}

header("Location: ../household.php");

$conn->close();
