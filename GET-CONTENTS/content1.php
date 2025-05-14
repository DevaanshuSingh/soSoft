 
<?php
    if(isset($_POST['showAbout'])){
        $myId=$_POST['showAbout'];
        require_once('../CONNECTION/config.php');
        try{
            $stmt=$pdo->prepare(' select friendId from myfriends where myId=?');
            $stmt->execute([$myId]);
            $friendsId=$stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($friendsId as $friendId){
                        $stmt=$pdo->prepare(' select users.profile_picture,users.userName,users.fullName from users where id=?');
                        $stmt->execute([$friendId['friendId']]);
                        $friendDetails=$stmt->fetchAll(PDO::FETCH_ASSOC);
                        // print_r($friendDetails);
                    echo '<div class="friend">
                        <div class="friend-contents">
                            <div class="profile-photo">
                                <img src="'.$friendDetails[0]['profile_picture'].'" alt="">
                            </div>
                            <div class="profile-name">
                               '.$friendDetails[0]['fullName'].'
                            </div>
                        </div>
                    </div>';
                    echo '<div class="friend">
                        <div class="friend-contents">
                            <div class="profile-photo">
                                <img src="'.$friendDetails[0]['profile_picture'].'" alt="">
                            </div>
                            <div class="profile-name">
                               '.$friendDetails[0]['fullName'].'
                            </div>
                        </div>
                    </div>';
                    echo '<div class="friend">
                        <div class="friend-contents">
                            <div class="profile-photo">
                                <img src="'.$friendDetails[0]['profile_picture'].'" alt="">
                            </div>
                            <div class="profile-name">
                               '.$friendDetails[0]['fullName'].'
                            </div>
                        </div>
                    </div>';
                    echo '<div class="friend">
                        <div class="friend-contents">
                            <div class="profile-photo">
                                <img src="'.$friendDetails[0]['profile_picture'].'" alt="">
                            </div>
                            <div class="profile-name">
                               '.$friendDetails[0]['fullName'].'
                            </div>
                        </div>
                    </div>';
                    echo '<div class="friend">
                        <div class="friend-contents">
                            <div class="profile-photo">
                                <img src="'.$friendDetails[0]['profile_picture'].'" alt="">
                            </div>
                            <div class="profile-name">
                               '.$friendDetails[0]['fullName'].'
                            </div>
                        </div>
                    </div>';
                    echo '<div class="friend">
                        <div class="friend-contents">
                            <div class="profile-photo">
                                <img src="'.$friendDetails[0]['profile_picture'].'" alt="">
                            </div>
                            <div class="profile-name">
                               '.$friendDetails[0]['fullName'].'
                            </div>
                        </div>
                    </div>';
                    echo '<div class="friend">
                        <div class="friend-contents">
                            <div class="profile-photo">
                                <img src="'.$friendDetails[0]['profile_picture'].'" alt="">
                            </div>
                            <div class="profile-name">
                               '.$friendDetails[0]['fullName'].'
                            </div>
                        </div>
                    </div>';
                    echo '<div class="friend">
                        <div class="friend-contents">
                            <div class="profile-photo">
                                <img src="'.$friendDetails[0]['profile_picture'].'" alt="">
                            </div>
                            <div class="profile-name">
                               '.$friendDetails[0]['fullName'].'
                            </div>
                        </div>
                    </div>';

                    echo '<div class="friend">
                        <div class="friend-contents">
                            <div class="profile-photo">
                                <img src="'.$friendDetails[0]['profile_picture'].'" alt="">
                            </div>
                            <div class="profile-name">
                               '.$friendDetails[0]['fullName'].'
                            </div>
                        </div>
                    </div>';echo '<div class="friend">
                        <div class="friend-contents">
                            <div class="profile-photo">
                                <img src="'.$friendDetails[0]['profile_picture'].'" alt="">
                            </div>
                            <div class="profile-name">
                               '.$friendDetails[0]['fullName'].'
                            </div>
                        </div>
                    </div>';
                    
                    
                }
            echo '</div>';
            // $responseArray=[];
            // if(empty($friendDetails)){
            //     $responseArray['status']='false';
            //     $responseArray['message']='Data Not found';
            // }else{
            //     $responseArray['status']='true';
            //     $responseArray['message']='Data found';
            //     $responseArray['requestedData']=$friendDetails;
            // }
            // echo json_encode($responseArray);
        } catch (PDOException $e) {
            echo "Error Checking:<br>" . $e->getMessage();
        }
    }else{
        echo 'Data not found';
    }
    