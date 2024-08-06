<?php
include 'config.php';

$id = $_GET['id'];

$sql = "DELETE FROM employees WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    $_SESSION['success'] = "Employee deleted successfully";
} else {
    $_SESSION['error'] = "Error: " . $sql . "<br>" . $conn->error;
}

header("Location: index.php");
exit();
?>
