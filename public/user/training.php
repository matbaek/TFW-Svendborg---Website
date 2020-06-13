<?php
require_once("../../private/initialize.php");
$page_title = "Træning";
include(SHARED_PATH . "/public_header.php");

require_login();
$pull_ups_and_knee_graps = [];
$corrective_strategy_array = [];

if(isset($_SESSION["username"])) {
    $pull_ups_and_knee_graps = get_pull_ups_and_knee_graps_by_id($_SESSION["user_id"]);
    $corrective_strategy_set = get_corrective_strategy_by_id($_SESSION["user_id"]);
}

if(is_post_request() && isset($_POST["pull_ups_and_knee_graps"])) {
    $pull_ups_and_knee_graps["pull_ups"] = $_POST["pull_ups"];
    $pull_ups_and_knee_graps["knee_graps"] = $_POST["knee_graps"];

    $result = update_pull_ups_and_knee_graps_by_id($pull_ups_and_knee_graps);
    if($result === true) {
        redirect_to("/user/training.php?p=a_ng");
    } 
} 
?>

<div id="content">
    <?php 
    include(SHARED_PATH . "/menu.php"); 
    include(SHARED_PATH . "/menu_training.php"); 
    
    if(is_get_request() && isset($_GET["p"]) && $_GET["p"] == "a_ng") {
    ?>
        <h2>Armstrækker og Knee Graps</h2>
        <form action="" method="POST">
            Armstrækker:<br />
            <input type="text" name="pull_ups" value="<?php echo h($pull_ups_and_knee_graps["pull_ups"]); ?>" /><br />
            Knee Graps:<br />
            <input type="text" name="knee_graps" value="<?php echo h($pull_ups_and_knee_graps["knee_graps"]); ?>" /><br />
            <input type="submit" name="pull_ups_and_knee_graps" value="Opdater" />
        </form>
    <?php
    } else if(is_get_request() && isset($_GET["p"]) && $_GET["p"] == "e") {
        echo "<h2>Evaluering | Korrektionsstrategi</h2>";
        if($corrective_strategy_set != null) {

            $count = 0;
            while($corrective_strategy = mysqli_fetch_assoc($corrective_strategy_set)) { 
                echo "<h3>" . $corrective_strategy["name"] . "</h3>";
                $images = corrective_strategy_images($corrective_strategy);
                for($i = 0; $i < count($images); $i++) {
                    echo "<img src=\"" . url_for("/img/" . $images[$i] . ".png") . "\" /> ";
                }
                echo "<hr /><br /><br />";
            }
        }
    } else {
        echo "<h2>Vælg en kategori.</h2>";
    }
    ?>

</div>

<?php include(SHARED_PATH . "/public_footer.php"); ?>
