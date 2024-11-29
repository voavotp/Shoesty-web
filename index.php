<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';

if (!isset($_SESSION['username']) && !isset($_COOKIE['username'])) {
    header("Location: login.php");
    exit;  
}
// for cookies
$username = isset($_SESSION['username']) ? $_SESSION['username'] : $_COOKIE['username'];

//greeting user
if (!isset($_SESSION['firstlogin'])) {
    $_SESSION['firstlogin'] = true;
    $greetings = "Welcome, $username!";  
} else {
    $greetings = "Welcome back, $username!";
}

// twig load
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');  
$twig = new \Twig\Environment($loader, [
    'debug' => true, 
]);

echo $twig->render('index.html.twig', [
    'title' => 'Main Page',  
    'greeting' => $greetings,
]);
