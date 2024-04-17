<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
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

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 400px;
        }

        h2 {
            margin-top: 0;
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #666;
        }

        input[type="text"],
        input[type="date"],
        input[type="submit"],
        input[type="reset"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="submit"],
        input[type="reset"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #45a049;
        }

        input[type="reset"] {
            background-color: #f44336;
        }

        input[type="reset"]:hover {
            background-color: #d32f2f;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }

        .form-group::after {
            content: "";
            display: table;
            clear: both;
        }

        .form-group label,
        .form-group input {
            float: left;
        }

        .form-group input {
            width: 70%;
        }

        .form-group label {
            width: 30%;
            text-align: right;
            padding-right: 10px;
            line-height: 32px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registration Form</h2>
        <form action="submit.php" method="POST">
            <div class="form-group">
                <input type="text" id="name" name="name" placeholder="Enter your name" required>
            </div>

            <div class="form-group">
                <input type="text" id="surname" name="surname" placeholder="Enter your surname" required>
            </div>

            <div class="form-group">
                <input type="text" id="idNumber" name="idNumber" placeholder="Enter your ID number" required>
            </div>

            <div class="form-group">
                <input type="text" id="dob" name="dob" placeholder="Enter date of birth (dd/mm/YYYY)" pattern="\d{2}/\d{2}/\d{4}" required>
            </div>

            <input type="submit" value="Submit">
            <input type="reset" value="Clear">
        </form>
    </div>
</body>
</html>
