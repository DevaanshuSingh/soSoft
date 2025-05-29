<?php
if (isset($_POST['showAbout'])) {
    require_once '../CONNECTION/config.php';
    try {
        $myId = $_POST['showAbout'];
        $stmt = $pdo->prepare("select requested_from_id from friend_requests where requested_to_id=?");
        $stmt->execute([$myId]);
        $requestedFriendsId = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $responseArray = [];
        // print_r($requestedFriendsId);
        foreach ($requestedFriendsId as $requestedFriendId) {
            $stmt = $pdo->prepare('select profile_picture,fullName from users where id=?');
            $stmt->execute([$requestedFriendId['requested_from_id']]);
            $friendDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        if (empty($showFriendRequests)) {
            $responseArray['status'] = 'false';
            $responseArray['message'] = 'no data found';
        } else {
            $responseArray['status'] = 'true';
            $responseArray['data'] = $showFriendRequests;
        }
        echo json_encode($responseArray);
    } catch (PDOException $e) {
        echo "Error While Requestiong To Be Friend:<br>" . $e->getMessage();
    }
} else {
    echo 'data not found';
}