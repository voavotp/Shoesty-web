<?php
session_start();
include 'database.php';

header('Content-Type: application/json');

$search = isset($_GET['query']) ? trim($_GET['query']) : '';
$autocomplete = isset($_GET['autocomplete']) ? $_GET['autocomplete'] : false;

if (!empty($search)) {
    $keywords = preg_split('/\s+/', $search);
    $searchwords = [];
    $params = [];

// search works with variables from model, name and brand
    foreach ($keywords as $keyword) {
        $searchwords[] = "(Model LIKE ? OR Name LIKE ? OR Brand LIKE ?)";
        $params[] = '%' . $keyword . '%';
        $params[] = '%' . $keyword . '%';
        $params[] = '%' . $keyword . '%';
    }

    $shoevariable = implode(' AND ', $searchwords);

    $fields = $autocomplete 
        ? "Model, Name, Brand"
        : "Model, Name, Brand, Image, Price, Email";

    $sql = "SELECT $fields FROM shoes WHERE $shoevariable LIMIT 5";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(str_repeat('s', count($params)), ...$params);
    $stmt->execute();
    $result = $stmt->get_result();

    $shoedata = [];
    while ($row = $result->fetch_assoc()) {
        // autocomplete, drop down shoe display
        if ($autocomplete) {
            $shoedata[] = [
                'Model' => $row['Model'],
                'Name' => $row['Name'],
                'Brand' => $row['Brand'],
                'display' => $row['Model'] . ' ' . $row['Name'] . ' ' . $row['Brand']
            ];
        } else {
            $shoedata[] = [
                'Model' => $row['Model'],
                'Name' => $row['Name'],
                'Brand' => $row['Brand'],
                'Image' => $row['Image'],
                'Price' => $row['Price'],
                'Email' => $row['Email'],
                'display' => $row['Model'] . ' ' . $row['Name'] . ' ' . $row['Brand']
            ];
        }
    }

    echo json_encode($shoedata);
} else {
    echo json_encode([]);
}
