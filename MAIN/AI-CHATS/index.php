<?php

if (isset($_GET['myId'], $_GET['userPrompt'], $_GET['aiResponse'])) {
  require_once '../../CONNECTION/config.php';
  $myId = $_GET['myId'];
  $userPrompt = $_GET['userPrompt'];
  $aiResponse = $_GET['aiResponse'];
  $generatedchat = '';

  $stmt = $pdo->prepare("INSERT INTO user_ai_chats (user_id, user_prompt, ai_reply) VALUES (?,?,?)");
  if ($stmt->execute([$myId, $userPrompt, $aiResponse])) {

    $stmt = $pdo->prepare("INSERT INTO user_ai_chats (user_id, user_prompt, ai_reply) VALUES (?, ?, ?)");
    if ($stmt->execute([$myId, $userPrompt, $aiResponse])) {
      $chatId = $pdo->lastInsertId();
      $chatId;
    }

    $generatedchat .= '
                <div class="prompt-reply prompt-reply' . $chatId . '"> 
                  <div class="chat user-prompt user-prompt' . $chatId . '">
                    <header><strong><u>Your Prompt:</u></strong></header>
                    <main>
                      <div class="chat-text chat-text' . $chatId . '"> 
                        <div class="message message' . $chatId . '">
                          ' . $userPrompt . '
                        </div>
                      </div>
                    </main>
                    <footer class="footer' . $chatId . '" onclick="speakChat(`user-prompt' . $chatId . '`)" ><i class="ri-volume-up-line text-warning"></i></footer>
                  </div>
                  <div class="chat ai-reply ai-reply' . $chatId . '">
                    <header><strong><u>softAi Says:</u></strong></header>
                    <main>
                      <div class="chat-text" chat-text' . $chatId . '">
                        <div class="message message' . $chatId . '">
                        ' . $aiResponse . '
                        </div>
                      </div>
                    </main>
                    <footer class="footer' . $chatId . '" onclick="speakChat(`ai-reply' . $chatId . '`)"><i class="ri-volume-up-line text-warning"></i></footer>
                  </div>
                </div>';
    echo json_encode(array('status' => 'true', 'message' => 'Chats Saved Successfully', 'generatedChat' => $generatedchat));
  } else {
    echo json_encode(array('status' => 'false', 'message' => 'Chats Didnot Saved Successfully'));;
  }
} else {
  echo "SBSR0";
}
