<?php

require_once __DIR__ . '/vendor/autoload.php';
use MongoDB\Client as MongoClient;

$mongoClient = new MongoClient("mongodb://localhost:27017");
$collection = $mongoClient->my_database_name->users;

$errors = [];
$formData = [];

// Capture form data
$formData['name'] = $_POST['name'] ?? '';
$formData['surname'] = $_POST['surname'] ?? '';
$formData['idNumber'] = $_POST['idNumber'] ?? '';
$formData['dob'] = $_POST['dob'] ?? '';

// Validations
if (!preg_match('/^[a-zA-Z ]+$/', $formData['name'])) {
    $errors['nameError'] = "Name can only contain letters and spaces.";
}

if (!preg_match('/^[a-zA-Z ]+$/', $formData['surname'])) {
    $errors['surnameError'] = "Surname can only contain letters and spaces.";
}

if (!is_numeric($formData['idNumber']) || strlen($formData['idNumber']) !== 13) {
    $errors['idNumberError'] = "ID Number must be a 13-digit numeric value.";
}

$dobDateTime = DateTime::createFromFormat('d/m/Y', $formData['dob']);
if (!$dobDateTime || $dobDateTime->format('d/m/Y') !== $formData['dob']) {
    $errors['dobError'] = "Date of Birth must be in the format dd/mm/YYYY.";
}

// duplicate ID numbers
if ($collection->countDocuments(['idNumber' => $formData['idNumber']]) > 0) {
    $errors['idNumberError'] = "Duplicate ID Number found.";
}

// If there are errors, redirect back to the form with the errors
if (!empty($errors)) {
    $redirectParams = array_merge($errors, $formData);
    header('Location: form.php?' . http_build_query($redirectParams));
    exit;
}

// If no errors, insert into MongoDB 
$formattedDob = $dobDateTime->format('Y-m-d');
$collection->insertOne([
    'name' => $formData['name'],
    'surname' => $formData['surname'],
    'idNumber' => $formData['idNumber'],
    'dob' => $formattedDob,
]);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submission Successful</title>
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

        .success-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            padding: 30px;
            width: 450px;
            text-align: center;
        }

        .success-icon {
            font-size: 40px;
            color: #4CAF50; 
            margin-bottom: 20px;
        }

        .success-message {
            font-size: 20px;
            color: #333;
            margin-bottom: 30px;
        }

        .success-button {
            padding: 12px 24px;
            font-size: 18px;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            text-align: center;
            transition: background-color 0.3s;
        }

        .success-button:hover {
            background-color: #45A049;
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="success-icon">&#x2714; <!-- Check mark symbol for success --></div>
        <div class="success-message">Registration successful! Your information has been stored.</div>
        <button class="success-button" onclick="window.location.href='form.php'">Return to Form</button>
    </div>
</body>
</html>
