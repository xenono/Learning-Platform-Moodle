<?php
include "../components/header.php";
include "../session/auth.php"
?>
<h1>Dashboard</h1>
<h2>Welcome,
    <?php
    if(isset($_SESSION["name"])){
        echo $_SESSION["name"];
    } else {
        echo "Joe";
    }
    ?>!!!
</h2>
<?php
include "../components/footer.php";
?>

