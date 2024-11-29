<?php
session_start();
include 'php/database.php';

if (!isset($_SESSION['username']) && !isset($_COOKIE['username'])) {
    header("Location: login.php");
    exit;
}

$username = isset($_SESSION['username']) ? $_SESSION['username'] : $_COOKIE['username'];

// sorting
$pricesort = isset($_GET['sort']) ? $_GET['sort'] : 'name';
$sortingUpDown = isset($_GET['order']) && $_GET['order'] === 'desc' ? 'desc' : 'asc'; 

if ($sortingUpDown === 'asc') {
    $nextoder = 'desc';
} else {
    $nextoder = 'asc';
}

// fetch shoes
$getshoes = "SELECT * FROM shoes";
if ($pricesort === 'price') {
    $getshoes .= " ORDER BY Price $sortingUpDown";  
} else {
    $getshoes .= " ORDER BY Name $sortingUpDown";  
}

$result = $conn->query($getshoes);
$shoes = [];
while ($row = $result->fetch_assoc()) {
    $shoes[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shoes</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
  $title = 'Shoes';
  $page = 'Shoes';
  include_once('php/nav.php');
?>

<div class="page">
    <h1>Browse All Shoes</h1>

    <!-- sorting boxes -->
    <div class="sort">
        <a href="shoes.php?sort=name&order=<?= $nextoder ?>" class="sortbutton">
            Sort Alphabetically 
            <?php echo $sortingUpDown === 'asc' ? 'A-Z' : 'Z-A'; ?>
        </a>

        <a href="shoes.php?sort=price&order=<?= $nextoder ?>" class="sortbutton">
            Sort by Price 
            <?php echo $sortingUpDown === 'asc' ? 'Low to High' : 'High to Low'; ?>
        </a>
    </div>

    <!-- shoeboxes -->
    <div id="showresult">
        <?php if (count($shoes) > 0): ?>
            <?php foreach ($shoes as $shoe): ?>
                <?php include 'php/shoebox.php'; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No shoes available.</p>
        <?php endif; ?>
    </div>
</div>

<section class="footer">
  <footer>
  <?php
    $title = 'footer';
    $page = 'Shoes';
    include_once('php/footer.php');
  ?>
</footer>
</section>
</body>
</html>
