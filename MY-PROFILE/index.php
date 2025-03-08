<?php
require_once '../CONNECTION/config.php';

$myId = $_GET['loggedPersonId'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id =?;");
$stmt->execute([$myId]);
$me = $stmt->fetch();
if ($me) {
    // print_r($me);

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
    </head>

    <body>

        <div class="product-name">CNAT's SoSOFT</div>
        <div class="main-container">
            <section class="about-mine">
                <div class="infos">
                    <div class="first-col info-cols">
                        <img src="../MEDIA/codernaccotax.png" alt="">
                    </div>
                    <div class="second-col info-cols">
                        <div class="short-name name">
                            <header>Short Name</header>
                            <main><span><?php echo $me['userName']; ?></span></main>
                        </div>
                        <div class="full-name name">
                            <header>Full Name</header>
                            <main><span><?php echo $me['fullName']; ?></span></main>
                        </div>
                    </div>
                </div>
                <div class="contents">
                    <button class="more-me">POSTS</button>
                    <button class="more-me">ABOUT</button>
                    <button class="more-me">PHOTOS</button>
                </div>
            </section>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
