<?php
session_start();
include 'php/database.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../shoesty/login.php");
    exit;
}

$email = $_SESSION['email'];
$stmt = $conn->prepare("SELECT * FROM shoes WHERE Email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="table.css">
    <title>User Dashboard</title>
</head>
<body>
    <!-- nav bar simplicity -->
    <?php
        $title = 'nav';
        $page = 'Main';
        include('../shoesty/php/nav.php');
    ?>

    <div class="page">
        <h1><?php echo ($_SESSION['username']); ?>'s Shoe Listings</h1>
    </div>

    <!-- table -->
    <table>
        <tr>
            <th>Model</th>
            <th>Name</th>
            <th>Price</th>
            <th>Brand</th>
            <th>Image</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <!-- table results -->
        <?php
        if ($result->num_rows > 0) {
            while ($shoe = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo($shoe['Model']); ?></td>
                    <td><?php echo ($shoe['Name']); ?></td>
                    <td>€<?php echo ($shoe['Price']); ?></td>
                    <td><?php echo ($shoe['Brand']); ?></td>
                    <td><img src="<?php echo ($shoe['Image']) ?>" alt="Shoe Image Error"></td>
                    <td>
                        <a href="../shoesty/php/editshoe.php?id=<?php echo ($shoe['ShoeID']); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#0a0a0a">
                                <path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/>
                            </svg>
                        </a>
                    </td>
                    <td>
                        <a href="../shoesty/php/deleteshoe.php?id=<?php echo ($shoe['ShoeID']); ?>" onclick="return confirm('Are you sure you want to delete this shoe?');">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#0a0a0a">
                                <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/>
                            </svg>
                        </a>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='7'>You have not listed any shoes yet</td></tr>";
        }
        ?>
    </table>

    <!-- buttons outside table -->
    <section class="page">
        <button class="sortbutton" onclick="window.location.href='../shoesty/php/addshoe.php'">Create New Shoe</button>
        <button class="sortbutton" onclick="window.location.href='../shoesty/logout.php'">Logout</button>
    </section>
    <br>

    <!-- footer simplicity -->
    <section class="footer">
        <?php
            $title = 'footer';
            $page = 'Account';
            include('../shoesty/php/footer.php');
        ?>
    </section>
</body>
</html>
