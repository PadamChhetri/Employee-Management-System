<?php
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to login page after logout
echo "<script>alert('Logged Out successfully')
setTimeout(function(){
    window.location.href=\"employe-login.php\"
},10);
</script>";
// header("Location: employe-login.php");
exit();
?>