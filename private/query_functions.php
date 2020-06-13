<?php

// LOGIN
function log_in($user) {
    session_regenerate_id();
    $_SESSION["user_id"] = $user["id"];
    $_SESSION["admin"] = $user["admin"];
    $_SESSION["username"] = $user["username"];

    if($user["admin"] == 1) {
        redirect_to("/admin/index.php");
    }
    redirect_to("/user/index.php");
}

function log_out_user() {
    unset($_SESSION["user_id"]);
    unset($_SESSION["admin"]);
    unset($_SESSION["username"]);
}

function is_logged_in() {
    return isset($_SESSION["user_id"]);
}

function is_admin() {
    return isset($_SESSION["admin"]);
}

function require_login() {
    if(!is_logged_in()) {
        redirect_to("/index.php");
    }
}

function require_admin() {
    require_login();
    if($_SESSION["admin"] != 1) {
        redirect_to("/index.php");
    } 
}

// OTHER FUNCTION
function find_user_by_id($id) {
    global $db;

    $sql = "SELECT * FROM users ";
    $sql .= "WHERE id = '". db_escape($db, $id) ."'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    $user = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $user;
}

function find_user_by_username($username) {
    global $db;

    $sql = "SELECT * FROM users ";
    $sql .= "WHERE username = '". db_escape($db, $username) ."'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    $user = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $user;
}

function get_all_users() {
    global $db;

    $sql = "SELECT * FROM users";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    if(mysqli_num_rows($result) == 0) {
        return null;
    }
    return $result;
}

function update_user_by_user_id($user) {
    global $db;

    $sql = "UPDATE users SET ";
    $sql .= "first_name = '". db_escape($db, $user["first_name"]) ."', ";
    $sql .= "last_name = '". db_escape($db, $user["last_name"]) ."', ";
    $sql .= "birthday = '". db_escape($db, $user["birthday"]) ."', ";
    $sql .= "address = '". db_escape($db, $user["address"]) ."', ";
    $sql .= "zip_code = '". db_escape($db, $user["zip_code"]) ."', ";
    $sql .= "city = '". db_escape($db, $user["city"]) ."', ";
    $sql .= "phone_number = '". db_escape($db, $user["phone_number"]) ."', ";
    $sql .= "email = '". db_escape($db, $user["email"]) ."' ";
    $sql .= "WHERE id = '". db_escape($db, $user["id"]) ."'";

    $result = mysqli_query($db, $sql);

    if($result) {
        return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
}

function register_user($user) {
    global $db;

    $sql = "INSERT INTO users (";
    $sql .= "username, password, first_name, last_name, birthday, address, zip_code, city, phone_number, email";
    $sql .= ") VALUES (";
    $sql .= "'". db_escape($db, $user["username"]) ."', ";
    $sql .= "'". db_escape($db, password_hash("1234", PASSWORD_DEFAULT)) ."', ";
    $sql .= "'". db_escape($db, $user["first_name"]) ."', ";
    $sql .= "'". db_escape($db, $user["last_name"]) ."', ";
    $sql .= "'". db_escape($db, $user["birthday"]) ."', ";
    $sql .= "'". db_escape($db, $user["address"]) ."', ";
    $sql .= "'". db_escape($db, $user["zip_code"]) ."', ";
    $sql .= "'". db_escape($db, $user["city"]) ."', ";
    $sql .= "'". db_escape($db, $user["phone_number"]) ."', ";
    $sql .= "'". db_escape($db, $user["email"]) ."'";
    $sql .= ")";

    $result = mysqli_query($db, $sql);

    if($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
      exit;
    }
}

function find_food_diary_by_id($id) {
    global $db;

    $sql = "SELECT * FROM food_diary ";
    $sql .= "WHERE id = '". db_escape($db, $id) ."'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    $food_diary = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $food_diary;
}

function get_food_diaries_by_user_id($user_id) {
    global $db;

    $sql = "SELECT * FROM food_diary ";
    $sql .= "WHERE user_id = '". db_escape($db, $user_id) ."'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    if(mysqli_num_rows($result) == 0) {
        return null;
    }
    return $result;
}

