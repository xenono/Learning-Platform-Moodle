<?php
// Absolute path to the project folder
include "./components/header.php";

// 301 Moved Permanently
header("Location: ./views/dashboard.php", true, 301);
exit();

include "./components/footer.php";
?>

