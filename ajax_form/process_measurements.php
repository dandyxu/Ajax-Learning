<?php
/**
 * Created by PhpStorm.
 * User: Wenqian
 * Date: 8/2/2017
 * Time: 11:03 AM
 */
//sleep(2);

function is_ajax_request() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
}

$length = isset($_POST['length']) ? (int) $_POST['length'] : '';
$width = isset($_POST['width']) ? (int) $_POST['width'] : '';
$height = isset($_POST['height']) ? (int) $_POST['height'] : '';

$error = [];
if ($length == '') {
    $errors[] = 'length';
}
if ($width == '') {
    $errors[] = 'width';
}
if ($height == '') {
    $errors[] = 'height';
}

if(!empty($errors)) {
    // won't work b/c of single-quotes, json phrase is picky about single quotes
    //echo "{ 'errors': " . json_encode($errors) . "}";
    $result_array = array('errors' => $errors);
    echo json_encode($result_array);
    exit;
}

$volume = $length * $width * $height;

if(is_ajax_request()) {
    echo json_encode(array('volume' => $volume));
    //echo $volume;
}else {
    exit;
}