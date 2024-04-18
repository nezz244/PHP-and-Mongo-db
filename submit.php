<?php

require_once __DIR__ . '/vendor/autoload.php';
use MongoDB\Client as MongoClient;

// MongoDB configuration
$mongoClient = new MongoClient("mongodb://localhost:27017");
$collection = $mongoClient->my_database_name->users;

// Define variables to hold error messages
$errors = [];

// Retrieve form data
$name = $_POST['name'] ?? '';
$surname = $_POST['surname'] ?? '';
$idNumber = $_POST['idNumber'] ?? '';
$dob = $_POST['dob'] ?? '';

// Validation
if (!preg_match('/^[a-zA-Z ]+$/', $name)) {
    $errors[] = "Name can only contain letters and spaces.";
}

if (!preg_match('/^[a-zA-Z ]+$/', $surname)) {
    $errors[] = "Surname can only contain letters and spaces.";
}

if (!is_numeric($idNumber) || strlen($idNumber) !== 13) {
    $errors[] = "ID Number must be a 13-digit numeric value.";
}

$dobDateTime = DateTime::createFromFormat('d/m/Y', $dob);
if (!$dobDateTime || $dobDateTime->format('d/m/Y') !== $dob) {
    $errors[] = "Date of Birth must be in the format dd/mm/YYYY.";
}

// Check for duplicate ID Number
$count = $collection->countDocuments(['idNumber' => $idNumber]);
if ($count > 0) {
    $errors[] = "Duplicate ID Number found. Please input your information again.";
}

if (empty($errors)) {
    // Format date as dd/mm/yyyy
    $formattedDob = $dobDateTime->format('d/m/Y');

    // Insert record into MongoDB
    $result = $collection->insertOne([
        'name' => $name,
        'surname' => $surname,
        'idNumber' => $idNumber,
        'dob' => $formattedDob
    ]);
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo empty($errors) ? "Record Inserted Successfully" : "Form Errors"; ?></title>
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

        .message {
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            margin-bottom: 20px;
        }

        .success {
            background-color: #4caf50;
            color: #fff;
        }

        .error {
            background-color: #f44336;
            color: #fff;
        }
    </style>
</head>
<body>
    <?php if (empty($errors)): ?>
        <div class="message success">
            <h2>Record inserted successfully!</h2>
        </div>
    <?php else: ?>
        <div class="message error">
            <?php foreach ($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</body>
</html>
