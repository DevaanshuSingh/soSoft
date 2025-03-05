<?php
require_once '../CONNECTION/config.php';

$loggedId = $_GET['loggedPersonId'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE id =?;");
$stmt->execute([$loggedId]);
$me = $stmt->fetch();


$get = $pdo->prepare("SELECT * FROM users;");
$get->execute();
$allUsers = $get->fetchAll();
if ($me && $allUsers) {
?>

  <!doctype html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SoSoft</title>
    <link rel="stylesheet" href="style.css">
    <!-- <link rel="stylesheet" href="./css/use.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
  </head>

  <body>

    <div class="menu">
      <div class="menu-button">
        <i id="menuToggler" onclick="toggleMenu()" class="ri-arrow-right-circle-line menu-icon"></i>
      </div>

      <div class="inside-menu"></div>
    </div>

    <div class="main-container">
      <div class="container">
        <div class="heading">
          <span>CNAT's SOSOFT</span>
        </div>
        <div class="users">
          <div class="show-user-profile-section">
            <?php
            try {
              //Generating user profiles
              foreach ($allUsers as $user) {
                echo "<div class='user-profile'>
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
        <!-- <div class="content"> -->
        <div class="my-section">Self_Section</div>
        <!-- </div> -->
      </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
      let isMenuOpen = true;

      function toggleMenu() {
        if (isMenuOpen === true) {
          document.querySelector(".menu .menu-button").style.display = "hidden";
          document.querySelector(".menu").style.transition = "2s cubic-bezier(1, 7, 0.5, 5)";
          document.querySelector("body").style.gridTemplateColumns = "0 100%";
          document.querySelector("body").style.transition = "2s ease";
          document.querySelector(".menu-icon").style.transform = "rotate(0deg)";
          document.querySelector(".menu-icon").style.transition = "2s ease-out";
          document.querySelector(".inside-menu").style.opacity = "0";
          document.querySelector(".inside-menu").style.transition = "opacity 1.5s ease-in-out";
          isMenuOpen = false;
        } else {
          let bodyWidth = document.querySelector('body').offsetWidth;
          if (bodyWidth <= 775)
            document.querySelector("body").style.gridTemplateColumns = "45% 55%";
          else
            document.querySelector("body").style.gridTemplateColumns = "20% 80%";
          document.querySelector(".menu").style.display = "flex";
          document.querySelector(".menu").style.transition = "2s ease-in";
          document.querySelector("body").style.transition = "2s ease";
          document.querySelector(".menu-icon").style.transform = "rotate(180deg)";
          document.querySelector(".menu-icon").style.transition = "2s ease";
          document.querySelector(".inside-menu").style.opacity = "1";
          document.querySelector(".inside-menu").style.transition = "opacity 1.5s ease-in-out";
          isMenuOpen = true;
        }
      }

      let isMySectionOpen = true;

      function toggleMySection() {
        if (isMenuOpen === true) {
          // alert(`GRK Closing`);
          document.querySelector(".my-section").style.height = "0";
          document.querySelector(".my-section").style.transition = "all 5s ease";
          isMenuOpen = false;
        } else {
          // alert(`GRK Opening`);
          document.querySelector(".menu").style.display = "flex";
          document.querySelector(".menu").style.transition = "2s ease-in";
          document.querySelector("body").style.gridTemplateColumns = "20% 80%";
          document.querySelector("body").style.transition = "2s ease";
          document.querySelector(".menu-icon").style.transform = "rotate(180deg)";
          document.querySelector(".menu-icon").style.transition = "2s ease";
          isMenuOpen = true;
        }
      }
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
    <title>Document</title>
  </head>

  <body>
    <h1>No Data Found</h1>
    <div><a href="..">Go To Home</a></div>
  </body>

  </html>

<?php
}
