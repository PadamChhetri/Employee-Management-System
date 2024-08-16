<!-- <?php
session_start();

// Check if user is logged in, otherwise redirect to login page
// if (!isset($_SESSION["username"])) {
//     header("Location: login.php");
//     exit();
// }
?>

<?php
if (isset($_POST['submit'])) {
    $connection = mysqli_connect('localhost', 'root', 'root@123', 'project');

    if (!$connection) {
        die("Connection failed:" . mysqli_connect_error());
    }

    $employee_id = $_SESSION['id'];
    $employee_name = $_SESSION['email'];
    $loan_amount = $_POST['loan_amount'];
    $reason = $_POST['reason'];

    // Properly quote the string values in the SQL query
    $sql = "INSERT INTO loan_order (employe_id, employee_name, loan_amount, reason) 
            VALUES ('$employee_id',$employee_name, '$loan_amount', '$reason')";

    $result = mysqli_query($connection, $sql);

    if ($result) {
        $_SESSION['status'] = "Loan order successfully";
    } else {
        $_SESSION['status'] = "Loan registration failed: " . mysqli_error($connection);
    }

    mysqli_close($connection);
    // header("location:insertloan.php");
		// header('location:index.php');

    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Take Loan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: inline-block;
            width: 150px;
            font-weight: bold;
        }

        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group textarea {
            width: 300px;
            padding: 8px;
        }

        .form-group textarea {
            height: 100px;
        }

        .btn-submit {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <h2>Take Loan</h2>

    <form method="post" action="">
        <div class="form-group">
            <label for="employee_id">Employee ID:</label>
            <input type="text" id="employee_id" name="employee_id" value="<?php echo $_SESSION['id']; ?>" readonly>
        </div>

        <div class="form-group">
            <label for="loan_amount">Loan Amount:</label>
            <input type="number" id="loan_amount" name="loan_amount" required>
        </div>

        <div class="form-group">
            <label for="reason">Reason:</label>
            <textarea id="reason" name="reason" rows="4" cols="50" required></textarea>
        </div>

        <div class="form-group">
            <input type="submit" name="submit" value="Submit Loan Application" class="btn-submit">
        </div>
    </form>

</body>
</html> -->
