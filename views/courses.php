<?php
include ("../includes/header.php");
$currentCourse = null;
$currentWeek = "1";
if(isset($_GET["course"]) && isset($_GET["week"])){
    $currentCourse = $_GET["course"];
    $currentWeek = $_GET["week"];
}
?>
<div class="wrapper">
    <?php if(!$currentCourse){?>
        <h1> Database error!!!</h1>
    <?php
        return;
    }?>
    <div class="grid-courses-view">
        <div class="week-dropdown">
            <h1>All weeks</h1>
            <ul class="week-dropdown-list">
                <?php for($i = 1; $i < 28; $i+=1){?>
                    <li class="week-dropdown-list-item">
                        <a
                            class="<?php
                            if($currentWeek == $i){
                                echo "current";
                            } else {
                                echo "";
                            }
                            ?>"
                            href=<?php echo "courses.php?course=" . $currentCourse . "&week=" .$i?>>
                            <?php echo "Week " . $i ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="course-content">
            <h1><?php echo $currentCourse . " Week" . " " . $currentWeek?></h1>
        </div>
    </div>
</div>
<?php
include ("../includes/footer.php");
?>

