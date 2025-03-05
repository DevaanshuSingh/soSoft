<?php
require_once '../CONNECTION/config.php';

header('Content-Type: application/json'); // Ensures JSON response

try {
    if (!isset($_POST['full_name'], $_POST['user_name'], $_POST['user_password'], $_POST['location'], $_POST['dob'], $_POST['bio'], $_POST['intrests'], $_POST['email']) || !isset($_FILES['image'])) {
        echo json_encode(["status" => "error", "message" => "Required data not provided."]);
        exit;
    }

    $fullName = $_POST['full_name'];
    $userName = $_POST['user_name'];
    $userPassword = $_POST['user_password'];
    $location = $_POST['location'];
    $dob = $_POST['dob'];
    $bio = $_POST['bio'];
    $intrests = $_POST['intrests'];
    $email = $_POST['email'];

    // Check if user already exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        echo json_encode(["status" => "error", "message" => "User already registered."]);
        exit;
    }

    // Handle file upload
    $imagePath = null;
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($fileExt, $allowedExts)) {
            echo json_encode(["status" => "error", "message" => "Invalid file type. Only JPG, JPEG, PNG, and GIF allowed."]);
            exit;
        }

        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $uniqueFileName = uniqid() . '.' . $fileExt;
        $destPath = $uploadDir . $uniqueFileName;

        if (!move_uploaded_file($fileTmpPath, $destPath)) {
            echo json_encode(["status" => "error", "message" => "Error moving the uploaded file."]);
            exit;
        }
        $imagePath = $destPath;
    } else {
        echo json_encode(["status" => "error", "message" => "No file uploaded or upload error."]);
        exit;
    }

    // Get user count for serial number
    $stmt = $pdo->prepare("SELECT COUNT(id) FROM users;");
    $stmt->execute();
    $totalUsersCount = $stmt->fetchColumn();
    $userRegSeriolNo = ++$totalUsersCount;

    // Hash password before storing
    $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);

    // Insert user into database
    $stmt = $pdo->prepare("INSERT INTO users (userRegSeriolNo, fullName, userName, userPassword, bio, location, dob, interests, profile_picture, email) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt->execute([$userRegSeriolNo, $fullName, $userName, $hashedPassword, $bio, $location, $dob, $intrests, $imagePath, $email])) {
        echo json_encode(["status" => "success", "message" => "Registration successful!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Registration failed."]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
}
exit;
