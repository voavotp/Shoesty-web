<?php
session_start();
include 'database.php';  

if (!isset($_SESSION['username'])) {
    header("Location: login.php");  
    exit;
}

$shoeID = $_GET['id'];  

// admin check
if (isset($_SESSION['Admin']) && $_SESSION['Admin'] === true) {
    $stmt = $conn->prepare("DELETE FROM shoes WHERE ShoeID = ?");
    $stmt->bind_param("i", $shoeID);
} else {
    // If the user is not an admin, they can only delete shoes they have added
    $email = $_SESSION['email'];  
    $stmt = $conn->prepare("DELETE FROM shoes WHERE ShoeID = ? AND Email = ?");
    $stmt->bind_param("is", $shoeID, $email); 
}
// send user to correct page
if ($stmt->execute()) {
    if (isset($_SESSION['Admin']) && $_SESSION['Admin'] === true) {
        header("Location: ../adminpage.php");
    } else {
        header("Location: ../userpage.php");
    }
    exit;
} else {
    echo "Error deleting shoe.";
}
$stmt->close();
?>
