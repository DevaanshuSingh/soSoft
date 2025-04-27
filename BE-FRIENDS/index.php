<?php
session_start();

if (isset($_COOKIE['selectedUserId'])) {

    $requestedFriendId = $_COOKIE['selectedUserId'];
    $myId = $_SESSION["myId"];

    try {
        require_once '../CONNECTION/config.php';
        
            $stmt = $pdo->prepare("INSERT INTO friend_requests (requested_from_id, requested_to_id) 
            VALUES (?, ?);");
            $returnArray=Array();
            if($stmt->execute([$myId,$requestedFriendId])){
                $returnArray['success']=true;
                $returnArray['message']="Requested Succesfully";
            }
            else{
                $returnArray['success']=false;
                $returnArray['message']="Failed To Requesting For Becoming Friend";
            }

            echo json_encode($returnArray);
    } catch (PDOException $e) {
        echo "Error While Requestiong To Be Friend:<br>" . $e->getMessage();
    }
    
    setcookie("selectedUserId", "", time() - 3600, "/BE-FRIENDS");
} else {
    echo "Cookie not found.";
}
