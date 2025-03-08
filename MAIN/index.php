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
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  </head>

  <body>
    <div class="product-name"><strong class="text-primary">CNAT's SOSOFT</strong></div>

    <div class="menu">
      <div class="menu-button">
        <i id="menuToggler" onclick="toggleMenu()" class="ri-arrow-right-circle-line menu-icon"></i>
      </div>

      <div class="inside-menu">
        <div class="menu-heading">Codernaccotax</div>
        <div class="menu-body"></div>
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
                echo "<div class='user-profile'>
                      <div class='user-profile-pic'> <img src='." . $user['profile_picture'] . "' alt='" . $user['userName'] . "'> </div>
                      <div class='user-profile-name'><strong>" . $user['userName'] . "</strong></div>
                  </div>";
                // print_r($user);
              }
            } catch (PDOException $e) {
              echo "Error While Registering:<br>" . $e->getMessage();
            }
            ?>
          </div>
        </div>

        <div class="my-section">Self_Section</div>

        <div class="content m-1">
          <div class="post">
            <div class="main-post">
              <span>
                <!-- <img src="../MEDIA/codernaccotax.png"> -->
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Odit incidunt quas eligendi aliquid architecto explicabo voluptatum inventore nobis ipsa magnam enim, amet perferendis, similique veniam consequuntur qui facere numquam natus. Animi aperiam pariatur ad soluta autem veritatis earum deleniti, nihil ipsum aspernatur id voluptas ratione in quas itaque! Illum, culpa? Eos eius provident molestiae dignissimos et animi aperiam dolorem suscipit quo quas! Placeat, nihil cupiditate aperiam impedit delectus mollitia modi odio asperiores a fugiat voluptate dolore obcaecati? Maxime dolore temporibus iure quod laborum quae voluptatum corrupti harum recusandae. Asperiores a corporis eligendi perferendis repellendus ipsam commodi rerum quasi. Reprehenderit minus culpa impedit atque alias reiciendis quaerat voluptates praesentium similique eligendi totam, temporibus, corporis ipsam nisi nulla voluptas nesciunt vitae porro ipsa ratione cum nostrum facilis itaque quas. Quia dolorum aliquid eius molestiae nemo accusamus atque totam similique alias perspiciatis, modi quis rerum eos sit odit, esse sint vero tempore repellat. Cupiditate necessitatibus neque illum pariatur dicta ducimus ex itaque sed maxime quisquam animi similique sint debitis nisi tempore unde explicabo, harum mollitia. Deleniti deserunt dicta error explicabo assumenda itaque reprehenderit optio in inventore accusamus ad, provident pariatur molestiae molestias voluptas fuga veritatis voluptates cum, repellendus eius. Impedit tenetur quod architecto perferendis amet, voluptate veritatis maxime consectetur maiores explicabo nisi, quisquam temporibus tempore optio ipsa itaque qui. Quaerat ea ipsum vero totam quia veniam debitis inventore blanditiis architecto esse asperiores accusamus dolores dolore nesciunt, reprehenderit molestiae aspernatur voluptatem aliquid maiores consectetur repudiandae explicabo dolorum laudantium eum. Voluptas nisi, repellendus nostrum aut eligendi debitis, inventore, deleniti eum consequuntur voluptate quia dignissimos corporis veritatis hic! Ratione repudiandae laborum maxime! Quidem fugit repellendus porro voluptatibus veritatis, atque accusantium, nisi consectetur ullam dolorum odio. Odio accusamus fugiat eos aut maiores, molestias harum quod at sint aliquid nesciunt necessitatibus ducimus maxime culpa ipsum vitae consequatur velit error cum aspernatur. Non expedita dolorem velit porro magnam officia perferendis maiores odio recusandae ullam, laborum minima explicabo, alias assumenda culpa. Sed asperiores dolorem quisquam ipsum corrupti nostrum debitis exercitationem ipsam nulla, non a minus quod sequi libero laudantium. Iure blanditiis beatae ipsam eum animi neque quae magnam obcaecati, accusantium laudantium rerum excepturi unde eaque corrupti aperiam dignissimos? Facilis enim assumenda nesciunt. Incidunt, esse sit cupiditate ipsum cum minima ducimus deserunt voluptas veniam? Dolor porro fugit amet, aperiam labore distinctio perspiciatis nam magnam consectetur! Perspiciatis veniam quas quaerat rerum ex! Minus deleniti aut quisquam facere perspiciatis alias harum deserunt eos reprehenderit esse tempore consequatur dignissimos quia maxime omnis quod, quidem in dolorem! Nemo quibusdam officiis laudantium numquam dolor tempore quos. Tenetur nulla placeat eaque iusto reprehenderit numquam obcaecati inventore, ut consequuntur nemo aut dolores consectetur deserunt ex pariatur ullam. Dicta consequatur modi repudiandae? Dolore, quaerat ut odio aut alias officiis? Maxime, nulla. Totam, ducimus ut ipsum debitis consequuntur omnis et ipsa atque, voluptatibus inventore culpa numquam illum sint? Dolorum molestias tempora quo sint sit perferendis, ex explicabo in ab exercitationem quia. Eveniet, natus tenetur! Ab explicabo in impedit minus necessitatibus sit aspernatur minima quaerat totam placeat similique quisquam corporis, ad esse alias illum pariatur. Perspiciatis consectetur fugit ea obcaecati cum, eligendi nisi numquam labore quo autem animi eveniet vero, quam reiciendis? Architecto labore doloremque maiores necessitatibus, sapiente vel voluptatum voluptatibus provident id cum laudantium tempora? Voluptas voluptatibus corporis, aliquam harum eum commodi. Aliquam nisi, facere molestias atque, quasi exercitationem recusandae temporibus ab nihil ea voluptate. Voluptate commodi debitis, repellendus, voluptatem odit enim voluptates sapiente natus minima atque cupiditate eos! Rem nihil expedita quidem dolores, ipsam corporis id explicabo, sint quis est dignissimos distinctio mollitia itaque. Ab illo totam ex repudiandae mollitia dolorum quidem illum fugiat soluta maiores quis atque laborum, ratione quos doloremque ullam, aut dolore odit modi suscipit provident sed! Quos incidunt sit culpa, aut, tenetur sint molestias voluptates iure suscipit cupiditate illum ipsa id quis ad eum pariatur magni doloremque assumenda sequi earum excepturi asperiores aperiam similique sapiente? Nisi eveniet officia minus sed vel unde repudiandae mollitia quibusdam autem a! Quaerat aperiam nisi possimus consequuntur, earum tempore. Et, omnis perspiciatis laboriosam quaerat odit eum animi consequuntur amet consequatur molestias porro fugit quidem recusandae perferendis quia ipsa. Fugiat, impedit nam totam illo amet voluptas, provident pariatur eum eaque voluptatibus nostrum doloribus veritatis ullam soluta sequi repudiandae autem natus error quisquam, omnis velit quas obcaecati hic laudantium! Ipsam ducimus consequuntur autem fuga laudantium quam labore dignissimos iure et. Repellendus molestias reiciendis consequuntur, omnis fugiat, impedit velit quo nemo ratione sit nulla sequi? Commodi accusantium amet incidunt id delectus vitae quasi voluptatibus eius deleniti necessitatibus, dicta esse autem pariatur nemo dolores officia, molestiae, possimus at placeat voluptas? Natus quas nisi dolorem iusto! Rerum corrupti rem repellat esse neque, harum at illum sit autem perferendis nemo nihil vel quae enim a tempore similique delectus obcaecati iure accusantium! Corporis quo et laboriosam natus fugiat quasi deleniti itaque eos nam assumenda culpa, placeat modi.
              </span>
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
        </div>
        <div class="content m-1">
          <div class="post">
            <div class="main-post">
              <span>
                <img src="../MEDIA/codernaccotax.png">
              </span>
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
        </div>

      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="script.js"></script>
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
