<?php
session_start(); // Starting Session

include('../datafetch.php');



// Define $username and $password
$subuser = strtolower($_POST['uname']);
$subpass = $_POST['psw'];



$db = mysqli_select_db($conn, "genzaccess");
// SQL query to fetch information of registerd users and finds user match.
$query = mysqli_query($conn, "select * from userlogin where password='$subpass' AND username='$subuser'");
$rows = mysqli_num_rows($query);  
  
if ($rows == 1) {
header("Location: http://www.genzfinancial.com/gen2/index.php");
$_SESSION['valid']= true;
$_SESSION["validSymbol"] = true;
$_SESSION['userID']= $subuser; // Initializing Session
    
    $balance = "SELECT balance FROM userlogin WHERE username = '$subuser'";
    $result = mysqli_query($conn, $balance);
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $remaining = $row['balance'];
    $fbal = number_format((float)$remaining, 2, '.', '');
    $_SESSION['balance'] = $fbal;
}

} else {
header("Location: http://www.genzfinancial.com/gen2/landing/login.php");
$_SESSION["error"] = true;
$_SESSION["errormsg"] = "Incorrect username or password.";    

}

    
mysqli_close($connection); // Closing Connection

?>