<?php
require_once('../../private/initialize.php');
$page_title = "Profil";
include(SHARED_PATH . "/public_header.php");

require_login();
$user = [];

if(isset($_SESSION["username"])) {
    $user = find_user_by_username($_SESSION["username"]);
}

if(is_post_request()) {
    $user["first_name"] = $_POST["first_name"] ?? "";
    $user["last_name"] = $_POST["last_name"] ?? "";
    $user["birthday"] = $_POST["birthday"] ?? "";
    $user["address"] = $_POST["address"] ?? "";
    $user["zip_code"] = $_POST["zip_code"] ?? "";
    $user["city"] = $_POST["city"] ?? 0;
    $user["phone_number"] = $_POST["phone_number"] ?? 0;
    $user["email"] = $_POST["email"] ?? "";

    $result = update_user_by_user_id($user);
    if($result === true) {
        redirect_to("/user/profile.php");
    }
}
?>

<div id="content">
    <?php include(SHARED_PATH . "/menu.php"); ?>
    <br>
    <div id="page">
        <form action="" method="POST">
        <table style="width:50%; border-spacing:0;">
        <tr>
        <td width="30%" style="background: <?php echo get_color_two(0); ?>; color: #FFF;"><b>Brugernavn</b></td>
        <td height="25px"  width="70%" style="background: <?php echo get_color(0); ?>;"><?php echo $user["username"]; ?></td>
        </tr>
        <tr>
        <td style="background: <?php echo get_color_two(1); ?>; color: #FFF;"><b>Fornavn</b></td>
        <td height="25px" style="background: <?php echo get_color(1); ?>;"><input type="text" id="first_name" name="first_name" value="<?php echo $user["first_name"]; ?>" /></td>
        </tr>
        <tr>
        <td style="background: <?php echo get_color_two(0); ?>; color: #FFF;"><b>Efternavn</b></td>
        <td height="25px" style="background: <?php echo get_color(0); ?>;"><input type="text" id="last_name" name="last_name" value="<?php echo $user["last_name"]; ?>" /></td>
        </tr>
        <tr>
        <td style="background: <?php echo get_color_two(1); ?>; color: #FFF;"><b>Fødselsdag</b></td>
        <td height="25px" style="background: <?php echo get_color(1); ?>;"><input type="date" id="birthday" name="birthday" value="<?php echo $user["birthday"]; ?>" /></td>
        </tr>
        <tr>
        <td style="background: <?php echo get_color_two(0); ?>; color: #FFF;"><b>Adresse</b></td>
        <td height="25px" style="background: <?php echo get_color(0); ?>"><input type="text" id="address" name="address" value="<?php echo $user["address"]; ?>" /></td>
        </tr>
        <tr>
        <td style="background: <?php echo get_color_two(1); ?>; color: #FFF;"><b>Post nummer</b></td>
        <td height="25px" style="background: <?php echo get_color(1); ?>;"><input type="text" id="zip_code" name="zip_code" value="<?php echo $user["zip_code"]; ?>" /></td>
        </tr>
        <tr>
        <td style="background: <?php echo get_color_two(0); ?>; color: #FFF;"><b>By</b></td>
        <td height="25px"  tyle="background: <?php echo get_color(0); ?>;"><input type="text" id="city" name="city" value="<?php echo $user["city"]; ?>" /></td>
        </tr>
        <tr>
        <td style="background: <?php echo get_color_two(1); ?>; color: #FFF;"><b>Telefon nummber</b></td>
        <td height="25px" style="background: <?php echo get_color(1); ?>;"><input type="text" id="phone_number" name="phone_number" value="<?php echo $user["phone_number"]; ?>" /></td>
        </tr>
        <tr>
        <td style="background: <?php echo get_color_two(0); ?>; color: #FFF;"><b>Email</b></td>
        <td height="25px" style="background: <?php echo get_color(0); ?>;"><input type="text" id="email" name="email" value="<?php echo $user["email"]; ?>" /></td>
        </tr>
        <tr>
        <td colspan="2"><input type="submit" value="Ændre" /></td>
        </tr>
        </table>
        </form>
    </div>
</div>

<?php include(SHARED_PATH . "/public_footer.php"); ?>