<?php
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="reading-section">
        <div class="about">
            <div class="inner-content">
                <div class="texts">
                    <img src="../MEDIA/codernaccotax.png" alt="CNAT_LOGO">
                    <strong class="special-keys">CNAT(CODERNACCOTAX)</strong> Presents First Ever
                    Social_Software!!<br>Here You Can Connect
                    With People Easily, After Connecting You
                    Can Share Your Experience, Daily_Routine, Intrests, Things You Love, You Want Anything. <strong
                        class="special-keys">YES
                        ANYTHING</strong>, And Even Without Being Connected Can Messeage Any Person <strong
                        class="special-keys"><i>5 TIMES.</i></strong> Early Morning Or LAte Night OR Even Mid Of Day You
                    Can Chat With People <strong class="special-keys">Anytime</strong>, <strong
                        class="special-keys">Anywhere</strong>. It Does Not Limits You To Talk That You Are Inside Or
                    Outiside Of Home. Here You Can Post Your Pictures, Expressions In Texts, Emojis Are Also Available
                    Here. Another's Post Which You Like Can Express Your Feelings By Commenting Them Or Sending Them A
                    Heart Or Many_More Options Are Here,
                </div>
            </div>
        </div>
        <div class="login-heading">
            <h1>
                <span><strong>LOGIN HERE:</strong></span>
                <div class="face">
                    O&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;O
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--
                    &nbsp;&nbsp;
                </div>
            </h1>
        </div>
    </div>
    <div class="container">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="inputs">
                <div class="single">
                    <label for="full-name" class="form-label">Enter Full Name</label>
                    <input type="text" class="form-control" id="full-name" name="full-name" required>
                </div>
                <div class="single">
                    <label for="password" class="form-label">Enter Password</label>
                    <input type="password" class="form-control" id="password" name="user-password" required>
                </div>
                <div class="single">
                    <label for="email" class="form-label">Enter Email</label>
                    <input type="email" class="form-control" id="email" name="user-email" required>
                </div>
            </div>
            <div class="button">
                <button type="submit" class="btn">Login</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script>
        function wrongInput() {
            document.querySelector('.login-heading h1').innerHTML = "<span><strong>LOGIN HERE:</strong></span><div class='face'>o&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;o<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0&nbsp;&nbsp;</div>";
            document.querySelector('.face').style.transition = "all 2s ease";
            document.querySelector('.face').style.border = "none";
            document.querySelector('.face').style.backgroundColor = "rgba(255, 0, 0, 0.25)";
            document.querySelector('.face').style.borderRadius = "20%";
        }

        function correctInput() {
            document.querySelector('.login-heading h1').innerHTML = "<span><strong>LOGIN HERE:</strong></span><div class='face'>O&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;O<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;</div>";
            alert("Welcome");
        }
    </script>
</body>

</html>

<?php
require_once '../CONNECTION/config.php';

try {
    if (isset($_POST['full-name'], $_POST['user-password'], $_POST['user-email'])) {
        $fullName = $_POST['full-name'];
        $userPassword = $_POST['user-password'];
        $email = $_POST['user-email'];

        $stmt = $pdo->prepare("SELECT * FROM users WHERE fullName=? AND email=?;");
        $stmt->execute([$fullName, $email]);
        $userInfo = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userInfo && password_verify($userPassword, $userInfo['userPassword'])) {
            $_SESSION["myId"] = $userInfo['id'];
            $userIdForJS = htmlspecialchars($userInfo['id'], ENT_QUOTES, 'UTF-8');
?>
            <script>
                localStorage.setItem('rememberMyID', "<?php echo $userIdForJS; ?>");
                correctInput();
                if (localStorage.getItem('rememberMyID')) {
                    let rememberedId = localStorage.getItem('rememberMyID');

                    fetch('set-session.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: 'myId=' + encodeURIComponent(rememberedId)
                    }).then(() => {
                        window.location.href = '../MY-PROFILE';
                    });
                }
            </script>
<?php
        } else {
            echo "<script>wrongInput();</script>";
        }
    }
} catch (PDOException $e) {
    echo "Error While Registering:<br>" . $e->getMessage();
}
