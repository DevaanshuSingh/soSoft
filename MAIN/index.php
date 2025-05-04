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

  </head>

  <body>
    <div class="product-name">
      <strong class="text-primary">CNAT's SOSOFT</strong>
    </div>

    <div class="contact-section">
      <header class="contact-section-header">
        <span onclick="openContactSection()"><i class="ri-close-circle-line"></i></span>
      </header>
      <div class="contact-info">
        <span>example@gmail.com</span>
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
              <div class="box setTheme" value="Red" onclick="updateBcg(this)" style="background-color:rgb(255, 0, 0);"></div>
              <div class="box setTheme" value="Light Green" onclick="updateBcg(this)" style="background-color:rgb(46, 204, 113);"></div>
              <div class="box setTheme" value="Black" onclick="updateBcg(this)" style="background-color:rgb(0, 0, 0);"></div>
              <div class="box setTheme" value="Violet" onclick="updateBcg(this)" style="background-color:rgb(155, 89, 182);"></div>
            </div>
          </div>

          <div class="shortcuts setting">
            <table class="col-12">
              <thead>
                <tr>
                  <th>Action</th>
                  <th>Shortcut</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>View Society</td>
                  <td>Alt + Ctrl + S</td>
                </tr>
                <tr>
                  <td>My Profile</td>
                  <td>Alt + Ctrl + P</td>
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
          </div>
        </div>
      </div>
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
        <div class="my-section" onclick="showSelfSection()">Self_Section</div>

        <div class="allposts">
          <?php
          if (empty($posts)) {
            echo "<span style='width: 80vw; position:relative; top: 5%; left: 5%;'>No Posts Yet Please <a href='../MY-PROFILE/' class='text-success'><b>POST</b></a></span>";
          } else {
            foreach ($posts as $post) {
              echo '<div class="content">
              <div class="post-owner">
                <div class="post-owner-name">Post By: ' . $post['user_name'] . '</div>
                <div class="post-owner-profile" > <button onclick="selecteduser(' . $post['user_id'] . ')" data-user-id="' . $post['user_id'] . '">Visit Profile</button> </div>
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
          ?>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <script>
      // $(document).ready(function() {
      //   $('.menu-option').on('click', function() {
      //     console.log($(this).html());
      //   });
      // });
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
