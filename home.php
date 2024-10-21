<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id'])) {
    header("location:login.php");
    exit();
}

$id = $_SESSION['id'];
$query = mysqli_query($koneksi, "SELECT * FROM user_detail WHERE id=$id");
$user = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
        }
        a {
            display: inline-block;
            margin: 1rem 0;
            color: #1877f2;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        h3 {
            margin-top: 2rem;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 0.5rem;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Selamat Datang, <?php echo htmlspecialchars($user['user_fullname']); ?></h2>
        <p>Email: <?php echo htmlspecialchars($user['user_email']); ?></p>
        <p>Level: <?php echo htmlspecialchars($user['level']); ?></p>
        <a href="edit.php">Edit Profile</a>
        <?php if ($user['level'] == 1): ?>
            <h3>User List</h3>
            <table>
                <tr>
                    <th>No</th>
                    <th>Email</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
                <?php
                $users = mysqli_query($koneksi, "SELECT * FROM user_detail");
                while($row = mysqli_fetch_assoc($users)):
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['user_email']); ?></td>
                    <td><?php echo htmlspecialchars($row['user_fullname']); ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                        <a href="hapus.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda Yakin?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
