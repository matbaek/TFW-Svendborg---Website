<?php

function url_for($script_path) {
    if($script_path[0] != "/") {
        $script_path = "/" . $script_path;
    }
    return WWW_ROOT . $script_path;
}

function u($string = "") {
    return urlencode($string);
}

function raw_u($string = "") {
    return rawurlencode($string);
}

function h($string = "") {
    return htmlspecialchars($string);
}

function h_d($string = "") {
    return htmlspecialchars_decode($string);
}

function redirect_to($location) {
    header("Location: " . url_for($location));
    exit();
}

function is_post_request() {
    return $_SERVER["REQUEST_METHOD"] == "POST";
}

function is_get_request() {
    return $_SERVER["REQUEST_METHOD"] == "GET";
}

function display_errors($errors=array()) {
    $output = '';
    if(!empty($errors)) {
      $output .= "<ul>";
      foreach($errors as $error) {
        $output .= "<li>" . h_d($error) . "</li>";
      }
      $output .= "</ul>";
    }
    return $output;
}

function get_color($number) {
	if ($number % 2 == 0) {
		return "#E5E5DB";
	} else if ($number % 2 == 1) {
		return "#F8F1E9";
	}
}
function get_color_two($number) {
	if ($number % 2 == 0) {
		return "#BA6865";
	} else if ($number % 2 == 1) {
		return "#E7746F";
	}
}

function get_symbol_for_corrective_strategy($name, $array) {
    if($name != "" && $array != null) {
        if(in_array($name, $array)) {
            return "&#9745;";
        } else {
            return "&#9744;";
        }
    } else {
        return "&#9744;";
    }
}

// VALIDATION
function is_blank($value) {
    return !isset($value) || trim($value) === '';
}

function has_unique_username($username) {
    global $db;

    $sql = "SELECT * FROM user ";
    $sql .= "WHERE username='". db_escape($db, $username) ."'";

    $result = mysqli_query($db, $sql);
    $user_count = mysqli_num_rows($result);
    mysqli_free_result($result);

    return $user_count;
}

// OTHER
function corrective_strategy_images($corrective_strategy) {
    switch ($corrective_strategy["name"]) {
        case "Body Squat | Heels Lifting":
            return ["1", "2", "3"];
        case "Body Squat | Shallow Depth":
            return ["4", "4a", "5"];
        case "Body Squat | Folding Forward":
            return ["6", "7", "8", "9a", "9b", "9c"];
        case "Body Squat | Collapsed Arch":
            return ["3", "10", "1", "11"];
        case "Body Squat | Feet External Rotation":
            return ["12", "13", "14", "15"];
        case "Body Squat | Knees Collapsing In":
            return ["16", "17", "11"];
        case "Lying Hamstring | Asymmetry":
            return ["14", "18"];
        case "Shoulder IR/ER | IR – Lower hand":
            return ["19", "20", "20a"];
        case "Shoulder IR/ER | ER – Overhand":
            return ["7", "21", "22", "23"];
        case "Standing Soleus | Asymmetry":
            return ["1", "2"];
        case "Seated Gluteal | Asymmetry":
            return ["12", "13", "15"];
        default:
            break;
    }
}

?>