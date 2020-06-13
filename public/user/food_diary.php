<?php
require_once('../../private/initialize.php');
$page_title = "Madplan";
include(SHARED_PATH . "/public_header.php");

require_login();
$food_diaries_set = [];
$new_food_diary = [];

if(isset($_SESSION["username"])) {
    $food_diaries_set = get_food_diaries_by_user_id($_SESSION["user_id"]);
}
?>

<div id="content">
    <?php include(SHARED_PATH . "/menu.php"); ?>
    <br>
    <div id="page">
    <?php
        if($food_diaries_set != null) {
            $count = 0;
            while($food_diary = mysqli_fetch_assoc($food_diaries_set)) { 
                echo "<table style=\"width:100%; border-spacing:0;\">";
                echo "<tr>";
                $date = strtotime($food_diary["date"]);
                echo "<td colspan=\"3\"><h3>" . date('l. j F - Y', $date) . "</h3></td>";
                echo "</tr>";
                echo "<tr style=\"background: ". get_color_two($count) .";\">";
                echo "<td width=\"40%\" style=\"height: 10px; color: #FFF;\">Morgenmad</td>";
                echo "<td width=\"10%\" style=\"height: 10px; color: #FFF; border-right: 4px solid #adadad;\">Tidspunkt</td>";
                echo "<td width=\"40%\" style=\"height: 10px; color: #FFF; border-right: 4px solid #adadad;\">Første Snack</td>";
                echo "<td width=\"10%\" style=\"height: 10px; color: #FFF;\"><a href=\"" . url_for("/user/edit_food_diary.php?id=" . $food_diary["id"]) . "\">Ændre</a></td>";
                echo "</tr>";
                echo "<tr style=\"background: ". get_color($count) .";\">";
                echo "<td>" . $food_diary["breakfast"] . "</td>";
                echo "<td style=\"border-right: 4px solid #adadad;\">" . $food_diary["breakfast_time"] . "</td>";
                echo "<td style=\"border-right: 4px solid #adadad;\">" . $food_diary["snack_1"] . "</td>";
                echo "<td style=\"border-bottom: 4px solid #adadad;\"><b>Søvn</b>: " . $food_diary["sleep"] . "</td>";
                echo "</tr>";
                
                echo "<tr style=\"background: ". get_color_two($count) .";\">";
                echo "<td style=\"height: 10px; color: #FFF;\">Forkost</td>";
                echo "<td style=\"height: 10px; color: #FFF; border-right: 4px solid #adadad;\">Tidspunkt</td>";
                echo "<td style=\"height: 10px; color: #FFF; border-right: 4px solid #adadad;\">Anden Snack</td>";
                echo "<td style=\"background: ". get_color($count) ."; border-bottom: 4px solid #adadad;\"><b>Vand</b>: " . $food_diary["water"] . "</td>";
                echo "</tr>";
                echo "<tr style=\"background: ". get_color($count) .";\">";
                echo "<td>" . $food_diary["lunch"] . "</td>";
                echo "<td style=\"border-right: 4px solid #adadad;\">" . $food_diary["lunch_time"] . "</td>";
                echo "<td style=\"border-right: 4px solid #adadad;\">" . $food_diary["snack_2"] . "</td>";
                echo "<td style=\"border-bottom: 4px solid #adadad;\"><b>Frugt og grønt</b>: " . $food_diary["fruit_veggie"] . "</td>";
                echo "</tr>";
                
                echo "<tr style=\"background: ". get_color_two($count) .";\">";
                echo "<td style=\"height: 10px; color: #FFF;\">Aftensmad</td>";
                echo "<td style=\"height: 10px; color: #FFF; border-right: 4px solid #adadad;\">Tidspunkt</td>";
                echo "<td style=\"height: 10px; color: #FFF; border-right: 4px solid #adadad;\">Tredje Snack</td>";
                echo "<td style=\"background: ". get_color($count) ."; border-bottom: 4px solid #adadad;\"><b>Alcohol</b>: " . $food_diary["alcohol"] . "</td>";
                echo "</tr>";
                echo "<tr style=\"background: ". get_color($count) .";\">";
                echo "<td>" . $food_diary["dinner"] . "</td>";
                echo "<td style=\"border-right: 4px solid #adadad;\">" . $food_diary["dinner_time"] . "</td>";
                echo "<td style=\"border-right: 4px solid #adadad;\">" . $food_diary["snack_3"] . "</td>";
                echo "<td></td>";
                echo "</tr>";
                echo "</table>";
                
                $count++;
            }
            
            mysqli_free_result($food_diaries_set);
        }
        echo "<a href=\"" . url_for("/user/new_food_diary.php") . "\">Tilføj madplan</a><br /><br />";
    ?>
    </div>
</div>

<?php include(SHARED_PATH . "/public_footer.php"); ?>