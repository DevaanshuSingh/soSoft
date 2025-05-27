<?php
session_start();
// print_r($_SESSION);
require_once '../CONNECTION/config.php';
$myId = $_SESSION['myId'];
// print_r($_POST);

$stmt = $pdo->prepare("SELECT * FROM users WHERE id =?;");
$stmt->execute([$myId]);
$me = $stmt->fetch();

$users = $pdo->prepare("SELECT * FROM users;");
$users->execute();
$allUsers = $users->fetchAll();

$posts = $pdo->prepare("SELECT * FROM posts;");
$posts->execute();
$posts = $posts->fetchAll();
// echo $me['email'];
if ($me && $allUsers) {
?>

  <!doctype html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SoSoft</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../MEDIA/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Tektur:wght@400..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="../ENV/env.js"></script>
    <script src="script.js"></script>
  </head>

  <body>
    <div class="listening">
      <div class="feature-column">
        <div class="mike-animation">
          <strong><i class=" text-light ri-volume-up-line"></i></strong>
        </div>
        <div class="stopListening" onclick="stopListening()">
          <strong><i class=" text-light ri-close-large-fill"></i></strong>
        </div>
      </div>
    </div>

    <div class="product-name" onclick="sbsr()">
      <strong class="text-primary">CNAT's SOSOFT</strong>
    </div>

    <div class="contact-section">
      <header class="contact-section-header">
        <span class="" onclick="openContactSection()"><i class="ri-close-circle-line"></i></span>
      </header>
      <div class="contact-info">
        <div class="about">Please Send Us Feedback</div>
        <div class="user-feedback">
          <textarea id="txt"></textarea>
          <button
            id="feedbackSendBtn"
            type="submit"
            class="btn p-2"
            style="margin-top: 1rem; padding: 0.75rem 1.5rem; background-color: #4CAF50; color: white; border: none; border-radius: 8px; font-size: 1rem; cursor: pointer; box-shadow: 0 2px 5px rgba(0,0,0,0.15); transition: background-color 0.3s;">
            Send
          </button>
        </div>
      </div>
    </div>

    <div class="toast-container w-100 position-fixed bottom-0 start-0 mb-2">
      <div id="liveToast" class="toast position-relative ms-auto me-1" role="alert" aria-live="assertive" aria-atomic="false" data-bs-autohide="false">
        <div class="toast-header d-flex justify-content-center bg-transparent">
          <strong class="h-100 me-auto color-success"><strong>Theme Changed</strong></strong>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
          <strong>Theme <span id="theme-name"></span>,</strong>
        </div>
      </div>
    </div>

    <div class="help-box">
      <header>
        <div class="header-left">SOFT_AI</div>
        <div class="header-right">YOU</div>
      </header>
      <main>
        <div class="about-soft-ai text-warning"><span><i>Soft_AI Cannot Memorize Chats,</i></span></div>

        <div class="chats">
          <!-- Chats Will Generate Here -->
        </div>

        <div class="message-to-ai">
          <textarea id="sendToAi" placeholder="Ask Here,"></textarea>
          <button class='askBtn' onclick="askSosoftAi()">Ask</button>
          <button class='voiceBtn' onclick="voiceCommand()"><span><i class="ri-speak-fill"></i></span></button>
        </div>
      </main>

    </div>
    <div class="help-btn" onclick="startHelping()">
      <strong>ASK</strong>
    </div>

    <div class="all-settings">
      <header><span onclick="toggleSettings(true)">X</span></header>
      <main>
        <div class="settings-list">
          <div class="theme setting">
            <div class="header">Theme</div>
            <div class="boxes">
              <div class="box setTheme" value="None" onclick="updateBcg(this)" style="background-color:rgba(255, 255, 255, 0.48);"></div>
              <div class="box setTheme" value="Yellow" onclick="updateBcg(this)" style="background-color:rgb(221, 237, 46);"></div>
              <div class="box setTheme" value="Skyblue" onclick="updateBcg(this)" style="background-color:rgb(52, 152, 219);"></div>
              <div class="box setTheme" value="Red" onclick="updateBcg(this)" style="background-color:rgba(255, 0, 0, 0.63);"></div>
              <div class="box setTheme" value="Light Green" onclick="updateBcg(this)" style="background-color:rgb(46, 204, 113);"></div>
              <div class="box setTheme" value="Black" onclick="updateBcg(this)" style="background-color:rgb(0, 0, 0);"></div>
              <div class="box setTheme" value="Violet" onclick="updateBcg(this)" style="background-color:rgb(155, 89, 182);"></div>
            </div>
          </div>

          <div class="shortcuts setting">
            <table class="col-12">
              <thead>
                <tr>
                  <th><u>ACTIONS</u></th>
                  <th><u>SHORTCUTS</u></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>View Society</td>
                  <td>Alt + Ctrl + S</td>
                </tr>
                <tr>
                  <td>My Profile</td>
                  <td>Alt + P</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </main>
    </div>
    <div class="menu">
      <div class="menu-button">
        <i id="menuToggler" onclick="toggleMenu()" class="ri-arrow-right-circle-line menu-icon"></i>
      </div>
      <div class="inside-menu">
        <div class="menu-heading"><span class="name"><u>Codernaccotax</u></span></div>
        <div class="menu-body">
          <div class="menu-options">
            <div onclick="location.href='../MY-PROFILE/'" class="menu-option mt-5">
              <span class="arrow"><i class="ri-arrow-right-line"></i></span>
              <span class="setting-option ms-2">My Profile</span>
            </div>
            <div onclick="openContactSection()" class="menu-option">
              <span class="arrow"><i class="ri-arrow-right-line"></i></span>
              <span class="setting-option ms-2">Contact</span>
            </div>
            <div onclick="toggleSettings(false)" class="menu-option">
              <span class="arrow"><i class="ri-arrow-right-line"></i></span>
              <span class="setting-option ms-2">Settings</span>
            </div>
            <div onclick="logout()" class="menu-option">
              <span class="arrow"><i class="ri-arrow-right-line"></i></span>
              <span class="setting-option ms-2">Logout</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="comment-section">
      <span onclick="commentSectionToggler()" class="close-comment-section"><i class="ri-close-circle-line"></i></span>
      <header class="comment-header">Comment On Post</header>
      <main class="comment-main-part">
        <div class="input-comment"><textarea class="comment-txt"></textarea></div>
        <div class="send-comment"><button onclick="sendComment(true)" class="send-comment-btn">Comment</button></div>
      </main>
    </div>
    <div class="main-container">
      <div class="container-fluid">

        <div class="heading">
          <span>All USERS</span>
        </div>

        <div class="users">
          <div class="show-user-profile-section">
            <!-- //Generating user profiles -->
            <?php
            try {
              foreach ($allUsers as $user) {
                if ($user['id'] == $myId)
                  continue;
                echo "<div class='user-profile' data-user-id='" . $user['id'] . "' onclick='selecteduser(" . $user['id'] . ")'>
                            <div class='user-profile-pic'> <img src='" . $user['profile_picture'] . "' alt='" . $user['userName'] . "'> </div>
                            <div class='user-profile-name'><strong>" . $user['userName'] . "</strong></div>
                          </div>";
              }
            } catch (PDOException $e) {
              echo "Error While Registering:<br>" . $e->getMessage();
            }
            ?>
          </div>
        </div>
        <div class="my-section" onclick="toggleMySection()">Self_Section</div>
        <div class="allposts">
          <?php
          if (empty($posts)) {
            echo "<span style='width: 80vw; position:relative; top: 5%; left: 5%;'>No Posts Yet Please <a href='../MY-PROFILE/' class='text-success'><b>POST</b></a></span>";
          } else {
            foreach ($posts as $post) {
              if ($post['user_id'] != $myId) {
                echo '<div class="content">
                    <div class="post-owner">
                      <div class="post-owner-name">' . $post['user_name'] . '</div>
                      <div class="post-owner-profile" > <button onclick="selecteduser(' . $post['user_id'] . ')" data-user-id="' . $post['user_id'] . '">Visit Profile</button> </div>
                    </div>

                    <div class="post">
                      <div class="main-post">
                        <span>' . $post['content'] . '</span>
                      </div>
                      <div class="interact-with-post">
                        <span class="interact-icons border-end border-1 border-dark ">
                          <div onclick="interaction(`like`,' . $myId . ',' . $post['user_id'] . ',' . $post['id'] . ',this)"  class="main-icon icon-red">
                            <i class="reaction-icons ri-heart-fill"></i>
                          </div>
                        </span>
                        <span class="interact-icons border-start border-1 border-dark">
                          <div onclick="interaction(`comment`,' . $myId . ',' . $post['user_id'] . ',' . $post['id'] . ',this)"  class="main-icon icon-blue">
                            <i class="reaction-icons ri-chat-upload-fill"></i>
                          </div>
                        </span>   
                      </div>
                    </div>
                  </div>';
              } else {
                echo '<div class="content">
                    <div class="post-owner">
                      <div class="post-owner-name">You</div>
                      <div class="interaction-view">
                        <span class="open-review" onclick="PostReviewToggler()" ><strong><i class="ri-more-2-line"></i></strong></span>
                        <div class="my-post-interaction-view">
                          <div class="review-heading">
                          <span onclick="PostReviewToggler()" class="close-review"><i class="ri-close-circle-fill"></i></span>
                          <span class="likes-heading" onclick="getInteractionsList(' . $myId . ',`like`)">
                            <i class="ri-heart-fill"></i><span class="likes-count">80K</span>
                          </span>
                          <span class="comments-heading" onclick="getInteractionsList(' . $myId . ',`comment`)"> 
                            <i class="ri-chat-4-fill"></i><span class="comments-count">80K</span>
                          </span>
                          </div>
                          <div class="all-reviews">
                            <div class="about-review">
                              <u>Click Above</u>
                            </div>
                            <div class="review-list">
                            <pre>HERE LIST WILL BE SHOWN</pre>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="post">
                      <div class="main-post">
                        <span>' . $post['content'] . '</span>
                      </div>
                      <div class="interact-with-post">
                        <span class="interact-icons border-end border-1 border-dark ">
                          <div onclick="interaction(`like`,' . $myId . ',' . $post['user_id'] . ',' . $post['id'] . ',this)"  class="main-icon icon-red">
                            <i class="reaction-icons ri-heart-fill"></i>
                          </div>
                        </span>
                        <span class="interact-icons border-start border-1 border-dark">
                          <div onclick="interaction(`comment`,' . $myId . ',' . $post['user_id'] . ',' . $post['id'] . ',this)"  class="main-icon icon-blue">
                            <i class="reaction-icons ri-chat-upload-fill"></i>
                          </div>
                        </span>   
                      </div>
                    </div>
                  </div>';
              }
            }
          }
          ?>
        </div>
      </div>
    </div>

    <div id="loader" style="display: none;">
      <div class="spinner"></div>
    </div>

    <script>
      let shouldStopListening = false;

      function voiceCommand() {
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        if (!SpeechRecognition) {
          alert("SpeechRecognition is not supported in this browser");
        } else {
          r = new SpeechRecognition();

          r.continuous = false;
          r.interimResults = false;
          r.maxAlternatives = 1;

          r.onstart = function() {
            $('.listening').toggle('slow');
            $('.listening').css('display', 'flex');
          };
          r.onend = function() {
            if (!shouldStopListening) {
              $('.listening').toggle('slow');
            }
            shouldStopListening = false;
          };
          r.onresult = async function(event) {
            const transcript = event.results[0][0].transcript;
            // $('textarea').html(transcript);
            $('textarea').val(transcript);
          };
          r.onerror = function(event) {
            shouldStopListening = true;
            console.error('Error occurred in recognition: ' + event.error);
            console.log('Please Try To Say,');
            $('.listening').toggle('slow');
          };
          r.start();
          return 0;
        }
      }

      function stopListening() {
        if (!r) {
          alert("Nor R Found");
        } else {
          r.stop();
        }
      }

      let color = localStorage.getItem('bcg');
      document.body.style.backgroundColor = color;
      $('#feedbackSendBtn').on('click', function(e) {
        e.preventDefault();
        let getEmail = "<?php echo $me['email']; ?>";
        let getName = "<?php echo $me['userName']; ?>";
        let feedback = $('#txt').val();
        let data = {
          name: getName,
          email: getEmail,
          feedback: feedback,
          feedbackAt: new Date()
        };
        sendFeedback(data);
      });
    </script>
  </body>

  </html>
<?php
} else {
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Not Found</title>
  </head>

  <body>
    <h1>No Data Found</h1>
    <div><a href="..">Go To Home</a></div>
  </body>

  </html>

<?php
}
