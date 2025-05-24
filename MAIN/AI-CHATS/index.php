<?php

if (isset($_GET['myId'], $_GET['userPrompt'], $_GET['aiResponse'])) {
    require_once '../../CONNECTION/config.php';
    $myId = $_GET['myId'];
    $userPrompt = $_GET['userPrompt'];
    $aiResponse = $_GET['aiResponse'];
    $generatedchat = '';

    $stmt = $pdo->prepare("INSERT INTO user_ai_chats (user_id, user_prompt, ai_reply) VALUES (?,?,?)");
    if ($stmt->execute([$myId, $userPrompt, $aiResponse])) {

        $generatedchat .= '
                <div class="prompt-reply">
            <div class="chat user-prompt">
              <header><strong><u>Your Prompt:</u></strong></header>
              <main>
                <div class="chat-text">
                  <div class="message">
                    ' . $userPrompt . '
                  </div>
                </div>
              </main>
              <footer><i class="ri-volume-up-line text-warning"></i></footer>
            </div>
            <div class="chat ai-reply">
              <header><strong><u>softAi Says:</u></strong></header>
              <main>
                <div class="chat-text">
                  <div class="message">
                  ' . $aiResponse . '
                  </div>
                </div>
              </main>
              <footer><i class="ri-volume-up-line text-warning"></i></footer>
            </div>
          </div>';
        echo json_encode(array('status' => 'true', 'message' => 'Chats Saved Successfully','generatedChat' => $generatedchat));
    } else {
        echo json_encode(array('status' => 'false', 'message' => 'Chats Didnot Saved Successfully'));;
    }
} else {
    echo "SBSR0";
}
