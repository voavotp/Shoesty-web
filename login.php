<?php
session_start();
include 'php/database.php';
$error = ""; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE Username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['Password'])) {
            // Session variables
            $_SESSION['username'] = $user['Username'];
            $_SESSION['email'] = $user['Email'];
            $_SESSION['Admin'] = ($user['Username'] === 'ShoeAdmin');
            include('../shoesty/cookies.php');

            // code for sending to correct page
            if ($_SESSION['Admin']) {
                header("Location: ../shoesty/adminpage.php"); 
                exit;
            } else {
                header("Location: ../shoesty/index.php"); 
                exit;
            }
        } 
    } else {
        $error = "Incorrect username or password."; 
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="form.css"> 
    <title>Login Form</title>
</head>
<body> 
    <!-- logo -->
    <section>
        <img src="images/name.png" class="logo" width="200">
    </section>
    
    <!-- form for login -->
    <div class="formbox">
        <h1>Login</h1>
        <form method="POST">
            <label>Username</label>
            <input type="text" name="username" required>
            <label>Password</label>
            <input type="password" name="password" required>
            <?php if (!empty($error)): ?>
                <p><?php echo $error; ?></p>
            <?php endif; ?>
            
            <button type="submit">Login</button>
        </form>
        <p>Need an account? <a href="signup.php">Sign up here</a></p>
    </div>
</body>
</html>
