<?php

session_start();
session_unset();
session_destroy();

header("location: http://www.genzfinancial.com/gen2/index.php");
exit();

?>