<?php
session_start();
if (!isset($_SESSION['username']) && !isset($_COOKIE['username'])) {
    header("Location: login.php");
    exit;
}
$username = isset($_SESSION['username']) ? $_SESSION['username'] : $_COOKIE['username'];
// if the user logs in for the first time it will display a welcome message, if not it is a returninng message
if (!isset($_SESSION['first_login'])) {
    $_SESSION['first_login'] = true;
    $greeting = "Welcome, " .($username) . "!";
} else {
    $greeting = "Welcome back, " .($username) . "!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Main Page</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="style.css"> 
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
    <script src="../shoesty/js/script.js"></script>
</head>
  <body>
      <!-- nav bar simplicity -->
      <?php
      $title = 'nav';
      $page = 'Main';
      include('../shoesty/php/nav.php');
      ?>
      <!-- main text area -->
      <div class="page">
          <h1><?php echo $greeting; ?></h1>
          <h2>What is Shoesty for?</h2>
          <h3>Shoesty is a marketplace where users can list their shoes for sale and connect directly with buyers through email to negotiate prices and discuss details privately. 
            With a wide selection of shoes and an easy-to-use platform, Shoesty makes buying and selling footwear simple and secure.</h3>
          <h1>Search Shoes</h1>
          <div id="searchbox">
              <input type="text" id="search" placeholder="Search for a shoe...">
              <button id="searchbutton">
                  <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#0a0a0a">
                      <path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/>
                  </svg>
              </button>
          </div>
          <div id="showresult"></div>
      </div>

      <div class="page">
        <h3>Listings are current offers from users.</h3>
      </div>  
      <!-- footer simplicity -->
      <section class="footer">
          <?php
          $title = 'footer';
          $page = 'Main';
          include('../shoesty/php/footer.php');
          ?>
      </section>
  </body>
</html>