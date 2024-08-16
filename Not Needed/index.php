<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employe management system</title>


    <style>
    body, html {
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', Arial, sans-serif;
    background-color: gray; 
    
}

.sidebar .logo {
    text-align: center;
    margin-bottom: 15px; 
}

.sidebar .logo img {
    width: 50%; 
    height: auto;
}

.dashboard {
    display: flex;
    height: 100vh;
    
}

.sidebar {
    width: 250px;
    background-color: maroon; 
    color: white;
    padding: 20px;
    /* box-shadow: 3px 0 10px rgba(0, 0, 0, 0.1); */
}

.sidebar h2 {
    color: white;
    margin-top: 0;
}

.sidebar ul {
    list-style-type: none;
    padding: 0;
}

.sidebar ul li {
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 5px;
    transition: background-color 0.3s;
}

.sidebar ul li:hover {
    background-color: paleturquoise;; 
    cursor: pointer;
}

.sidebar ul li a {
    color: white;
    text-decoration: none;
}

.content {
    flex-grow: 1;
    padding: 40px;
    background-color:rgba(0, 0, 0, 0.467);
    overflow-y: auto;
}

.content h1 {
    color: white;
    margin-top: 0;
}




@media (max-width: 768px) {
    .sidebar {
        width: 100%;
        height: auto;
        position: relative;
    }
    .content {
        padding: 20px;
    }
}

        </style>

</head>
<body>
    <div class="dashboard">
        <nav class="sidebar">
            <div class="logo">
                <img src="img/download.png" alt="School  Logo">
            </div>
            <h2>Dashboard</h2>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="signup.php">Signup</a></li>
                <li><a href="view.php"> View Employee</a></li>
                <li><a href="login.php">login</a></li>
            
            </ul>
        </nav>
        <main class="content">
            
            <h1>Employee management system</h1>
           

            </main>
            </div>
            </body>
            </html>