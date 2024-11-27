<?php
session_start();
include 'php/database.php';

if (!isset($_SESSION['username']) && !isset($_COOKIE['username'])) {
    header("Location: login.php");
    exit;
}

$username = isset($_SESSION['username']) ? $_SESSION['username'] : $_COOKIE['username'];

// Default sort option and order
$sort_option = isset($_GET['sort']) ? $_GET['sort'] : 'name';
$sort_order = isset($_GET['order']) && $_GET['order'] === 'desc' ? 'desc' : 'asc';  // Default to ascending

if ($sort_order === 'asc') {
    $next_sort_order = 'desc';
} else {
    $next_sort_order = 'asc';
}

// Fetch shoes from the database
$query = "SELECT * FROM shoes";
if ($sort_option === 'price') {
    $query .= " ORDER BY Price $sort_order";  // Sorting by price
} else {
    $query .= " ORDER BY Name $sort_order";   // Sorting alphabetically by name
}

$result = $conn->query($query);
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

    <!-- Sorting Controls -->
    <div class="sort">
        <a href="shoes.php?sort=name&order=<?= $next_sort_order ?>" class="sortbutton">
            Sort Alphabetically 
            <?php echo $sort_order === 'asc' ? 'A-Z' : 'Z-A'; ?>
        </a>

        <a href="shoes.php?sort=price&order=<?= $next_sort_order ?>" class="sortbutton">
            Sort by Price 
            <?php echo $sort_order === 'asc' ? 'Low to High' : 'High to Low'; ?>
        </a>
    </div>

    <!-- Displaying Shoes -->
    <div id="showresult">
        <?php if (count($shoes) > 0): ?>
            <?php foreach ($shoes as $shoe): ?>
                <?php include 'php/shoebox.php'; ?> <!-- Include shoebox template -->
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
