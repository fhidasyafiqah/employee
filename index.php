<?php
include 'config.php';

$limit = 5;
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$start_from = ($page - 1) * $limit;

$sql = "SELECT * FROM employees ORDER BY id ASC LIMIT $start_from, $limit";
$rs_result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee List</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Employee List</h2>

        <?php
        if (isset($_GET['message'])) {
            if ($_GET['message'] == 'updated') {
                echo '<div class="alert alert-success">Updated successfully</div>';
            } elseif ($_GET['message'] == 'deleted') {
                echo '<div class="alert alert-success">Deleted successfully</div>';
            } elseif ($_GET['message'] == 'error') {
                echo '<div class="alert alert-danger">An error occurred</div>';
            }
        }
        ?>

        <a href="create.php" class="btn">Create New Employee</a>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>Salary</th>
                <th>Actions</th>
            </tr>
            <?php
            while ($row = $rs_result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["address"]; ?></td>
                    <td><?php echo $row["salary"]; ?></td>
                    <td>
                        <a href="update.php?id=<?php echo $row["id"]; ?>">Edit</a>
                        <a href="confirm_delete.php?id=<?php echo $row["id"]; ?>">Delete</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>

        <?php
        $sql = "SELECT COUNT(id) FROM employees";
        $rs_result = $conn->query($sql);
        $row = $rs_result->fetch_row();
        $total_records = $row[0];
        $total_pages = ceil($total_records / $limit);

        echo '<div class="pagination">';
        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $page) {
                echo "<a href='index.php?page=".$i."' class='active'>".$i."</a> ";
            } else {
                echo "<a href='index.php?page=".$i."'>".$i."</a> ";
            }
        }
        echo '</div>';
        ?>
    </div>
</body>
</html>
