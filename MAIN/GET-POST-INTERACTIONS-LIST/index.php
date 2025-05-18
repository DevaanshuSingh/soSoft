<?php
if (empty($_GET['myId']) || empty($_GET['getListOf'])) {
    echo json_encode(array('status' => 'error', 'message' => 'GE ID is required.'));
} else {
    $myId = $_GET['myId'];
    $interactionType = $_GET['getListOf'];
    require_once '../../CONNECTION/config.php';
    $stmt = $pdo->prepare("SELECT * FROM post_interactions WHERE postOwnerId=? AND postInteractionType=?;");
    $stmt->execute([$myId, $interactionType]);
    $postReview = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($postReview)) {
        echo json_encode(array('status' => 'false', 'message' => 'No Record For ' . $interactionType));
    } else {
        $record = '';
        foreach ($postReview as $post) {
            $record .= '<div class="mt-2 interacted-user">
                <div class="interacted-user-image"></div>
                <div class="interacted-user-name">'.$post['postInteractionType'].'</div>
            </div>';
        }
        echo json_encode(array('status' => 'true', 'message' => 'Got Record For ' . $interactionType, "data" => $record));
    }
}
