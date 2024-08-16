<?php
session_start();
session_unset();

echo "<script>alert('Logged Out successfully')
        setTimeout(function(){
            window.location.href=\"login.php\"
        },10);
        </script>";
// header('location:login.php');
exit(0);
?>