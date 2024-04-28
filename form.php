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
            text-align: left; 
        }

        h2 {
            text-align: left;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px; 
            text-align: left; 
        }

        .form-group label {
            display: inline-block;
            width: 30%; 
            text-align: left; 
            padding-right: 10px; 
        
        }

        .form-group input {
            width: 65%; 
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            text-align: left; 
        }

        .error {
            color: #d32f2f;
            font-size: 14px;
            margin-top: 5px; 
            text-align: left; 
        }

        .button-group {
            text-align: left; 
            margin-top: 20px; 
        }

        .button-group input {
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
        }

        input[type="reset"] {
            background-color: #F44336;
            color: white;
        }

        input[type="submit"]:hover {
            background-color: #45A049;
        }

        input[type="reset"]:hover {
            background-color: #D32F2F;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registration Form</h2>
        <form action="submit.php" method="POST">
            <div class="form-group">
                
                <input type="text" id="name" name="name" placeholder="Enter your name" required 
                       value="<?php echo htmlspecialchars($_GET['name'] ?? ''); ?>">
                <?php if (isset($_GET['nameError'])): ?>
                    <div class="error"><?php echo $_GET['nameError']; ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                
                <input type="text" id="surname" name="surname" placeholder="Enter your surname" required 
                       value="<?php echo htmlspecialchars($_GET['surname'] ?? ''); ?>">
                <?php if (isset($_GET['surnameError'])): ?>
                    <div class="error"><?php echo $_GET['surnameError']; ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                
                <input type="text" id="idNumber" name="idNumber" placeholder="Enter your idNumber" required 
                       value="<?php echo htmlspecialchars($_GET['idNumber'] ?? ''); ?>">
                <?php if (isset($_GET['idNumberError'])): ?>
                    <div class="error"><?php echo $_GET['idNumberError']; ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                
                <input type="text" id="dob" name="dob" placeholder="Enter date of birth (dd/mm/YYYY)" required 
                       value="<?php echo htmlspecialchars($_GET['dob'] ?? ''); ?>">
                <?php if (isset($_GET['dobError'])): ?>
                    <div class="error"><?php echo $_GET['dobError']; ?></div>
                <?php endif; ?>
            </div>

            <div class="button-group">
                <input type="submit" value="Submit">
                <input type="reset" value="Clear" onclick="clearForm(this.form)">
            </div>
        </form>
    </div>
</body>
</html>
