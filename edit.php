<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id'])) {
    header("location:login.php");
    exit();
}

$id = isset($_GET['id']) ? $_GET['id'] : $_SESSION['id'];
$query = mysqli_query($koneksi, "SELECT * FROM user_detail WHERE id=$id");
$user = mysqli_fetch_assoc($query);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $level = $_POST['level'];
    
    $update = mysqli_query($koneksi, "UPDATE user_detail SET user_email='$email', user_fullname='$fullname', level=$level WHERE id=$id");
    
    if ($update) {
        header("location:home.php");
        exit();
    } else {
        $error = "Update gagal";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #74b9ff, #a29bfe);
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 2rem;
        }
        .container {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        h2 {
            color: #1877f2;
        }
        p {
            margin: 0.5rem 0;
            color: red;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        label {
            margin: 0.5rem 0;
        }
        input, select {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #1877f2;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        a {
            margin-top: 1rem;
            color: #1877f2;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Profile</h2>
        <?php if(isset($error)) { echo "<p>$error</p>"; } ?>
        <form method="post" action="">
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['user_email']); ?>" required>
            <label>Nama Lengkap:</label>
            <input type="text" name="fullname" value="<?php echo htmlspecialchars($user['user_fullname']); ?>" required>
            <label>Level:</label>
            <select name="level">
                <option value="1" <?php if($user['level'] == 1) echo 'selected'; ?>>Admin</option>
                <option value="2" <?php if($user['level'] == 2) echo 'selected'; ?>>User</option>
            </select>
            <input type="submit" value="Update">
        </form>
        <a href="home.php">Back to Home</a>
    </div>
</body>
</html>
