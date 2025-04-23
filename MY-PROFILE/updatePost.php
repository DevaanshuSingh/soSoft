<?php

if (isset($_POST['id'], $_POST['postValue'])) {
    require_once '../CONNECTION/config.php';

    $stmt = $pdo->prepare("SELECT userName FROM users WHERE id= ?");
    $stmt->execute([$_POST['id']]);
    $userName = $stmt->fetchColumn();

    $stmt = $pdo->prepare("INSERT INTO posts(user_id, user_name,content)VALUES(?,?,?)");
    $stmt->execute([$_POST['id'], $userName, $_POST['postValue']]);

    $returnResponse = array();
    if ($stmt) {
        $returnResponse['success'] = true;
        $returnResponse['message'] = "Post Updated Successfully";
    } else {
        $returnResponse['success'] = false;
        $returnResponse['message'] = "Post Not Updated Successfully";
    }

    echo json_encode($returnResponse);
} else {
    echo "Please Enter Value, What You Want To Show To The Society";
}
