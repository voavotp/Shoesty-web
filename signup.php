<?php
session_start();
include 'php/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);


    // Check if username or email already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE Username = ? OR Email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "An account with that Username or email already exists.";
    } else {
        //  save the user
        $stmt = $conn->prepare("INSERT INTO users (Name, Surname, Username, Password, Email) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $surname, $username, $password, $email);

        if ($stmt->execute()) {
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            setcookie("username", $_SESSION['username'], time() + 2000, "/", "", true, true);


            header("Location: index.php");
            exit;
        } else {
            echo "Error: Could not create account.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="form.css">
    <title>Sign Up</title>
</head>
<body>
<!-- logo -->
<section>
        <img src="images/name.png" class="logo" width="200">
    </section>
<!-- form for signup-->
    <div class="formbox">
        <h1>Sign Up</h1>
        <form method="POST" action="">
            <label>Name</label>
            <input type="text" name="name" required>
            
            <label>Surname</label>
            <input type="text" name="surname" required>
            
            <label>Email</label> 
            <input type="email" name="email" required> 
            
            <label>Username</label>
            <input type="text" name="username" required>
            
            <label>Password</label>
            <input type="password" name="password" required>
            
            <button type="submit">Sign Up</button>
        </form>
        
        <!-- Link to Sign In Page -->
        <p>Have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
