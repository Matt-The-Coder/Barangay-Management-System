<?php
include('../server/server.php');

if (!isset($_SESSION['username'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

$house_no         = $conn->real_escape_string($_POST['house_no']);
$address     = $conn->real_escape_string($_POST['address']);
$id         = $conn->real_escape_string($_POST['id']);

if (!empty($house_no)) {

    $query         = "UPDATE tblhousehold SET `house_no` = '$house_no', `address`='$address' WHERE id=$id;";
    $result     = $conn->query($query);

    if ($result === true) {
        $_SESSION['message'] = 'Household has been updated!';
        $_SESSION['success'] = 'success';
    } else {
        $_SESSION['message'] = 'Something went wrong!';
        $_SESSION['success'] = 'danger';
    }
} else {

    $_SESSION['message'] = 'No household ID found!';
    $_SESSION['success'] = 'danger';
}

header("Location: ../household.php");

$conn->close();
