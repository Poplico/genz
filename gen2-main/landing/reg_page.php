<?php
session_start();

$servername = "www.genzfinancial.com";
$username = "remotegenz";
$password = "password";
$dbname = "genz-info-user";

$uname = strtolower($_POST['uname']);
$psw = $_POST['psw'];
$email = $_POST['email'];
$fname = $_POST['first'];
$lname = $_POST['last'];

$create = "CREATE TABLE ".$uname."(
id INT UNSIGNED NOT NULL AUTO_INCREMENT,
symbol varchar (20) NOT NULL,
quantity varchar (20)NOT NULL,
at varchar (20) NOT NULL,
spent varchar (20) NOT NULL,
made varchar (20) NOT NULL,
PRIMARY KEY(id)
) ENGINE=INNODB";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO userlogin (username, firstname, lastname, password, email)
VALUES ('$uname', '$fname', '$lname', '$psw', '$email')";

if (mysqli_query($conn, $sql)) {
    if (preg_match('/\s/',$uname) == true || preg_match('/\s/',$email) == true || preg_match('/\s/',$psw) == true) {
        header("Location: http://www.genzfinancial.com/gen2/landing/login.php");
        $_SESSION["errormsg"] = "Username and password cannot contain spaces.";
        $_SESSION["error"] = true;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: http://www.genzfinancial.com/gen2/landing/login.php");
        $_SESSION["errormsg"] = "Invalid email format"; 
        $_SESSION["error"] = true;
    } else {
        $results = mysqli_query($conn, $create);
        header("Location: http://www.genzfinancial.com/gen2/index.php");
        echo "New record created successfully";
        session_unset();
        session_destroy();
        session_start();
        $_SESSION["userID"] = "$uname";
        $_SESSION["valid"] = true;
        $_SESSION["firstDir"] = true;
        $_SESSION["validSymbol"] = true;
    }}
else {
    header("Location: http://www.genzfinancial.com/gen2/landing/login.php");
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    $_SESSION["errormsg"] = "Username or email is already taken.";
    $_SESSION["error"] = true;
}

mysqli_close($conn);
?>