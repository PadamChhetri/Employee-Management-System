<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failure</title>
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
            border: 2px solid #f44336;
            border-radius: 10px;
            background-color: #fff;
        }
        .message h1 {
            color: #f44336;
        }
    </style>
</head>

<body>
    <div class="message">
        <h1>Payment Failed</h1>
        <p>There was an issue processing your payment.</p>
        <p>Please try again later.</p>
        <p>You will be redirected to the dashboard in 5 seconds...</p>
    </div>
    <script>
        setTimeout(function() {
            window.location.href = 'dashboard.php';
        }, 5000);
    </script>
</body>

</html>
