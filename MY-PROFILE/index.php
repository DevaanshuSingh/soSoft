<?php
session_start();

require_once '../CONNECTION/config.php';
// print_r($_GET);
$myId = $_SESSION["myId"];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id =?;");
$stmt->execute([$myId]);
$me = $stmt->fetch(PDO::FETCH_ASSOC);

//Getting Features/Contents;
$stmt = $pdo->prepare("SELECT * FROM myFeatures;");
$stmt->execute([]);
$allFeatures = $stmt->fetchAll(PDO::ATTR_AUTOCOMMIT);

$_SESSION['myId'] = $myId;
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
        <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
        <link rel="shortcut icon" href="../MEDIA/favicon.ico" type="image/x-icon">

        <link rel="stylesheet" href="style.css">
    </head>

    <body>

        <div class="product-name">
            <!-- <button class="goToMain btn btn-info" data-user-id="<?php echo  $myId; ?>">View Socity</button> -->
            <button class="goToMain btn btn-info">View Socity</button>
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
                <div class="side-bars left-bar">
                    <div class="left-bar-content inside-side-bar d-flex flex-column align-items-center justify-content-center">
                        <strong><i>USE THIS SOFTWARE TO LET IT GROW,</i></strong>
                        <p><i>NEW UPDATES COMING SOON.......</i></p>
                    </div>
                </div>
                <main class="d-flex align-items-center ">
                    <form id="post-form">
                        <div class="form-field">
                            <label for="postText">Enter POST Content</label>
                            <input type="textbox" id="postText">
                        </div>
                        <div class="form-field">
                            <button>SEND SOCIAL</button>
                        </div>
                    </form>
                </main>
                <div class="side-bars right-bar">
                    <div class="right-bar-content inside-side-bar d-flex flex-column align-items-center justify-content-center">
                        <strong><i>USE THIS SOFTWARE TO LET IT GROW,</i></strong>
                        <p><i>NEW UPDATES COMING SOON.......</i></p>
                    </div>
                </div>
            </section>

            <section class="about-mine m-0 mb-5">
                <div class="infos">
                    <div class="first-col info-cols">
                        <img src="<?php echo $me['profile_picture']; ?>" alt="">
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
                        if ($feature['featureName'] == "Be Friends")
                            continue;
                        echo "<button class='more-me' value='" . $x . "' onclick='btnClicked(this)'>" . $feature['featureName'] . "</button>";
                    }
                    ?>
                </div>
            </section>

            <section class="get-contents mt-5"></section>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="script.js"></script>
        <script>
            let selectedUsers = null;
            document.querySelectorAll("header .btn").forEach(button => {
                button.addEventListener("click", function() {
                    selectedUsers = this.value;
                    // alert("Button Clicked "+selectedUsers);
                    $.ajax({
                        type: 'POST',
                        url: 'get-info.php',
                        data: {
                            user: selectedUsers
                        },
                        success: function(response) {
                            $('table tbody').html("Response Is: " + response);
                            $('#myTable').DataTable();
                        }
                    });
                });
            });

            let buttonClicked = null;

            function btnClicked(btn) {

                buttonClicked = btn.value;
                console.log(buttonClicked);

                $.ajax({
                    type: 'POST',
                    url: `../GET-CONTENTS/content${buttonClicked}.php`,
                    data: {
                        showAbout: '<?php echo $myId;?>'
                    },
                    success: function(response) {
                        $('.get-contents').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: ", error);
                    }
                });
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

<?php }
