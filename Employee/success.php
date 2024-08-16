<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        .message {
            text-align: center;
            padding: 20px;
            border: 2px solid #4CAF50;
            border-radius: 10px;
            background-color: #fff;
        }
        .message h1 {
            color: #4CAF50;
        }
    </style>
</head>

<body>
    <div class="message">
        <?php
        session_start();
        $id = $_SESSION['id'];

        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "root@123";
        $dbname = "project"; // Replace with your database name

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // SQL query to delete the loan record
        $sql = "DELETE FROM loan WHERE employe_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i",$id);

        if ($stmt->execute()) {
            echo "<h1>Payment Successful!</h1>";
            echo "<p>You have successfully paid your loan.</p>";
            echo "<p>The loan record has been deleted.</p>";
        } else {
            echo "<h1>Payment Successful!</h1>";
            echo "<p>You have successfully paid your loan.</p>";
            echo "<p>However, there was an error deleting the loan record.</p>";
        }

        $stmt->close();
        $conn->close();
        ?>
        <p>You will be redirected to the homepage in 3 seconds...</p>
    </div>
    <script>
        setTimeout(function() {
            window.location.href = 'dashboard.php';
        }, 3000);
    </script>
</body>

</html>
