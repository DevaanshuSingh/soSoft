<?php
if (empty($_POST['myId'] || $_POST['postOwnerId'] || $_POST['postId'])) {
    echo json_encode(array('status' => 'error', 'message' => 'Post ID is required.'));
} else {
    $myId = $_POST['myId'];
    $postOwnerId = $_POST['postOwnerId'];
    $postId = $_POST['postId'];
    require_once '../CONNECTION/config.php';
    $stmt = $pdo->prepare("INSERT INTO post_interactions (postId, postOwnerId, postInteractionType, interactedUserId) VALUES (?,?,?,?)");
    if ($stmt->execute([$postId, $postOwnerId, 'like', $myId])) {
        echo json_encode(array('status' => 'true', 'message' => 'Commented The Post Successfully'));
    }
    else{
        echo json_encode(array('status' => 'false', 'message' => 'Failed to Comment the post.')); 
    }
}