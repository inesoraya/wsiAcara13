<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    
    $query = mysqli_query($koneksi, "SELECT * FROM user_detail WHERE user_email='$email' AND user_password='$password'");
    $cek = mysqli_num_rows($query);
    
    if ($cek > 0) {
        $data = mysqli_fetch_assoc($query);
        $_SESSION['id'] = $data['id'];
        $_SESSION['email'] = $email;
        $_SESSION['level'] = $data['level'];
        header("location:home.php");
    } else {
        $error = "Email atau password salah";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        .login-container {
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
        input[type="password"] {
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
        .register-link {
            text-align: center;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if(isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        <form method="post" action="">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <input type="submit" value="Login">
        </form>
        <p class="register-link">Belum punya akun? <a href="register.php">Daftar disini</a></p>
    </div>
</body>
</html>
