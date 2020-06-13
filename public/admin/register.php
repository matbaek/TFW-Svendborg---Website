<?php
require_once('../../private/initialize.php');
$page_title = "Brugere";
include(SHARED_PATH . "/public_header.php");

require_admin();

$errors = [];
$user = [];
$user["first_name"] = "";
$user["last_name"] = "";
$user["birthday"] = "";
$user["address"] = "";
$user["zip_code"] = "";
$user["city"] = "";
$user["phone_number"] = "";
$user["email"] = "";

if(is_post_request()) {

    $user["first_name"] = $_POST["first_name"] ?? "";
    $user["last_name"] = $_POST["last_name"] ?? "";
    $user["birthday"] = $_POST["birthday"] ?? "";
    $user["address"] = $_POST["address"] ?? "";
    $user["zip_code"] = $_POST["zip_code"] ?? "";
    $user["city"] = $_POST["city"] ?? "";
    $user["phone_number"] = $_POST["phone_number"] ?? "";
    $user["email"] = $_POST["email"] ?? "";

    if(is_blank($user["first_name"])) {
        $errors[] = "Fornavn må ikke være blank.";
    }
    if(is_blank($user["last_name"])) {
        $errors[] = "Efternavn må ikke være blank.";
    }
    if(is_blank($user["birthday"])) {
        $errors[] = "Fødselsdag må ikke være blank.";
    }
    if(is_blank($user["address"])) {
        $errors[] = "Adresse må ikke være blank.";
    }
    if(is_blank($user["zip_code"])) {
        $errors[] = "Post nummer må ikke være blank.";
    }
    if(is_blank($user["city"])) {
        $errors[] = "By må ikke være blank.";
    }
    if(is_blank($user["phone_number"])) {
        $errors[] = "Telefon nummer må ikke være blank.";
    }
    if(is_blank($user["email"])) {
        $errors[] = "Email må ikke være blank.";
    }

    if(empty($errors)) {
        $result = register_user($user);
        if($result === true) {
            redirect_to("/index.php");
        } 
    }
}

?>

<?php include(SHARED_PATH . "/public_header.php"); ?>

<div id="content">
    <?php include(SHARED_PATH . "/admin_menu.php"); ?>
    <h1>Register</h1>

    <?php echo display_errors($errors); ?>

    <form action="register.php" method="post">
        Fornavn:<br />
        <input type="text" name="first_name" value="<?php echo h($user["first_name"]); ?>" /><br />
        Efternavn:<br />
        <input type="text" name="last_name" value="<?php echo h($user["last_name"]); ?>" /><br />
        Fødselsdag:<br />
        <input type="date" name="birthday" value="<?php echo h($user["birthday"]); ?>" /><br />
        Adresse:<br />
        <input type="text" name="address" value="<?php echo h($user["address"]); ?>" /><br />
        Postnummer & By:<br />
        <input type="number" name="zip_code" value="<?php echo h($user["zip_code"]); ?>" /> <input type="text" name="city" value="<?php echo h($user["city"]); ?>" /><br />
        Telefon nummer:<br />
        <input type="number" name="phone_number" value="<?php echo h($user["phone_number"]); ?>" /><br />
        Email:<br />
        <input type="text" name="email" value="<?php echo h($user["email"]); ?>" /><br />
        <input type="submit" name="submit" value="Submit"  />
    </form>

</div>

<?php include(SHARED_PATH . "/public_footer.php"); ?>
