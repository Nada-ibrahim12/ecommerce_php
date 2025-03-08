<?php
include 'db.php';

if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];

    if ($action === 'approve') {
        $stmt = $conn->prepare("UPDATE users SET approved = 1 WHERE id = ?");
    } elseif ($action === 'decline' || $action === 'delete') {
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    } else {
        echo "error";
        exit;
    }

    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "error";
}
