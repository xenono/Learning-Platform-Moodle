<?php
include "../components/header.php";
?>
<div class="wrapper">
    <div class="grid-courses-view">
        <div class="week-dropdown">
            <h1>All weeks</h1>
            <ul class="week-dropdown-list">
                <?php for($i = 1; $i < 28; $i+=1){?>
                    <li class="week-dropdown-list-item"><?php echo "Week " . $i ?></li>
                <?php } ?>
            </ul>
        </div>
        <div class="course-content">

        </div>
    </div>
</div>
<?php
include "../components/footer.php";
?>

