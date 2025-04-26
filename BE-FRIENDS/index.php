<?php

if (isset($_COOKIE['friendId'])) {

    $cookieValue = $_COOKIE['friendId'];
    echo "Cookie value: " . $cookieValue;

    // if (setcookie("friendId", "", time() - 3600, "/BE-FRIENDS")) {}
    echo $_COOKIE['friendId'];
} else {
    echo "Cookie not found.";
}
?>
