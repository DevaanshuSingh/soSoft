<?php
if (isset($_POST['showAbout'])) {
    $myId = $_POST['showAbout'];
    require_once('../CONNECTION/config.php');
    try {
        $stmt = $pdo->prepare(' select friendId from myfriends where myId=?');
        $stmt->execute([$myId]);
        $friendsId = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $x = 0;
        $myFriends = '';
        $responseArray = [];
        if ($friendsId) {
            foreach ($friendsId as $friendId) {
                $stmt = $pdo->prepare(' select users.id,users.profile_picture,users.userName,users.fullName from users where id=?');
                $stmt->execute([$friendId['friendId']]);
                $friendDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $myFriends .= '<div class="friendList" onclick="selecteduser(' . $friendDetails[0]['id'] . ')">
                    <div class="friend">
                        <div class="friend-contents">
                            <div class="profile-photo">
                                <img src="' . $friendDetails[0]['profile_picture'] . '" alt="">
                            </div>
                            <div class="profile-name">
                                ' . $friendDetails[0]['fullName'] . '
                            </div>
                        </div>
                    </div>
                </div>';
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
        echo "Error Checking:<br>" . $e->getMessage();
    }
} else {
    echo 'Data not found';
}