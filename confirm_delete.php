<?php
include 'config.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['confirm'])) {
        $sql = "DELETE FROM employees WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['success'] = "Employee deleted successfully";
        } else {
            $_SESSION['error'] = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    header("Location: index.php");
    exit();
}

$sql = "SELECT * FROM employees WHERE id=$id";
$result = $conn->query($sql);
$employee = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Confirm Delete</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Confirm Delete</h2>
        <div class="alert alert-warning">
            Are you sure you want to delete the following record?
            <br><br>
            <strong>ID:</strong> <?php echo $employee['id']; ?><br>
            <strong>Name:</strong> <?php echo $employee['name']; ?><br>
            <strong>Address:</strong> <?php echo $employee['address']; ?><br>
            <strong>Salary:</strong> <?php echo $employee['salary']; ?><br>
        </div>
        <form method="post" action="confirm_delete.php?id=<?php echo $id; ?>">
            <button type="submit" name="confirm" class="btn confirm-button">Yes</button>
            <a href="index.php" class="btn cancel-button">No</a>
        </form>
    </div>
</body>
</html>
