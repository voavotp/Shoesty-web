<?php
session_start();
include 'php/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE Username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // verify account, set sesssion to username then allow user into site
        if (password_verify($password, $user['Password'])) {
            $_SESSION['username'] = $user['Username'];
            header("Location: index.php");
            exit;
        } else {
            echo "Invalid username or password.";
        }
    } 
}
?>
