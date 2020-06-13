<?php

define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "tfw");

function db_connect() {
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    confirm_db_connect();
    mysqli_set_charset($connection, "utf8");
    return $connection;
}

function db_disconnect($connection) {
    if(isset($connection)) {
        mysqli_close($connection);
    }
}

function db_escape($connection, $string) {
    return mysqli_real_escape_string($connection, $string);
}

function confirm_db_connect() {
    if(mysqli_connect_errno()) {
        $msg = "Database connection failed: ". mysqli_connect_error() ." (". mysqli_connect_errno. ")";
        exit($msg);
    }
}

function confirm_result_set($result_set) {
    if(!$result_set) {
        exit("Database query failed.");
    }
}

?>