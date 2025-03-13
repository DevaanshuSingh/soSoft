<?php
require_once '../CONNECTION/config.php';
// print_r($_GET);
$myId = $_GET['loggedPersonId'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id =?;");
$stmt->execute([$myId]);
$me = $stmt->fetch();

//Getting Features/Contents;
$stmt = $pdo->prepare("SELECT * FROM myFeatures;");
$stmt->execute([]);
$allFeatures = $stmt->fetchAll(PDO::ATTR_AUTOCOMMIT);


if ($me) {
    // print_r($me);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Profile</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
    </head>

    <body>

        <div class="product-name">
            <button class="goToMain btn btn-info" data-user-id="<?php echo  $_GET['loggedPersonId']; ?>">View Socity</button>
            <div class="software-name">CNAT's SoSOFT</div>
        </div>

        <div class="main-container">
            <div class="full-image">
                <div class="cross-part text-white position-absolute">
                    <h1>X</h1>
                </div>
                <img src="" alt="">
            </div>

            <button tabindex="0" role="button" class="postNow" id="goSocialBtn">Go Social</button>

            <section class="post-section">
                <span class="text-white closePostSection" tabindex="0" role="button">X</span>
                <div class="side-bars left-bar"></div>
                <main class="d-flex align-items-center"></main>
                <div class="side-bars right-bar"></div>
            </section>

            <section class="about-mine m-0">
                <div class="infos">
                    <div class="first-col info-cols">
                        <img src=".<?php echo $me['profile_picture']; ?>" alt="">
                    </div>
                    <div class="second-col info-cols">
                        <div class="full-name name">
                            <header>Full Name</header>
                            <main><span><?php echo $me['fullName']; ?></span></main>
                        </div>

                        <div class="bio name">
                            <header>Bio</header>
                            <main><span><?php echo $me['bio']; ?></span></main>
                        </div>
                    </div>
                </div>
                <div class="contents">
                    <?php
                    $x = 0;
                    foreach ($allFeatures as $feature) {
                        ++$x;
                        echo "<button class='more-me' value='" . $x . "'>" . $feature['featureName'] . "</button>";
                    }
                    ?>
                </div>
            </section>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
