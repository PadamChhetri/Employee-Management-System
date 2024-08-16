<?php
    // $conn=mysqli_connect('localhost','root','root@123','project');
    
    // if(!$conn){
    //     echo "Database not connected";
    // }
    // $sql="CREATE TABLE Employe(
    //     id INT PRIMARY KEY Auto_increment,
    //     name CHAR(50) NOT NULL,
    //     password VARCHAR(50) NOT NULL,
    //     email VARCHAR(50) NOT NULL,
    //     salary int(50) NOT NULL
    // )";


    // if(mysqli_query($conn,$sql)){
    //     echo "Table created succesfully";
    // }
    // else{
    //     echo "Table not created";
    // }
    // mysqli_close($conn);
?>

<?php
    $conn=mysqli_connect('localhost','root','root@123','project');
    
    if(!$conn){
        echo "Database not connected";
    }
    $sql="CREATE TABLE admin(
        id INT PRIMARY KEY Auto_increment,
        name CHAR(50) NOT NULL,
        password VARCHAR(50) NOT NULL
    )";


    if(mysqli_query($conn,$sql)){
        echo "Table created succesfully";
    }
    else{
        echo "Table not created";
    }
    mysqli_close($conn);
?>