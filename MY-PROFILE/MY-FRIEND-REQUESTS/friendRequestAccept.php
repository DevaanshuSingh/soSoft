<?php
if(isset($_POST)){
    require_once '../../CONNECTION/config.php';
    try {
        $deleteRowId=$_POST['deleteFriendRequests'];
            $stmt = $pdo->prepare("delete from friend_requests where id=?");
            $responseArray=[];
            if($stmt->execute([$deleteRowId])){
                $responseArray['success']=true;
                $responseArray['message']="row deleted ssuccessfully";
            }
            else{
                $responseArray['success']=false;
            }
            echo json_encode($responseArray);

            
    } catch (PDOException $e) {
        echo "Error While Requestiong To Be Friend:<br>" . $e->getMessage();
    }
}

            