<?php
/**
 * Created by PhpStorm.
 * User: Wenqian
 * Date: 8/4/2017
 * Time: 2:27 PM
 */

function is_ajax_request() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
}

if (!is_ajax_request()) {
    exit;
}

$query = isset($_GET['q']) ? $_GET['q'] : '';

// find an return search suggestions as JSON