
 
<?php
if (isset($_POST['showAbout'])) {
    $myId = $_POST['showAbout'];
    require_once('../CONNECTION/config.php');
    try {
        $stmt = $pdo->prepare(' select friendId from myfriends where myId=?');
        $stmt->execute([$myId]);
        $friendsId = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $x = 1;
        $responseArray = [];
        if ($friendsId) {
            foreach ($friendsId as $friendId) {
                $stmt = $pdo->prepare(' select users.id,users.profile_picture,users.userName,users.fullName from users where id=?');
                $stmt->execute([$friendId['friendId']]);
                $friendDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);
                print_r($friendDetails);
                // $myFriends .= '<div class="friend">
                //     <div class="friend-contents">
                //         <div class="profile-photo">
                //             <img src="' . $friendDetails[$x]['profile_picture'] . '" alt="">
                //         </div>
                //         <div class="profile-name">
                //            ' . $friendDetails[$x]['fullName'] . '
                //         </div>
                //     </div>
                // </div>';
                // $x++;
                // if (!$friendDetails) {
                //     $responseArray['status'] = 'false';
                //     $responseArray['message'] = 'Data Not found';
                // } else {
                //     $responseArray['status'] = 'true';
                //     $responseArray['message'] = 'Data found';
                //     $responseArray['requestedData'] = $myFriends;
                // }
            }
        }
        echo json_encode($responseArray);
    } catch (PDOException $e) {
        echo "Error Checking:<br>" . $e->getMessage();
    }
} else {
    echo 'Data not found';
}
