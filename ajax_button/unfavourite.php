<?php
/**
 * Created by PhpStorm.
 * User: Wenqian
 * Date: 7/17/2017
 * Time: 10:19 AM
 */

//sleep(2);

session_start();

if (!isset($_SESSION['favourites'])) {
    $_SESSION['favourites'] = [];
}

// A handy function to remove a single element from an array
function array_remove($element, $array) {
    $index = array_search($element, $array);
    array_splice($array, $index, 1);
    return $array;
}

function is_ajax_request() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
}

if(!is_ajax_request()) {
    exit;
}

// extract $id
$raw_id = isset($_POST['id']) ? $_POST['id'] : '';
//echo $raw_id;

if(preg_match("/blog-post-(\d+)/", $raw_id, $matches)){
    $id = $matches[1];

    // store in $_SESSION['favourite'];
    if (!in_array($id, $_SESSION['favourites'])) {
        $_SESSION['favourites'] = array_remove($id, $_SESSION['favourites']);
    }

    // return true/false
    echo 'true';

}else {
    echo 'false';
}



