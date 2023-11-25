<?php
const DBHOST = "localhost";
const DBCHARSET = "utf8";
const DBNAME = "web_phim";
const DBUSER = "root";
const DBPASS = "";
const BASE_URL = "/project_1/";
date_default_timezone_set("Asia/Ho_Chi_Minh");
function route($url)
{
    return BASE_URL . $url;
}
// key co the truyen success hoac errors
function flash($key, $msg, $route)
{
    $_SESSION[$key] = $msg;
    switch ($key) {
        case 'success':
            unset($_SESSION['errors']);
            break;
        case 'errors':
            unset($_SESSION['success']);
            break;
    }
    header('location:' . BASE_URL . $route . '?msg=' . $key);
    die;
}
