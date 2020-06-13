<?php
session_start();

setlocale(LC_TIME, "");
setlocale(LC_TIME, 'da_DA');

// Her findes stien til den mappe som filen ligger i
define("PRIVATE_PATH", dirname(__FILE__));
define("PROJECT_PATH", dirname(PRIVATE_PATH));
// Her findes stien til den offentlige mappe, som brugeren har adgang til
define("PUBLIC_PATH", PROJECT_PATH . '/public');
// Her findes stien til den delte mappe, hvor delte ting ligger, fx header/footer
define("SHARED_PATH", PRIVATE_PATH . '/shared');

$public_end = strpos($_SERVER["SCRIPT_NAME"], "/public") + 7;
$doc_root = substr($_SERVER["SCRIPT_NAME"], 0, $public_end);
define("WWW_ROOT", $doc_root);

require_once("query_functions.php");
require_once("functions.php");
require_once("database.php");

$db = db_connect();
$errors = [];

?>