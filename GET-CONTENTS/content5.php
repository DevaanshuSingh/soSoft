<?php

// print_r($_POST);
if (isset($_POST['showAbout'])) {
    require_once '../CONNECTION/config.php';
    try {
        $myId = $_POST['showAbout'];
        $stmt = $pdo->prepare("select requested_from_id from friend_requests where requested_to_id=?");
        $stmt->execute([$myId]);
        $requestedFriendsId = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $responseArray = [];
        $index = 0;
        $myFriends = '';
        if ($requestedFriendsId) {
            foreach ($requestedFriendsId as $friendId) {
                $stmt = $pdo->prepare(' select id, profile_picture, userName, fullName from users where id=?');
                $stmt->execute([$friendId['requested_from_id']]);
                $friendId = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $myFriends .= '<div class="friendList" onclick="selecteduser(' . $friendId[0]['id'] . ')">
                    <div class="friend">
                        <div class="friend-contents">
                            <div class="profile-photo">
                                <img src="' . $friendId[0]['profile_picture'] . '" alt="">
                            </div>
                            <div class="profile-name">
                                ' . $friendId[0]['fullName'] . '
                            </div>
                        </div>
                    </div>
                </div>';
                // print_r($friendId);
                $index++;
            }
            $responseArray['status'] = 'true';
            $responseArray['message'] = 'Data found';
            $responseArray['data'] = $myFriends;
        } else {
            $responseArray['status'] = 'false';
            $responseArray['message'] = 'Data Not found';
            $responseArray['data'] = '<span style="width : 100%;" class="text-center text-warning">You Have No Friends Yet</span>';
        }
        echo json_encode($responseArray);
    } catch (PDOException $e) {
        echo "Error While Requestiong To Be Friend:<br>" . $e->getMessage();
    }
} else {
    echo 'data not found';
}
