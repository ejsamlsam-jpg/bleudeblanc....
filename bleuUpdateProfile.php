<?php
// bleuUpdateProfile.php - Save profile changes securely
session_start();
include "bleuConnection.php";

if (!isset($_SESSION['username'])) {
    header("Location: bleuLogin.php");
    exit();
}

$message_type = '';
$message_text = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $contact = trim($_POST['contact'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $birthday = trim($_POST['birthday'] ?? '');

    // Validation
    $errors = [];
    
    if (empty($username)) {
        $errors[] = 'Username is required.';
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Valid email is required.';
    }
    
    // Check if username already exists (excluding current user)
    if ($username !== $_SESSION['username']) {
        $check_stmt = $bleuConn->prepare("SELECT id FROM users WHERE username = ? AND username != ?");
        $check_stmt->bind_param("ss", $username, $_SESSION['username']);
        $check_stmt->execute();
        if ($check_stmt->get_result()->num_rows > 0) {
            $errors[] = 'Username already taken.';
        }
    }

    if (!empty($contact) && !preg_match('/^[\+]?[0-9\s\-\(\)]{10,15}$/', $contact)) {
        $errors[] = 'Invalid contact number format.';
    }

    if (!empty($errors)) {
        $message_type = 'error';
        $message_text = implode(' ', $errors);
    } else {
        // Update profile
        $stmt = $bleuConn->prepare("UPDATE users SET username = ?, email = ?, contact = ?, address = ?, birthday = ? WHERE username = ?");
        $stmt->bind_param("ssssss", $username, $email, $contact, $address, $birthday, $_SESSION['username']);
        
        if ($stmt->execute()) {
            $_SESSION['username'] = $username; // Update session
            $message_type = 'success';
            $message_text = 'Profile updated successfully!';
        } else {
            $message_type = 'error';
            $message_text = 'Failed to update profile. Please try again.';
        }
    }
}

// Redirect back with message
header("Location: bleuProfile.php?" . http_build_query([
    'message_type' => $message_type,
    'message_text' => urlencode($message_text)
]));
exit();
?>
