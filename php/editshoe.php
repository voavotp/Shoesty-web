<?php
session_start();
include 'database.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../shoesty/login.php");
    exit;
}

if (!isset($_GET['id'])) {
    echo "Shoe not found.";
    exit;
}

// code for getting shoe information
$shoeID = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM shoes WHERE ShoeID = ?");
$stmt->bind_param("i", $shoeID);
$stmt->execute();
$shoe = $stmt->get_result()->fetch_assoc();
$stmt->close();

// updatable variables
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $model = $_POST['model'];
    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'] ? $_FILES['image']['name'] : $shoe['Image'];

    // code for new image in existing shoe
    if ($_FILES['image']['name']) {
        $imagename = basename($_FILES['image']['name']); 
        $selectfile = "images/" . $imagename; 

        if (!move_uploaded_file($_FILES['image']['tmp_name'], "../" . $selectfile)) {
            echo "Error uploading image.";
            exit;
        }
        $image = $selectfile;
    }

    // database changes
    $stmt = $conn->prepare("UPDATE shoes SET Model = ?, Name = ?, Brand = ?, Price = ?, Image = ? WHERE ShoeID = ?");
    $stmt->bind_param("sssssi", $model, $name, $brand, $price, $image, $shoeID);

    // send user to correct page
    if ($stmt->execute()) {
        if (isset($_SESSION['Admin']) && $_SESSION['Admin'] === true) {
            header("Location: ../adminpage.php"); 
        } else {
            header("Location: ../userpage.php"); 
        }
        exit;
    } else {
        echo "Error updating shoe.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../form.css">
    <title>Edit Shoe</title>
</head>
<body>
    <!-- logo -->
    <section>
        <img src="../images/name.png" class="logo" width="200">
    </section>
    <!-- form edit -->
    <div class="formbox">
        <h1>Edit Shoe</h1>
        <form method="POST" enctype="multipart/form-data">
            <label>Model:</label>
            <input type="text" name="model" value="<?php echo htmlentities($shoe['Model']); ?>" required><br>

            <label>Name:</label>
            <input type="text" name="name" value="<?php echo htmlentities($shoe['Name']); ?>" required><br>

            <label>Brand:</label>
            <input type="text" name="brand" value="<?php echo htmlentities($shoe['Brand']); ?>" required><br>

            <label>Price:</label>
            <input type="text" name="price" value="<?php echo htmlentities($shoe['Price']); ?>" required><br>

            <label>Image:</label>
            <input type="file" name="image"><br>

            <button type="submit">Update Shoe</button>
        </form>
    </div>
</body>
</html>
