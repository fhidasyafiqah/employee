<?php
include 'config.php';

$nameError = $addressError = $salaryError = "";
$name = $address = $salary = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameError = "Name is required";
    } else {
        $name = $_POST["name"];
    }

    if (empty($_POST["address"])) {
        $addressError = "Address is required";
    } else {
        $address = $_POST["address"];
    }

    if (empty($_POST["salary"])) {
        $salaryError = "Salary is required";
    } else {
        $salary = $_POST["salary"];
    }

    if ($name && $address && $salary) {
        $sql = "INSERT INTO employees (name, address, salary) VALUES ('$name', '$address', '$salary')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['success'] = "Employee created successfully";
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['error'] = "Error: " . $sql . "<br>" . $conn->error;
            header("Location: create.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Employee</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script>
        function validateForm() {
            let valid = true;

            let name = document.forms["employeeForm"]["name"].value;
            if (name == "") {
                document.getElementById("nameError").innerHTML = "Name is required";
                valid = false;
            } else {
                document.getElementById("nameError").innerHTML = "";
            }

            let address = document.forms["employeeForm"]["address"].value;
            if (address == "") {
                document.getElementById("addressError").innerHTML = "Address is required";
                valid = false;
            } else {
                document.getElementById("addressError").innerHTML = "";
            }

            let salary = document.forms["employeeForm"]["salary"].value;
            if (salary == "") {
                document.getElementById("salaryError").innerHTML = "Salary is required";
                valid = false;
            } else {
                document.getElementById("salaryError").innerHTML = "";
            }

            return valid;
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Create Employee</h2>
        <form name="employeeForm" method="post" action="create.php" onsubmit="return validateForm()">
            Name: <input type="text" name="name" value="<?php echo $name; ?>" required>
            <span class="error" id="nameError">* <?php echo $nameError;?></span><br>
            Address: <input type="text" name="address" value="<?php echo $address; ?>" required>
            <span class="error" id="addressError">* <?php echo $addressError;?></span><br>
            Salary: <input type="number" name="salary" step="0.01" value="<?php echo $salary; ?>" required>
            <span class="error" id="salaryError">* <?php echo $salaryError;?></span><br>
            <input type="submit" value="Submit" class="btn">
        </form>
        <a href="index.php" class="btn">Back to List</a>
    </div>
</body>
</html>
