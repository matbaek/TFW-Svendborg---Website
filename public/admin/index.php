<?php
require_once('../../private/initialize.php');
$page_title = "Admin";
include(SHARED_PATH . "/public_header.php");

require_admin();

?>

<div id="content">
    <?php include(SHARED_PATH . "/admin_menu.php"); ?>
    <br>
    <div id="page">
        
    </div>
</div>

<?php include(SHARED_PATH . "/public_footer.php"); ?>