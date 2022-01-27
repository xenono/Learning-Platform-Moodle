<?php
include "../components/header.php";
include "../session/auth.php"
?>
<h1>Dashboard</h1>
<h2>Welcome, <?php echo $_SESSION["name"]?>!!!</h2>
<?php
include "../components/footer.php";
?>

