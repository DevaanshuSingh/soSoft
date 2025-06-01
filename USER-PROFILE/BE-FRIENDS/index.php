<?php

use function PHPSTORM_META\type;

session_start();

if (isset($_COOKIE['selectedUserId'])) {

    $requestedFriendId = $_COOKIE['selectedUserId'];
    $myId = $_SESSION["myId"];
    $isFriend = $_GET["isFriend"];
    $returnArray = array();
    $returnArray['message'] = "You Are Already Friends";

    try {
        require_once '../../CONNECTION/config.php';
        if ($isFriend == "true") {
            $stmt = $pdo->prepare("DELETE FROM myFriends WHERE myId = ? AND friendId = ?;");
            if ($stmt->execute([$myId, $requestedFriendId])) {

                $stmt = $pdo->prepare("DELETE FROM myFriends WHERE myId = ? AND friendId = ?;");
                if ($stmt->execute([$requestedFriendId, $myId])) {
                    $returnArray['success'] = true;
                    $returnArray['message'] = "Made Unfriend Successfully";
                } else {
                    $returnArray['success'] = false;
                    $returnArray['message'] = "Failed To Unfriend Second";
                }
            } else {
                $returnArray['success'] = false;
                $returnArray['message'] = "Failed To Unfriend First";
            }
        } else if ($isFriend == "false") {
            $stmt = $pdo->prepare("INSERT INTO friend_requests (requested_from_id, requested_to_id) 
            VALUES (?, ?);");
            if ($stmt->execute([$myId, $requestedFriendId])) {
                $returnArray['success'] = true;
                $returnArray['message'] = "Requested Succesfully";
                $returnArray['isFriend'] = $isFriend;
            } else {
                $returnArray['success'] = false;
                $returnArray['message'] = "Failed To Requesting For Becoming Friend";
            }
        }

        echo json_encode($returnArray);
    } catch (PDOException $e) {
        echo "Error While Requestiong To Be Friend:<br>" . $e->getMessage();
    }

    setcookie("selectedUserId", "", time() - 3600, "/BE-FRIENDS");
} else {
    echo "Cookie not found.";
}
