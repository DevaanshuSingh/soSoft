<?php
$userId=0;
if ($_POST['showAbout']) {
    $userId=$_POST['showAbout'];
}
else{
    echo "Please Select User";
    die();
}

require_once '../CONNECTION/config.php';

$stmt = $pdo->prepare("SELECT * FROM users WHERE id =?;");
$stmt->execute([$userId]);
$about = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<div class="about-container">
<h2 class="about-title">🌼 About 🌼</h2>';

foreach ($about as $user) {
    echo '<div class="about-user">
        <div class="about-user-flex">
            <img src="' . $user["profile_picture"] . '" alt="Profile Picture" class="about-user-image">
            <div>
                <h3 class="about-user-name">👤 Name : ' . $user["fullName"] . '</h3>
                <p>📧 Email : ' . $user["email"] . '</p>
                <p>🎂 Birth Date : ' . $user["dob"] . '</p>
                <p>📍 Location : ' . $user["location"] . '</p>
                <p>📚 Interests : ' . $user["interests"] . '</p>
            </div>
        </div>
    </div>';
}
echo '</div>';
