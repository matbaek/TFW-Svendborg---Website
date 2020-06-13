<?php
require_once('../../private/initialize.php');
$page_title = "Madplan";
include(SHARED_PATH . "/public_header.php");

require_login();
$food_diary = [];

if(is_get_request() && isset($_GET["id"])) {
    $food_diary = find_food_diary_by_id($_GET["id"]);
}

if(is_post_request()) {
    $food_diary["id"] = $_POST["id"];
    $food_diary["user_id"] = $_POST["user_id"];
    $food_diary["date"] = $_POST["date"];
    $food_diary["breakfast"] = $_POST["breakfast"];
    $food_diary["breakfast_time"] = $_POST["breakfast_time"];
    $food_diary["snack_1"] = $_POST["snack_1"];
    $food_diary["lunch"] = $_POST["lunch"];
    $food_diary["lunch_time"] = $_POST["lunch_time"];
    $food_diary["snack_2"] = $_POST["snack_2"];
    $food_diary["dinner"] = $_POST["dinner"];
    $food_diary["dinner_time"] = $_POST["dinner_time"];
    $food_diary["snack_3"] = $_POST["snack_3"];
    $food_diary["sleep"] = $_POST["sleep"];
    $food_diary["water"] = $_POST["water"];
    $food_diary["fruit_veggie"] = $_POST["fruit_veggie"];
    $food_diary["alcohol"] = $_POST["alcohol"];

    $result = update_food_diary_by_id($food_diary);
    if($result === true) {
        redirect_to("/user/food_diary.php");
    } 
} 
?>

<div id="content">
    <?php include(SHARED_PATH . "/menu.php"); ?>
    <br>
    <div id="page">
        <form action="" method="POST">
            <input type="hidden" id="id" name="id" value="<?php echo $food_diary["id"]; ?>" />
            <input type="hidden" id="user_id" name="user_id" value="<?php echo $food_diary["user_id"]; ?>" />
            <table style="width:50%; border-spacing:0;">
                <tr>
                    <td width="30%" style="background: <?php echo get_color_two(0); ?>; color: #FFF;"><b>Dato</b></td>
                    <td height="25px" style="background: <?php echo get_color(1); ?>;"><input type="date" id="date" name="date" value="<?php echo $food_diary["date"]; ?>" /></td>
                </tr>
                <tr>
                    <td style="background: <?php echo get_color_two(1); ?>; color: #FFF;"><b>Morgenmad</b></td>
                    <td height="25px" style="background: <?php echo get_color(1); ?>;"><input type="text" id="breakfast" name="breakfast" value="<?php echo $food_diary["breakfast"]; ?>" /></td>
                </tr>
                <tr>
                    <td style="background: <?php echo get_color_two(0); ?>; color: #FFF;"><b>Morgenmad tidspunkt</b></td>
                    <td height="25px"  style="background: <?php echo get_color(0); ?>;"><input type="time" id="breakfast_time" name="breakfast_time" value="<?php echo $food_diary["breakfast_time"]; ?>" /></td>
                </tr>
                <tr>
                    <td style="background: <?php echo get_color_two(1); ?>; color: #FFF;"><b>Første snack</b></td>
                    <td height="25px"  style="background: <?php echo get_color(1); ?>;"><input type="text" id="snack_1" name="snack_1" value="<?php echo $food_diary["snack_1"]; ?>" /></td>
                </tr>
                <tr>
                    <td style="background: <?php echo get_color_two(0); ?>; color: #FFF;"><b>Middagsmad</b></td>
                    <td height="25px"  style="background: <?php echo get_color(0); ?>;"><input type="text" id="lunch" name="lunch" value="<?php echo $food_diary["lunch"]; ?>" /></td>
                </tr>
                <tr>
                    <td style="background: <?php echo get_color_two(1); ?>; color: #FFF;"><b>Middagsmad tidspunkt</b></td>
                    <td height="25px"  style="background: <?php echo get_color(1); ?>;"><input type="time" id="lunch_time" name="lunch_time" value="<?php echo $food_diary["lunch_time"]; ?>" /></td>
                </tr>
                <tr>
                    <td style="background: <?php echo get_color_two(0); ?>; color: #FFF;"><b>Anden snack</b></td>
                    <td height="25px"  style="background: <?php echo get_color(0); ?>;"><input type="text" id="snack_2" name="snack_2" value="<?php echo $food_diary["snack_2"]; ?>" /></td>
                </tr>
                <tr>
                    <td style="background: <?php echo get_color_two(1); ?>; color: #FFF;"><b>Aftensmad</b></td>
                    <td height="25px"  style="background: <?php echo get_color(1); ?>;"><input type="text" id="dinner" name="dinner" value="<?php echo $food_diary["dinner"]; ?>" /></td>
                </tr>
                <tr>
                    <td style="background: <?php echo get_color_two(0); ?>; color: #FFF;"><b>Aftensmad tidspunkt</b></td>
                    <td height="25px"  style="background: <?php echo get_color(0); ?>;"><input type="time" id="dinner_time" name="dinner_time" value="<?php echo $food_diary["dinner_time"]; ?>" /></td>
                </tr>
                <tr>
                    <td style="background: <?php echo get_color_two(1); ?>; color: #FFF;"><b>Tredje snack</b></td>
                    <td height="25px"  style="background: <?php echo get_color(1); ?>;"><input type="text" id="snack_3" name="snack_3" value="<?php echo $food_diary["snack_3"]; ?>" /></td>
                </tr>
                <tr>
                    <td style="background: <?php echo get_color_two(0); ?>; color: #FFF;"><b>Søvn</b></td>
                    <td height="25px"  style="background: <?php echo get_color(0); ?>;"><input type="number" id="sleep" name="sleep" value="<?php echo $food_diary["sleep"]; ?>" /></td>
                </tr>
                <tr>
                    <td style="background: <?php echo get_color_two(1); ?>; color: #FFF;"><b>Vand</b></td>
                    <td height="25px"  style="background: <?php echo get_color(1); ?>;"><input type="number" id="water" name="water" value="<?php echo $food_diary["water"]; ?>" /></td>
                </tr>
                <tr>
                    <td style="background: <?php echo get_color_two(0); ?>; color: #FFF;"><b>Frugt og grønt</b></td>
                    <td height="25px"  style="background: <?php echo get_color(0); ?>;"><input type="number" id="fruit_veggie" name="fruit_veggie" value="<?php echo $food_diary["fruit_veggie"]; ?>" /></td>
                </tr>
                <tr>
                    <td style="background: <?php echo get_color_two(1); ?>; color: #FFF;"><b>Alcohol</b></td>
                    <td height="25px"  style="background: <?php echo get_color(1); ?>;"><input type="number" id="alcohol" name="alcohol" value="<?php echo $food_diary["alcohol"]; ?>" /></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Ændre" /></td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include(SHARED_PATH . "/public_footer.php"); ?>