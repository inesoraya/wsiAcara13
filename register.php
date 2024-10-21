<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $fullname = $_POST['fullname'];
    $level = 2; 
    
    
    $check_level = mysqli_query($koneksi, "SELECT * FROM level_detail WHERE id_level = $level");
    if (mysqli_num_rows($check_level) == 0) {
        $error = "Invalid user level";
    } else {
        $query = mysqli_query($koneksi, "INSERT INTO user_detail (user_email, user_password, user_fullname, level) VALUES ('$email', '$password', '$fullname', $level)");
        
        if ($query) {
            header("location:login.php");
            exit();
        } else {
            $error = "Registrasi gagal: " . mysqli_error($koneksi);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #74b9ff, #a29bfe);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .register-container {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h2 {
            text-align: center;
            color: #1877f2;
        }
        .error {
            color: red;
            text-align: center;
            margin-bottom: 1rem;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 0.5rem;
        }
        input[type="email"],
        input[type="password"],
        input[type="text"] {
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #1877f2;
            color: white;
            padding: 0.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #166fe5;
        }
        .login-link {
            text-align: center;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <?php if(isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        <form method="post" action="">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <label for="fullname">Nama Lengkap:</label>
            <input type="text" id="fullname" name="fullname" required>
            
            <input type="submit" value="Register">
        </form>
        <p class="login-link">Sudah Memiliki Akun? <a href="login.php">Login</a></p>
    </div>
</body>
</html>
