<?php
    if(isset($_POST['myId'])){
        require_once '../../CONNECTION/config.php';
        try {
            $myId=$_POST['myId'];
                $stmt = $pdo->prepare("select * from friend_requests where requested_to_id=?");
                $stmt->execute([$myId]);
                $showFriendRequests=$stmt->fetchAll(PDO::FETCH_ASSOC);
                $responseArray=[];
                if(empty($showFriendRequests)){
                    $responseArray['status']='false';
                    $responseArray['message']='no data found';
                }
                else{
                    $responseArray['status']='true';
                    $responseArray['data']=$showFriendRequests;

                }
                echo json_encode($responseArray);
                
        } catch (PDOException $e) {
            echo "Error While Requestiong To Be Friend:<br>" . $e->getMessage();
        }
    }
    else{
        echo 'data not found';
    }