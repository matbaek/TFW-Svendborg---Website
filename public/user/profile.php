<?php
require_once('../../private/initialize.php');
$page_title = "Profil";
include(SHARED_PATH . "/public_header.php");

require_login();
$user = [];

if(isset($_SESSION["username"])) {
    $user = find_user_by_username($_SESSION["username"]);
}
?>

<div id="content">
    <?php include(SHARED_PATH . "/menu.php"); ?>
    <br>
    <div id="page">
        <table style="width:50%; border-spacing:0;">
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
        <a href="<?php echo url_for("/user/edit_user.php"); ?>">Ændre informationer</a><br /><br />
    </div>
</div>

<?php include(SHARED_PATH . "/public_footer.php"); ?>