function insert_food_diary($food_diary) {
    global $db;

    $sql = "INSERT INTO food_diary (";
    $sql .= "user_id, date, breakfast, breakfast_time, snack_1, lunch, lunch_time, snack_2, ";
    $sql .= "dinner, dinner_time, snack_3, sleep, water, fruit_veggie, alcohol";
    $sql .= ") VALUES (";
    $sql .= "'". db_escape($db, $_SESSION["user_id"]) ."', ";
    $sql .= "'". db_escape($db, $food_diary["date"]) ."', ";
    $sql .= "'". db_escape($db, $food_diary["breakfast"]) ."', ";
    $sql .= "'". db_escape($db, $food_diary["breakfast_time"]) ."', ";
    $sql .= "'". db_escape($db, $food_diary["snack_1"]) ."', ";
    $sql .= "'". db_escape($db, $food_diary["lunch"]) ."', ";
    $sql .= "'". db_escape($db, $food_diary["lunch_time"]) ."', ";
    $sql .= "'". db_escape($db, $food_diary["snack_2"]) ."', ";
    $sql .= "'". db_escape($db, $food_diary["dinner"]) ."', ";
    $sql .= "'". db_escape($db, $food_diary["dinner_time"]) ."', ";
    $sql .= "'". db_escape($db, $food_diary["snack_3"]) ."', ";
    $sql .= "'". db_escape($db, $food_diary["sleep"]) ."', ";
    $sql .= "'". db_escape($db, $food_diary["water"]) ."', ";
    $sql .= "'". db_escape($db, $food_diary["fruit_veggie"]) ."', ";
    $sql .= "'". db_escape($db, $food_diary["alcohol"]) ."' ";
    $sql .= ")";

    $result = mysqli_query($db, $sql);

    if($result) {
        return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
}

function update_food_diary_by_id($food_diary) {
    global $db;

    $sql = "UPDATE food_diary SET ";
    $sql .= "user_id = '". db_escape($db, $food_diary["user_id"]) ."', ";
    $sql .= "date = '". db_escape($db, $food_diary["date"]) ."', ";
    $sql .= "breakfast = '". db_escape($db, $food_diary["breakfast"]) ."', ";
    $sql .= "breakfast_time = '". db_escape($db, $food_diary["breakfast_time"]) ."', ";
    $sql .= "snack_1 = '". db_escape($db, $food_diary["snack_1"]) ."', ";
    $sql .= "lunch = '". db_escape($db, $food_diary["lunch"]) ."', ";
    $sql .= "lunch_time = '". db_escape($db, $food_diary["lunch_time"]) ."', ";
    $sql .= "snack_2 = '". db_escape($db, $food_diary["snack_2"]) ."', ";
    $sql .= "dinner = '". db_escape($db, $food_diary["dinner"]) ."', ";
    $sql .= "dinner_time = '". db_escape($db, $food_diary["dinner_time"]) ."', ";
    $sql .= "snack_3 = '". db_escape($db, $food_diary["snack_3"]) ."', ";
    $sql .= "sleep = '". db_escape($db, $food_diary["sleep"]) ."', ";
    $sql .= "water = '". db_escape($db, $food_diary["water"]) ."', ";
    $sql .= "fruit_veggie = '". db_escape($db, $food_diary["fruit_veggie"]) ."', ";
    $sql .= "alcohol = '". db_escape($db, $food_diary["alcohol"]) ."' ";
    $sql .= "WHERE id = '". db_escape($db, $food_diary["id"]) ."'";

    $result = mysqli_query($db, $sql);

    if($result) {
        return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
}

function get_pull_ups_and_knee_graps_by_id($user_id) {
    global $db;

    $sql = "SELECT pull_ups, knee_graps FROM users ";
    $sql .= "WHERE id = '". db_escape($db, $user_id) ."'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    $user_info = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $user_info;
}

function update_pull_ups_and_knee_graps_by_id($pull_ups_and_knee_graps) {
    global $db;

    $sql = "UPDATE users SET ";
    $sql .= "pull_ups = '". db_escape($db, $pull_ups_and_knee_graps["pull_ups"]) ."', ";
    $sql .= "knee_graps = '". db_escape($db, $pull_ups_and_knee_graps["knee_graps"]) ."'";
    $sql .= "WHERE id = '". db_escape($db, $_SESSION["user_id"]) ."'";

    $result = mysqli_query($db, $sql);

    if($result) {
        return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
}

function get_corrective_strategy_by_id($user_id) {
    global $db;

    $sql = "SELECT * FROM corrective_strategy ";
    $sql .= "WHERE user_id = '". db_escape($db, $user_id) ."'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    if(mysqli_num_rows($result) == 0) {
        return null;
    }
    return $result;
}

function get_all_corrective_strategy_in_an_array_by_id($user_id) {
    global $db;

    $sql = "SELECT * FROM corrective_strategy ";
    $sql .= "WHERE user_id = '". db_escape($db, $user_id) ."'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    if(mysqli_num_rows($result) == 0) {
        return null;
    } else {
        $temp_array = [];
        while($corrective_strategy = mysqli_fetch_assoc($result)) { 
            array_push($temp_array, $corrective_strategy["name"]);
        }
        return $temp_array;
    }
}

function edit_corrective_strategy_by_id($user_id, $name) {
    global $db;

    $sql = "SELECT * FROM corrective_strategy ";
    $sql .= "WHERE user_id = '". db_escape($db, $user_id) ."' AND ";
    $sql .= "name = '". db_escape($db, $name) ."'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    $corrective_strategy = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    if($corrective_strategy != null) {
        $sql = "DELETE FROM corrective_strategy ";
        $sql .= "WHERE id = '". db_escape($db, $corrective_strategy["id"]) ."'";

        $result = mysqli_query($db, $sql);
    } else {
        $sql = "INSERT INTO corrective_strategy (";
        $sql .= "user_id, name";
        $sql .= ") VALUES (";
        $sql .= "'". db_escape($db, $user_id) ."', ";
        $sql .= "'". db_escape($db, $name) ."' ";
        $sql .= ")";

        $result = mysqli_query($db, $sql);
    }
    
    if($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }

    mysqli_free_result($result);
}
?>