<?php
session_start();

// check friend request table's requests

require_once '../CONNECTION/config.php';
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
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Profile</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
        <link rel="shortcut icon" href="../MEDIA/favicon.ico" type="image/x-icon">

        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <div class="listening">
            <div class="mike-animation">
                <strong><i class=" text-light ri-volume-up-line"></i></strong>
            </div>
        </div>
        <div class="New-friend-request">
            <div class="request-data">
                <div class="request-image">
                    <img src="" alt="here is the image" class="image">
                </div>
                <div class="request-info">
                    <div class="requested-profile-name">
                        <h1><span id="requested-friend-name"></span> user has sent you a friend request</h1>
                    </div>
                    <div class="requested-profile-actions">
                        <button type="button" class="accept-btn">Accept</button>
                        <button type="button" class="decline-btn">Decline</button>
                        <button type="button" class="all-requests-btn" onclick='btnClicked(this)' value="5">All Requests</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="product-name">
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

            <button tabindex="0" role="button" class="postNow" id="goSocialBtn"><span class="text-primary"><i
                        class="ri-arrow-up-box-line"></i></span></button>
            <section class="post-section">
                <span class="text-white closePostSection" tabindex="0" role="button">X</span>
                <div class="side-bars left-bar">
                    <div
                        class="left-bar-content inside-side-bar d-flex flex-column align-items-center justify-content-center">
                        <strong><i>USE THIS SOFTWARE TO LET IT GROW,</i></strong>
                        <p><i>NEW UPDATES COMING SOON.......</i></p>
                    </div>
                </div>
                <main class="d-flex align-items-center ">
                    <form id="post-form">
                        <div class="form-field">
                            <label class="col-12 text-center" for="postText">What You Want To Post Socially,</label>
                            <div class="input-section">
                                <textarea id="postText"></textarea>
                                <div class="command" onclick="voiceCommand()">
                                    <span><i class="ri-speak-fill"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-field">
                            <button class="h-10 w-80 post-btn">SEND SOCIAL</button>
                        </div>
                    </form>
                </main>
                <div class="side-bars right-bar">
                    <div
                        class="right-bar-content inside-side-bar d-flex flex-column align-items-center justify-content-center">
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

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="script.js"></script>
        <script>
            function voiceCommand() {
                const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

                if (!SpeechRecognition) {
                    alert("SpeechRecognition is not supported in this browser");
                } else {
                    const r = new SpeechRecognition();
                    r.continuous = false;
                    r.interimResults = false;
                    r.maxAlternatives = 1;


                    r.onstart = function() {
                        $('.listening').toggle('slow');
                        $('.listening').css('display', 'flex');
                    };
                    r.onend = function() {
                        $('.listening').toggle('slow');
                    };


                    r.onresult = async function(event) {
                        const transcript = event.results[0][0].transcript;
                        $('textarea').html(transcript);
                    };

                    r.onerror = function(event) {
                        console.error('Error occurred in recognition: ' + event.error);
                        alert('Error occurred in recognition Please Check Console ');
                        $('.listening').toggle('slow');
                    };

                    r.start();

                }
            }
            // Optional
            document.getElementById('sound-bars').onclick = function() {
                this.classList.toggle('paused');
            }




            $('#postText').on('input', function() {
                if ($('#postText').val().trim() !== "") {
                    $('.post-btn').prop('disabled', false);
                    $('.post-btn').css('opacity', '1');
                    $('.post-btn').css('border', '1px solid green');
                } else {
                    $('.post-btn').prop('disabled', true);
                    $('.post-btn').css('opacity', '0.2');
                    $('.post-btn').css('border', '1px solid red');
                }
            });
            $('.post-btn').on('click', function() {
                if ($('#postText').val().trim() !== "") {
                    $('.post-btn').prop('disabled', false);
                    $('.post-btn').css('opacity', '1');
                    $('.post-btn').css('border', '1px solid green');
                } else {
                    $('.post-btn').prop('disabled', true);
                    $('.post-btn').css('opacity', '0.2');
                    $('.post-btn').css('border', '1px solid red');
                }
            });

            let buttonClicked = null;

            function btnClicked(btn) {

                buttonClicked = btn.value;
                console.log(buttonClicked);

                $.ajax({
                    type: 'post',
                    url: `../GET-CONTENTS/content${buttonClicked}.php`,
                    data: {
                        showAbout: '<?php echo $myId; ?>'
                    },
                    success: function(response) {
                        console.log(response);
                        //  response=JSON.parse(response);
                        $('.get-contents').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: ", error);
                        $.ajax({
                            type: 'POST',
                            url: `../GET-CONTENTS/content${buttonClicked}.php`,
                            data: {
                                showAbout: '<?php echo $myId; ?>',
                                fromMyProfile: true
                            },
                            success: function(response) {
                                console.log(response);
                                $('.get-contents').html(response);
                            },
                            error: function(xhr, status, error) {
                                console.error("AJAX Error: ", error);
                            }
                        });
                    }
                });
            }

            $(document).ready(function() {
                let myFriendId;
                let deleteFriendRequests;

                function hexToAscii(hex) {
                    let str = '';
                    for (let i = 0; i < hex.length; i += 2) {
                        str += String.fromCharCode(parseInt(hex.substr(i, 2), 16));
                    }
                    return str;
                }

                $('#post-form').on("submit", function(event) {
                    event.preventDefault();
                    postMessage = $('#postText').val();
                    let id = <?php echo $_SESSION['myId']; ?>;
                    $.ajax({
                        url: 'updatePost.php',
                        type: 'post',
                        data: {
                            id: <?php echo $_SESSION['myId']; ?>,
                            postValue: postMessage
                        },
                        success: function(response) {
                            response = JSON.parse(response);
                            if (response.success === true) {
                                $('#postText').val("");
                                alert(`Response: ${response.message}`);
                            }
                        },
                        error: function(response) {
                            alert(`Error: ${response}`);
                        }
                    });
                });
                // Checking friend requests
                $.ajax({
                    type: 'get',
                    url: './MY-FRIEND-REQUESTS',
                    data: {
                        myId: <?php echo $_SESSION['myId'] ?>
                    },
                    success: function(response) {
                        response = JSON.parse(response);
                        console.log(deleteFriendRequests);
                        console.log(response);
                        if (response.status == true) {
                            myFriendId = response.requestedData[0].requested_from_id;
                            deleteFriendRequests = response.requestedData[0].id;
                            $(".New-friend-request").fadeIn(1000).css("display", "flex");
                            $("#requested-friend-name").html(response.requestedData[0].userName);
                            const hexString = response.requestedData[0].profile_picture.replace(/^src="/,
                                '');
                            const imagePath = hexToAscii(hexString);
                            $('.request-image > .image').attr('src', imagePath);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('AJAX Error:', textStatus, errorThrown);
                        alert('Something went wrong: ' + textStatus);
                    }
                });

                $('.accept-btn').on('click', function() {
                    // Delete friend request row 
                    function friendRequestAccept() {
                        $.ajax({
                            type: "post",
                            url: './MY-FRIEND-REQUESTS/friendRequestAccept.php',
                            data: {
                                deleteFriendRequests: deleteFriendRequests
                            },
                            success: function(response) {
                                console.log(response);
                            }
                        });
                    }
                    // adding friends
                    $.ajax({
                        type: 'get',
                        url: './MY-FRIENDS',
                        data: {
                            myFriendId: myFriendId
                        },
                        success: function(response) {
                            response = JSON.parse(response);
                            console.log(response);
                            if (response.success == true) {
                                let msg = `<span>${response.message}</span>`;
                                let cross = `<button class="cross">x</button>`;
                                $('.New-friend-request').html(msg);
                                $('.New-friend-request').append(cross);
                                $('.cross').on('click', function() {
                                    $('.New-friend-request').hide();
                                });
                                $('.cross').css({
                                    "margin": "1vh",
                                    "padding": "1vh"
                                });
                                $('.New-friend-request').css({
                                    "height": "fit-content",
                                    "width": "40vw",
                                    "display": "flex",
                                    "align-item": "center",
                                    "justify-content": "space-between",
                                    "background-color": "blue",
                                    "color": "gold",
                                    "border": "2px solid green",
                                    "margin-top": "2vh",
                                    "padding": "2vh"

                                });
                                friendRequestAccept();
                            }
                        }


                    })


                });

                $('.decline-btn').on('click', function() {
                    $.ajax({
                        type: 'post',
                        url: './MY-FRIEND-REQUESTS/friendRequestAccept.php',
                        data: {
                            deleteFriendRequests: deleteFriendRequests
                        },
                        success: function(response) {
                            response = JSON.parse(response)
                            console.log(response);
                            if (response.success == true) {
                                $('.New-friend-request').css("display", "none");
                            }
                        }
                    })
                });

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
        <title>Document</title>
    </head>

    <body>
        <h1>No Data Found</h1>
        <div><a href="..">Go To Home</a></div>
    </body>

    </html>

<?php }
