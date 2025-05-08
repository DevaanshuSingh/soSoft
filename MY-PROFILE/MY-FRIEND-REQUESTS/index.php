<?php
    // print_r($_GET);
    if(isset($_GET['myId'])){
        require_once('../../CONNECTION/config.php');
        try {
            $myId=$_GET['myId'];
            $stmt = $pdo->prepare("select * from friend_requests where requested_to_id=?");
            $stmt->execute([$myId]);
            $RequestedUserInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $responseArray=[];
            if(empty($RequestedUserInfo)){
                $responseArray['status']=false;
                $responseArray['message']="no data found";
            }
            else{
                $responseArray['status']=true;
                $responseArray['message']="data found";
                $responseArray['requestedData']=$RequestedUserInfo;
            }
            echo json_encode($responseArray);

                
        } catch (PDOException $e) {
            echo "Error Checking:<br>" . $e->getMessage();
        }

    }
    else{
        echo "Data not found";
    }