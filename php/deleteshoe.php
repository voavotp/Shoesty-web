<?php
session_start();
include 'database.php';  // Adjust the path if necessary

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");  // Redirect to login page if not logged in
    exit;
}

$shoeID = $_GET['id'];  // Get the shoe ID from the URL

// If the user is an admin, they can delete any shoe
if (isset($_SESSION['Admin']) && $_SESSION['Admin'] === true) {
    // Admin can delete any shoe
    $stmt = $conn->prepare("DELETE FROM shoes WHERE ShoeID = ?");
    $stmt->bind_param("i", $shoeID);
} else {
    // If the user is not an admin, they can only delete shoes they have added
    $email = $_SESSION['email'];  // Get the email from session
    $stmt = $conn->prepare("DELETE FROM shoes WHERE ShoeID = ? AND Email = ?");
    $stmt->bind_param("is", $shoeID, $email);  // Bind both ShoeID and Email to the query
}

if ($stmt->execute()) {
    // Redirect to the appropriate page based on the user type
    if (isset($_SESSION['Admin']) && $_SESSION['Admin'] === true) {
        // If admin, redirect to the admin page
        header("Location: ../adminpage.php");
    } else {
        // If regular user, redirect to the user page
        header("Location: ../userpage.php");
    }
    exit;
} else {
    // Error handling
    echo "Error deleting shoe.";
}
$stmt->close();
?>
