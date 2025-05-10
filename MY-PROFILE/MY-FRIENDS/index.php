<?php
    session_start();
    // print_r($_GET);
    if(isset($_GET)){
        try {
            $myId=$_SESSION['myId'];
            $myFriendId=$_GET['myFriendId'];
            require_once '../../CONNECTION/config.php';
            $stmt = $pdo->prepare("insert into myFriends(myId,friendId) values(?,?),(?,?)");
            $responseArray=[];
            if($stmt->execute([$myId,$myFriendId,$myFriendId,$myId])){
                $responseArray['success']=true;
                $responseArray['message']="you became friends";
                
            }
            else{
                $responseArray['success']=false;
            }
            echo json_encode($responseArray);
            
           
        } catch (PDOException $e) {
        echo "Error While becoming Friends:<br>" . $e->getMessage();
        }
    }
    else{
        echo 'data not found';
    }