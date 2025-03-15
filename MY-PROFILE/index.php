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
        <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />

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
                <div class="side-bars left-bar">
                    <div class="left-bar-content inside-side-bar">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi, cupiditate voluptates? Natus, vero enim debitis sequi exercitationem earum repellat necessitatibus quibusdam expedita fugiat et mollitia reprehenderit id rerum commodi quisquam voluptatum deleniti voluptas pariatur fugit consequuntur! Laudantium perspiciatis architecto ab culpa inventore illo voluptatem ipsa itaque? Pariatur, necessitatibus aliquid sed cupiditate ducimus exercitationem amet laudantium quos earum. Provident ea dolores dignissimos perferendis assumenda quam voluptatum facere sunt molestiae animi alias itaque est tenetur repellendus autem quis sit blanditiis illo consequatur aspernatur fugit laborum, distinctio dolor! Quasi quis asperiores natus tempore. Provident commodi inventore quam! Recusandae laborum porro inventore impedit fugiat quasi repellendus in modi eos? Ab magnam quae distinctio eveniet! Aliquid temporibus nobis placeat obcaecati, ea rerum soluta rem sequi excepturi nihil in amet cupiditate deserunt! Nesciunt consequatur, quam obcaecati officia soluta necessitatibus sequi illo hic accusantium tenetur, modi cupiditate esse id quos dicta nostrum labore, placeat laudantium dolor doloribus molestiae. Veniam illo vero aspernatur iure deleniti. Ab, et atque. Illum asperiores quod, labore necessitatibus eos aut. Quaerat doloremque ut fuga sed tempora repellat quae neque, voluptate numquam expedita. Sunt in quae neque deserunt tempore adipisci explicabo consectetur optio. Cumque iste error quasi, voluptatibus numquam cum, eius atque iure odit odio obcaecati necessitatibus deleniti modi nemo quaerat, rerum cupiditate tempora quidem? Aut illum dolorem eligendi est saepe! Ex illo dolorem labore nisi dicta quaerat fugiat quia libero perferendis. Animi enim pariatur molestias beatae, dicta consequatur, consectetur nemo hic corporis repellat voluptatibus cumque aliquid? Ad odit animi repudiandae id quo. Deleniti rem nemo quas amet maxime, magnam error, fuga autem nobis, quis placeat laborum ipsam quaerat quasi! Illo sed voluptatibus rerum labore commodi dicta ducimus quia cupiditate repudiandae quis suscipit ad minus facere odio, aliquam temporibus totam soluta quisquam quam debitis animi nam minima! Illum voluptas explicabo eum sed ut expedita earum magnam odit repellendus iste veritatis placeat quae dolore dignissimos velit, aspernatur ratione voluptate! Nulla quia distinctio, ex enim fugiat vitae, doloribus ab commodi nam repudiandae in recusandae, quisquam illo repellat soluta quod ratione nesciunt sint praesentium. Sequi quis, totam exercitationem deleniti sint ab corrupti blanditiis magnam, consequuntur maxime voluptates. Quidem minus voluptatibus iusto, iure aut laudantium enim iste impedit libero necessitatibus voluptatum accusamus, rerum dolores optio, dolorum corrupti quaerat qui eaque. Modi, nihil repellendus temporibus suscipit ratione fugiat veritatis aperiam aliquam. Commodi necessitatibus iusto recusandae accusantium mollitia ut ipsa possimus cupiditate aliquid voluptatibus cum ab quos error placeat quisquam nisi modi asperiores sint eum, beatae doloribus similique. Provident, quos alias iure eaque sint a quisquam libero consequuntur harum asperiores labore facilis ab? Molestias consequuntur in quibusdam accusamus laudantium dolores alias officiis consectetur, quis corrupti minus aperiam nam quas ad, assumenda natus, voluptatem suscipit tenetur porro dolor cum mollitia veniam debitis deserunt? Delectus excepturi hic dolorem laboriosam debitis fugiat ipsa, saepe fugit esse nobis provident possimus cum magni dolores. Debitis cupiditate, assumenda voluptatibus quae corrupti rerum, aperiam praesentium cumque provident eum deserunt? Eius molestiae ut veritatis. Quam obcaecati sunt sit, repellat exercitationem voluptatum eveniet qui, voluptate atque ducimus, consectetur quod?
                    </div>
                </div>
                <main class="d-flex align-items-center"></main>
                <div class="side-bars right-bar">
                    <div class="right-bar-content inside-side-bar">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi, cupiditate voluptates? Natus, vero enim debitis sequi exercitationem earum repellat necessitatibus quibusdam expedita fugiat et mollitia reprehenderit id rerum commodi quisquam voluptatum deleniti voluptas pariatur fugit consequuntur! Laudantium perspiciatis architecto ab culpa inventore illo voluptatem ipsa itaque? Pariatur, necessitatibus aliquid sed cupiditate ducimus exercitationem amet laudantium quos earum. Provident ea dolores dignissimos perferendis assumenda quam voluptatum facere sunt molestiae animi alias itaque est tenetur repellendus autem quis sit blanditiis illo consequatur aspernatur fugit laborum, distinctio dolor! Quasi quis asperiores natus tempore. Provident commodi inventore quam! Recusandae laborum porro inventore impedit fugiat quasi repellendus in modi eos? Ab magnam quae distinctio eveniet! Aliquid temporibus nobis placeat obcaecati, ea rerum soluta rem sequi excepturi nihil in amet cupiditate deserunt! Nesciunt consequatur, quam obcaecati officia soluta necessitatibus sequi illo hic accusantium tenetur, modi cupiditate esse id quos dicta nostrum labore, placeat laudantium dolor doloribus molestiae. Veniam illo vero aspernatur iure deleniti. Ab, et atque. Illum asperiores quod, labore necessitatibus eos aut. Quaerat doloremque ut fuga sed tempora repellat quae neque, voluptate numquam expedita. Sunt in quae neque deserunt tempore adipisci explicabo consectetur optio. Cumque iste error quasi, voluptatibus numquam cum, eius atque iure odit odio obcaecati necessitatibus deleniti modi nemo quaerat, rerum cupiditate tempora quidem? Aut illum dolorem eligendi est saepe! Ex illo dolorem labore nisi dicta quaerat fugiat quia libero perferendis. Animi enim pariatur molestias beatae, dicta consequatur, consectetur nemo hic corporis repellat voluptatibus cumque aliquid? Ad odit animi repudiandae id quo. Deleniti rem nemo quas amet maxime, magnam error, fuga autem nobis, quis placeat laborum ipsam quaerat quasi! Illo sed voluptatibus rerum labore commodi dicta ducimus quia cupiditate repudiandae quis suscipit ad minus facere odio, aliquam temporibus totam soluta quisquam quam debitis animi nam minima! Illum voluptas explicabo eum sed ut expedita earum magnam odit repellendus iste veritatis placeat quae dolore dignissimos velit, aspernatur ratione voluptate! Nulla quia distinctio, ex enim fugiat vitae, doloribus ab commodi nam repudiandae in recusandae, quisquam illo repellat soluta quod ratione nesciunt sint praesentium. Sequi quis, totam exercitationem deleniti sint ab corrupti blanditiis magnam, consequuntur maxime voluptates. Quidem minus voluptatibus iusto, iure aut laudantium enim iste impedit libero necessitatibus voluptatum accusamus, rerum dolores optio, dolorum corrupti quaerat qui eaque. Modi, nihil repellendus temporibus suscipit ratione fugiat veritatis aperiam aliquam. Commodi necessitatibus iusto recusandae accusantium mollitia ut ipsa possimus cupiditate aliquid voluptatibus cum ab quos error placeat quisquam nisi modi asperiores sint eum, beatae doloribus similique. Provident, quos alias iure eaque sint a quisquam libero consequuntur harum asperiores labore facilis ab? Molestias consequuntur in quibusdam accusamus laudantium dolores alias officiis consectetur, quis corrupti minus aperiam nam quas ad, assumenda natus, voluptatem suscipit tenetur porro dolor cum mollitia veniam debitis deserunt? Delectus excepturi hic dolorem laboriosam debitis fugiat ipsa, saepe fugit esse nobis provident possimus cum magni dolores. Debitis cupiditate, assumenda voluptatibus quae corrupti rerum, aperiam praesentium cumque provident eum deserunt? Eius molestiae ut veritatis. Quam obcaecati sunt sit, repellat exercitationem voluptatum eveniet qui, voluptate atque ducimus, consectetur quod?
                    </div>
                </div>
            </section>

            <section class="about-mine m-0 mb-5">
                <div class="infos">
                    <div class="first-col info-cols">
                        <!-- <img src="../MEDIA/c.jpg" alt=""> -->
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
                        echo "<button class='more-me' value='" . $x . "' onclick(this)>" . $feature['featureName'] . "</button>";
                    }
                    ?>
                </div>
            </section>

            <section class="get-contents"></section>
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
