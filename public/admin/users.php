<?php
require_once('../../private/initialize.php');
$page_title = "Brugere";
include(SHARED_PATH . "/public_header.php");

require_admin();

if(is_post_request()) {
    $name = "aa";
    if(isset($_POST["button_one"])) { $name = "Body Squat | Heels Lifting"; }
    else if(isset($_POST["button_two"])) { $name = "Body Squat | Shallow Depth"; }
    else if(isset($_POST["button_three"])) { $name = "Body Squat | Folding Forward"; }
    else if(isset($_POST["button_four"])) { $name = "Body Squat | Collapsed Arch"; }
    else if(isset($_POST["button_five"])) { $name = "Body Squat | Feet External Rotation"; }
    else if(isset($_POST["button_six"])) { $name = "Body Squat | Knees Collapsing In"; }
    else if(isset($_POST["button_seven"])) { $name = "Lying Hamstring | Asymmetry"; }
    else if(isset($_POST["button_eight"])) { $name = "Shoulder IR/ER | IR – Lower hand"; }
    else if(isset($_POST["button_nine"])) { $name = "Shoulder IR/ER | ER – Overhand"; }
    else if(isset($_POST["button_ten"])) { $name = "Standing Soleus | Asymmetry"; }
    else if(isset($_POST["button_eleven"])) { $name = "Seated Gluteal | Asymmetry"; }

    edit_corrective_strategy_by_id($_POST["id"], $name);
}

$user_set = get_all_users();
$corrective_strategy_array = [];
?>

