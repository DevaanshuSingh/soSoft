<?php
if (isset($_COOKIE['selectedUserId'])) {
    require_once '../CONNECTION/config.php';

    $userId = $_COOKIE['selectedUserId'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id =?;");
    $stmt->execute([$userId]);
    $user = $stmt->fetchAll(PDO::ATTR_AUTOCOMMIT);

    //Getting Features/Contents;
    $stmt = $pdo->prepare("SELECT * FROM myFeatures;");
    $stmt->execute([]);
    $allFeatures = $stmt->fetchAll(PDO::ATTR_AUTOCOMMIT);

    if ($user) {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <userta charset="UTF-8">
                <userta nauser="viewport" content="width=device-width, initial-scale=1.0">
                    <title>User Profile</title>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
                    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
                    <link rel="preconnect" href="https://fonts.googleapis.com">
                    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,394;1,394&family=Tagesschrift&family=Tektur:wght@400..900&display=swap" rel="stylesheet">
                    <link rel="stylesheet" href="style.css">
        </head>

        <body>
            <div class="product-name">
                <button class="goToMain btn btn-info">View Socity</button>
                <div class="software-name">CNAT's SoSOFT</div>
            </div>
            <div class="main-container ">
                <div class="full-image">
                    <div class="cross-part text-white position-absolute">
                        <h1>X</h1>
                    </div>
                    <img src="" alt="">
                </div>

                <section class="about-user mb-5">
                    <div class="infos">
                        <div class="first-col info-cols">
                            <img src="<?php
                                        echo $user[0]['profile_picture'];
                                        ?>" alt="">
                        </div>
                        <div class="second-col info-cols">
                            <div class="full-name name">
                                <header>Full Name</header>
                                <main><span><?php
                                            echo $user[0]['fullName'];
                                            ?></span></main>
                            </div>

                            <div class="bio name">
                                <header>Bio</header>
                                <main><span><?php
                                            echo $user[0]['bio'];
                                            ?></span></main>
                            </div>
                        </div>
                    </div>
                    <div class="contents">
                        <?php
                        $x = 0;
                        foreach ($allFeatures as $feature) {
                            ++$x;
                            if ($feature['featureName'] == "Be Friends") {
                                // echo "<button class='more-me be-friend-btn' value='" . $x . "' onclick='btnClicked(this)'>" . $feature['featureName'] . "</button>";
                                echo "<button class='more-me be-friend-btn' value='" . $x . "' onclick='btnClicked(this)'>" . $feature['featureName'] . "</button>";
                            } else {
                                echo "<button class='more-me' value='" . $x . "' onclick='btnClicked(this)'>" . $feature['featureName'] . "</button>";
                            }
                        }
                        ?>
                    </div>
                </section>
            
                <section class="get-contents ">
                    <div class="allposts"> </div>
                </section>
            </div>
            <button type="hidden" class="btn btn-primary d-none" id="liveToastBtn">Show live toast</button>

            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="false" data-bs-autohide="false">
                    <div class="toast-header bg-transparent">
                        <strong class="me-auto text-danger">SUCCESSFULL</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        Friend Request Sent Successfully
                    </div>
                </div>
            </div>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.2.0/crypto-js.min.js"></script>
            <script src="script.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
            <script>
                let buttonClicked = null;

                function reqSuccess(msg) {
                    let toast = new bootstrap.Toast(document.getElementById('liveToast'));
                    toast.show();
                }

                function beFriends() {
                    $.ajax({
                        type: 'GET',
                        url: '../BE-FRIENDS',
                        success: function(response) {
                            console.log(response);
                            response = JSON.parse(response);
                            if (response.success === true) {
                                reqSuccess(response.message);
                            }
                            else{
                                alert(response);
                            }
                        },
                        error: function() {
                            alert(error());
                        }
                    });
                }

                $(".product-name .goToMain").on("click", function() {
                    location.href = "../MAIN";
                });
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

                $(document).ready(function() {
                    $(".first-col img").on("click", function() {
                        let imageSrc = $(this).attr("src");
                        $(".full-image img").attr("src", imageSrc);
                        $(".full-image").css("display", "flex").hide().fadeIn(500);
                    })
                });

                $(".cross-part").on("click", function() {
                    $(".full-image").fadeOut(500, function() {
                        $(this).css("display", "none");
                        $(".full-image img").attr("src", "");
                    });
                });

                function btnClicked(btn) {
                    buttonClicked = btn.value;
                    console.log(buttonClicked);
                    if (buttonClicked == 4) {
                        beFriends();
                    }

                    $.ajax({
                        type: 'POST',
                        url: `../GET-CONTENTS/content${buttonClicked}.php`,
                        data: {
                            showAbout: '<?php echo $userId; ?>',
                        },
                        success: function(response) {
                            $('.get-contents').html(response);
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX Error: ", error);
                        }
                    });

                    return;
                }
            </script>

        </body>

        </html>

        </script>
        </body>

        </html>
    <?php
    } else {
    ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <userta charset="UTF-8">
                <userta nauser="viewport" content="width=device-width, initial-scale=1.0">
                    <title>ERROR</title>
        </head>

        <body>
            <h1>No Data Found</h1>
            <div><a href="..">Go To House</a></div>
        </body>

        </html>

    <?php
    }
} else {
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <userta charset="UTF-8">
            <userta nauser="viewport" content="width=device-width, initial-scale=1.0">
                <title>User Not Found</title>
    </head>

    <body>
        <h1>No User Found</h1>
        <div><a href="..">Go To House</a></div>
    </body>

    </html>
<?php
    print_r($_COOKIE);
}
