<?php
session_start();
if (isset($_POST['showAbout'])) {
  require_once '../CONNECTION/config.php';

  $userId = $_POST['showAbout'];
  $fromMyProfile = false;
  if (isset($_POST['fromMyProfile'])) {
    $fromMyProfile = $_POST['fromMyProfile'];
  }

  $stmt = $pdo->prepare("SELECT * FROM posts WHERE user_Id =?;");
  $stmt->execute([$userId]);
  $userPosts = $stmt->fetchAll(PDO::ATTR_AUTOCOMMIT);
  $responseArr = [];
  $data = '';


  if (empty($userPosts)) {
    echo "<span style='width: 80vw; position:relative; top: 5%; left: 5%;'>No Posts Yet Please <a href='../MY-PROFILE/' class='text-success'><b>POST</b></a></span>";
  } else {
    if ($fromMyProfile) {
      foreach ($userPosts as $post) {
        $data .= '<div class="content mt-2">
                  <div class="post-owner">
                      <div class="post-owner-name"><strong>You</strong></div>
                  </div>
                  <div class="post">
                      <div class="main-post">
                          <span>' . $post['content'] . '</span>
                        </div>
                      <div class="interact-with-post">
                            <span class="interact-icons border-end border-1 border-dark ">
                                <i class="reaction-icons ri-heart-fill text-danger"></i>
                            </span>
                            <span class="interact-icons border-start border-1 border-dark">
                                <i class="reaction-icons ri-chat-upload-fill"></i>
                            </span>   
                      </div>
                  </div>
              </div>';
      }
    } else {
      foreach ($userPosts as $post) {
        $data .= '<div class="content mt-2">
                <div class="post-owner">
                    <div class="post-owner-name"><strong>' . $post['user_name'] . '</strong></div>
                </div>
                <div class="post">
                    <div class="main-post">
                        <span>' . $post['content'] . '</span>
                      </div>
                    <div class="interact-with-post">
                          <span class="interact-icons border-end border-1 border-dark ">
                              <i class="reaction-icons ri-heart-fill text-danger"></i>
                          </span>
                          <span class="interact-icons border-start border-1 border-dark">
                              <i class="reaction-icons ri-chat-upload-fill"></i>
                          </span>   
                    </div>
                </div>
            </div>';
      }
    }
    $responseArr['status'] = 'success';
    $responseArr['message'] = 'Posts Fetched Successfully';
    $responseArr['data'] = $data;
    echo json_encode($responseArr);
  }
} else {
  echo "Pleaes Select Correct User";
}