<div id="content">
    <?php include(SHARED_PATH . "/admin_menu.php"); ?>
    <br>
    <div id="page">
    <?php
    if(is_get_request() && !isset($_GET["id"])) {
        if($user_set != null) {
            while($user = mysqli_fetch_assoc($user_set)) { 
                echo "<a href=\"?id=" . $user["id"] . "\"><h3>" . $user["first_name"] . " " . $user["last_name"] . " - " . $user["username"] . "</h3></a>";
            }
            
            mysqli_free_result($user_set);
        }
    } else if((is_post_request() && isset($_GET["id"]) || is_get_request() && isset($_GET["id"]))) {
        $user = find_user_by_id($_GET["id"]);
        $corrective_strategy_array = get_all_corrective_strategy_in_an_array_by_id($_GET["id"]);
        ?>
        <a href="?"><- Tilbage</a>
        <table style="width:50%; border-spacing:0;">
            <tr>
                <td width="30%" colspan="2" style="background: #616161; color: #FFF;"><b>Bruger</b></td>
            </tr>
            <tr>
                <td width="30%" style="background: <?php echo get_color_two(0); ?>; color: #FFF;"><b>Brugernavn</b></td>
                <td height="25px" width="70%" style="background: <?php echo get_color(0); ?>"><?php echo $user["username"]; ?></td>
            </tr>
            <tr>
                <td style="background: <?php echo get_color_two(1); ?>; color: #FFF;"><b>Fornavn</b></td>
                <td height="25px" style="background: <?php echo get_color(1); ?>"><?php echo $user["first_name"]; ?></td>
            </tr>
            <tr>
                <td style="background: <?php echo get_color_two(0); ?>; color: #FFF;"><b>Efternavn</b></td>
                <td height="25px" style="background: <?php echo get_color(0); ?>"><?php echo $user["last_name"]; ?></td>
            </tr>
            <tr>
                <td style="background: <?php echo get_color_two(1); ?>; color: #FFF;"><b>Fødselsdag</b></td>
                <td height="25px" style="background: <?php echo get_color(1); ?>"><?php echo $user["birthday"]; ?></td>
            </tr>
            <tr>
                <td style="background: <?php echo get_color_two(0); ?>; color: #FFF;"><b>Adresse</b></td>
                <td height="25px" style="background: <?php echo get_color(0); ?>"><?php echo $user["address"]; ?></td>
            </tr>
            <tr>
                <td style="background: <?php echo get_color_two(1); ?>; color: #FFF;"><b>Post nummer</b></td>
                <td height="25px" style="background: <?php echo get_color(1); ?>"><?php echo $user["zip_code"]; ?></td>
            </tr>
            <tr>
                <td style="background: <?php echo get_color_two(0); ?>; color: #FFF;"><b>By</b></td>
                <td height="25px" style="background: <?php echo get_color(0); ?>"><?php echo $user["city"]; ?></td>
            </tr>
            <tr>
                <td style="background: <?php echo get_color_two(1); ?>; color: #FFF;"><b>Telefon nummber</b></td>
                <td height="25px" style="background: <?php echo get_color(1); ?>"><?php echo $user["phone_number"]; ?></td>
            </tr>
            <tr>
                <td style="background: <?php echo get_color_two(0); ?>; color: #FFF;"><b>Email</b></td>
                <td height="25px" style="background: <?php echo get_color(0); ?>"><?php echo $user["email"]; ?></td>
            </tr>
        </table>

        <form action="users.php?id=<?php echo $_GET["id"] ?>" method="POST">
            <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>" />
            <table style="width:50%; border-spacing:0;">
                <tr>
                    <td width="30%" rowspan="6" style="background: #616161; color: #FFF;vertical-align: middle;"><b>Body Squat</b></td>
                    <td width="55%" style="background: <?php echo get_color_two(1); ?>; color: #FFF;"><b>Heels Lifting</b></td>
                    <td width="5%" style="background: <?php echo get_color(1); ?>;font-size: 16px;text-align: center;"><?php echo get_symbol_for_corrective_strategy("Body Squat | Heels Lifting", $corrective_strategy_array) ?></td>
                    <td width="10%" style="background: <?php echo get_color(1); ?>; text-align: center;"><input type="submit" name="button_one" value="Ændre" /></td>
                </tr>
                <tr>
                    <td style="background: <?php echo get_color_two(0); ?>; color: #FFF;"><b>Shallow Depth</b></td>
                    <td style="background: <?php echo get_color(0); ?>;font-size: 16px;text-align: center;"><?php echo get_symbol_for_corrective_strategy("Body Squat | Shallow Depth", $corrective_strategy_array) ?></td>
                    <td style="background: <?php echo get_color(0); ?>; text-align: center;"><input type="submit" name="button_two" value="Ændre" /></td>
                </tr>
                <tr>
                    <td style="background: <?php echo get_color_two(1); ?>; color: #FFF;"><b>Folding Forward</b></td>
                    <td style="background: <?php echo get_color(1); ?>;font-size: 16px;text-align: center;"><?php echo get_symbol_for_corrective_strategy("Body Squat | Folding Forward", $corrective_strategy_array) ?></td>
                    <td style="background: <?php echo get_color(1); ?>; text-align: center;"><input type="submit" name="button_three" value="Ændre" /></td>
                </tr>
                <tr>
                    <td style="background: <?php echo get_color_two(0); ?>; color: #FFF;"><b>Collapsed Arch</b></td>
                    <td style="background: <?php echo get_color(0); ?>;font-size: 16px;text-align: center;"><?php echo get_symbol_for_corrective_strategy("Body Squat | Collapsed Arch", $corrective_strategy_array) ?></td>
                    <td style="background: <?php echo get_color(0); ?>; text-align: center;"><input type="submit" name="button_four" value="Ændre" /></td>
                </tr>
                <tr>
                    <td style="background: <?php echo get_color_two(1); ?>; color: #FFF;"><b>Feet External Rotation</b></td>
                    <td style="background: <?php echo get_color(1); ?>;font-size: 16px;text-align: center;"><?php echo get_symbol_for_corrective_strategy("Body Squat | Feet External Rotation", $corrective_strategy_array) ?></td>
                    <td style="background: <?php echo get_color(1); ?>; text-align: center;"><input type="submit" name="button_five" value="Ændre" /></td>
                </tr>
                <tr>
                    <td style="background: <?php echo get_color_two(0); ?>; color: #FFF;"><b>Knees Collapsing In</b></td>
                    <td style="background: <?php echo get_color(0); ?>;font-size: 16px;text-align: center;"><?php echo get_symbol_for_corrective_strategy("Body Squat | Knees Collapsing In", $corrective_strategy_array) ?></td>
                    <td style="background: <?php echo get_color(0); ?>; text-align: center;"><input type="submit" name="button_six" value="Ændre" /></td>
                </tr>
                <tr>
                    <td width="30%" style="background: #707070; color: #FFF;vertical-align: middle;"><b>Lying Hamstring</b></td>
                    <td width="55%" style="background: <?php echo get_color_two(1); ?>; color: #FFF;"><b>Asymmetry</b></td>
                    <td width="5%" style="background: <?php echo get_color(1); ?>;font-size: 16px;text-align: center;"><?php echo get_symbol_for_corrective_strategy("Lying Hamstring | Asymmetry", $corrective_strategy_array) ?></td>
                    <td width="10%" style="background: <?php echo get_color(1); ?>; text-align: center;"><input type="submit" name="button_seven" value="Ændre" /></td>
                </tr>
                <tr>
                    <td width="30%" rowspan="2" style="background: #616161; color: #FFF;vertical-align: middle;"><b>Shoulder IR/ER</b></td>
                    <td width="55%" style="background: <?php echo get_color_two(0); ?>; color: #FFF;"><b>IR – Lower hand</b></td>
                    <td width="5%" style="background: <?php echo get_color(0); ?>;font-size: 16px;text-align: center;"><?php echo get_symbol_for_corrective_strategy("Shoulder IR/ER | IR – Lower hand", $corrective_strategy_array) ?></td>
                    <td width="10%" style="background: <?php echo get_color(0); ?>; text-align: center;"><input type="submit" name="button_eight" value="Ændre" /></td>
                </tr>
                <tr>
                    <td style="background: <?php echo get_color_two(1); ?>; color: #FFF;"><b>ER – Overhand</b></td>
                    <td style="background: <?php echo get_color(1); ?>;font-size: 16px;text-align: center;"><?php echo get_symbol_for_corrective_strategy("Shoulder IR/ER | ER – Overhand", $corrective_strategy_array) ?></td>
                    <td style="background: <?php echo get_color(1); ?>; text-align: center;"><input type="submit" name="button_nine" value="Ændre" /></td>
                </tr>
                <tr>
                    <td width="30%" style="background: #707070; color: #FFF;vertical-align: middle;"><b>Standing Soleus</b></td>
                    <td width="55%" style="background: <?php echo get_color_two(0); ?>; color: #FFF;"><b>Asymmetry</b></td>
                    <td width="5%" style="background: <?php echo get_color(0); ?>;font-size: 16px;text-align: center;"><?php echo get_symbol_for_corrective_strategy("Standing Soleus | Asymmetry", $corrective_strategy_array) ?></td>
                    <td width="10%" style="background: <?php echo get_color(0); ?>; text-align: center;"><input type="submit" name="button_ten" value="Ændre" /></td>
                </tr>
                <tr>
                    <td width="30%" style="background: #616161; color: #FFF;vertical-align: middle;"><b>Seated Gluteal</b></td>
                    <td width="55%" style="background: <?php echo get_color_two(1); ?>; color: #FFF;"><b>Asymmetry</b></td>
                    <td width="5%" style="background: <?php echo get_color(1); ?>;font-size: 16px;text-align: center;"><?php echo get_symbol_for_corrective_strategy("Seated Gluteal | Asymmetry", $corrective_strategy_array) ?></td>
                    <td width="10%" style="background: <?php echo get_color(1); ?>; text-align: center;"><input type="submit" name="button_eleven" value="Ændre" /></td>
                </tr>
            </table>
        </form>
        <?php

        $food_diaries_set = get_food_diaries_by_user_id($_GET["id"]);
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
                echo "<td width=\"10%\" style=\"height: 10px; color: #FFF;\"></td>";
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
    }
    ?>
    </div>
</div>

<?php include(SHARED_PATH . "/public_footer.php"); ?>