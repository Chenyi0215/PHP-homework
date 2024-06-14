<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 数据库连接
    $servername = "sql313.infinityfree.com";
    $username = "if0_36681160";
    $password = "phpyonex007";
    $dbname = "if0_36681160_badminton_store";
    
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("連接失敗: " . $conn->connect_error);
    }

    $conn->set_charset("utf8mb4");

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id, username, password FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header('Location: index.php');
            exit();
        } else {
            echo "密碼錯誤";
        }
    } else {
        echo "用戶不存在";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登入</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        h2 {
            text-align: center;
        }
        form {
            max-width: 300px;
            margin: 0 auto;
        }
        label, input {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #555;
        }
        p {
            text-align: center;
        }
        a {
            color: #333;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>登入</h2>
        <form method="post" action="login.php">
            <label for="username">用户名:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">密碼:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="登入">
        </form>
        <p>还没賬號？<a href="register.php">注冊</a></p>
    </div>
</body>
</html>

