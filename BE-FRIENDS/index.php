<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    print_r($_POST);
} else {
    echo "No POST data received.".$_SERVER['REQUEST_METHOD'];
}
