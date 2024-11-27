<?php
session_start();
include 'database.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../shoesty/login.php");
    exit;
}
// neccessary variables
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $model = $_POST['model'];
    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];
    $email = $_SESSION['email'];
    $image = $_FILES['image']['name'];
    $filelocation = "../images/"; 
    $selectfile = $filelocation . basename($image);

    $imageFileType = strtolower(pathinfo($selectfile, PATHINFO_EXTENSION));
    $allowedimage = array('jpg', 'jpeg', 'png');
// code for saving image correctly
    if (in_array($imageFileType, $allowedimage)) {
        if (!is_dir($filelocation) || !is_writable($filelocation)) {
            die("Error: The 'images' directory doesn't exist or is not writable.");
        }
        if (move_uploaded_file($_FILES['image']['tmp_name'], $selectfile)) {
            $image_path = "images/" . basename($image);

            $stmt = $conn->prepare("INSERT INTO shoes (Model, Name, Brand, Price, Email, Image) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $model, $name, $brand, $price, $email, $image_path);
// send user to correct page
            if ($stmt->execute()) {
                if (isset($_SESSION['Admin']) && $_SESSION['Admin'] === true) {
                    header("Location: ../adminpage.php");
                } else {
                    header("Location: ../userpage.php");
                }
                exit;
            } else {
                echo "Error adding shoe.";
            }
            $stmt->close();
        } 
    } 

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../form.css"> 
    <title>Add New Shoe</title>
</head>
<body>
<div class="formbox">
    <h1>Add New Shoe</h1>
    <form method="POST" action="addshoe.php" enctype="multipart/form-data">
        <label>Model</label>
        <input type="text" name="model" required><br>

        <label>Name</label>
        <input type="text" name="name" required><br>

        <label>Brand</label>
        <input type="text" name="brand" required><br>

        <label>Price</label>
        <input type="text" name="price" required><br>

        <label>Image</label>
        <input type="file" name="image" required><br>

        <button type="submit">Add Shoe</button>
    </form>
</div>
</body>
</html>
