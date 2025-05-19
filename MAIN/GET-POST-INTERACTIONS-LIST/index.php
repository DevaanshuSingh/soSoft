<?php
if (empty($_GET['myId']) || empty($_GET['getListOf'])) {
    echo json_encode(array('status' => 'error', 'message' => 'ID is required.'));
} else {
    $myId = $_GET['myId'];
    $interactionType = $_GET['getListOf'];
    require_once '../../CONNECTION/config.php';
    $stmt = $pdo->prepare("
    SELECT 
        post_interactions.postId, 
        post_interactions.postOwnerId, 
        post_interactions.postInteractionType, 
        post_interactions.interactedUserId,
        post_interactions.commentVal,
        users.id AS userId, 
        users.fullName, 
        users.profile_picture
    FROM post_interactions
    INNER JOIN users 
    ON post_interactions.interactedUserId = users.id
    WHERE post_interactions.postOwnerId = ?
    AND post_interactions.postInteractionType = ?;
    ");
    $stmt->execute([$myId, $interactionType]);
    $postReview = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($postReview)) {
        echo json_encode(array('status' => 'false', 'message' => 'No Record For ' . $interactionType));
    } else {
        $record = '';
        if ($interactionType == 'like') {
            foreach ($postReview as $post) {
                $record .= '<div class="mt-2 interacted-user" onclick="showInteractedUser(' . $post['userId'] . ')">
                <div class="interacted-user-image"><img h-100 w-100 src="' . $post['profile_picture'] . '"></div>
                <div class="interacted-user-name"><strong>' . $post['fullName'] . '</strong> Likes Your Post</div>
            </div>';
            }
        }
        else if ($interactionType == 'comment') {
            foreach ($postReview as $post) {
                $record .= '<div class="mt-2 interacted-user" onclick="showInteractedUser(' . $post['userId'] . ')">
                <div class="interacted-user-image"><img h-100 w-100 src="' . $post['profile_picture'] . '"></div>
                <div class="interacted-user-name"><strong><i><u>' . $post['fullName'] . ' Commented:</u></i></strong><br> '.$post['commentVal'].'</div>
            </div>';
            }
        }
        else{
            echo "Some Mistake In Finding Interaction Type,";
        }
        echo json_encode(array('status' => 'true', 'message' => 'Got Record For ' . $interactionType, "data" => $record, "$record" => $postReview));
    }
}
