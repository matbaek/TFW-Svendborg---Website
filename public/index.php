<?php
require_once("../private/initialize.php");
$page_title = "Log in";
include(SHARED_PATH . "/public_header.php");

$errors = [];
$username = "";
$password = "";

if(is_post_request()) {

    $username = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";

    if(is_blank($username)) {
        $errors[] = "<b>Brugernavn</b> kan ikke være blankt.";
    }
    if(is_blank($password)) {
        $errors[] = "<b>Kodeord</b> kan ikke være blankt.";
    }

    if(empty($errors)) {
        $user = find_user_by_username($username);
        $login_failure_message = "Login was unsuccessful.";
        if($user) {
            if(password_verify($password, $user["password"])) {
                log_in($user);
            } else {
                $errors[] = $login_failure_message;
            }
        } else {
            $errors[] = $login_failure_message;
        }
    }
}

?>

<div id="content">
    <h1>Log in</h1>
    <?php echo display_errors($errors); ?>

    <form action="" method="post">
        Username:<br />
        <input type="text" name="username" value="<?php echo h($username); ?>" /><br />
        Password:<br />
        <input type="password" name="password" value="" /><br />
        <input type="submit" name="submit" value="Submit"  />
    </form>

</div>

<?php include(SHARED_PATH . "/public_footer.php"); ?>
