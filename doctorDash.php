

<?php
session_start();

session_destroy();

header("Location: doctorLogin.html");
exit;
?>
