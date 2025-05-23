<?php
session_start();
if (isset($_POST['myId'])) {
    $_SESSION['myId'] = $_POST['myId'];
}
