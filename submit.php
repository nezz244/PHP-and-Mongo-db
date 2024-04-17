<?php

require_once __DIR__ . '/vendor/autoload.php';
use MongoDB\Client as MongoClient;
// MongoDB configuration
$mongoClient = new MongoClient("mongodb://localhost:27017");
$collection = $mongoClient->my_database_name->users;

// Retrieve form data
$name = $_POST['name'];
$surname = $_POST['surname'];
$idNumber = $_POST['idNumber'];
$dob = $_POST['dob'];

// Validation
if (!is_numeric($idNumber) || strlen($idNumber) !== 13) {
    die("ID Number must be a 13-digit numeric value.");
}

$dobDateTime = DateTime::createFromFormat('d/m/Y', $dob);
if (!$dobDateTime || $dobDateTime->format('d/m/Y') !== $dob) {
    die("Date of Birth must be in the format dd/mm/YYYY.");
}

// Check for duplicate ID Number
$count = $collection->countDocuments(['idNumber' => $idNumber]);
if ($count > 0) {
    die("Duplicate ID Number found. Please input your information again.");
}

// Format date as dd/mm/yyyy
$formattedDob = $dobDateTime->format('d/m/Y');

// Insert record into MongoDB
$result = $collection->insertOne([
    'name' => $name,
    'surname' => $surname,
    'idNumber' => $idNumber,
    'dob' => $formattedDob
]);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Inserted Successfully</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .success-message {
            background-color: #4caf50;
            color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="success-message">
        <h2>Record inserted successfully!</h2>
    </div>
</body>
</html>
