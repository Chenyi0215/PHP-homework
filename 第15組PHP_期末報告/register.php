<?php
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
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "注冊成功";
        header('Location: login.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>注册</title>
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
        <h2>注册</h2>
        <form method="post" action="register.php">
            <label for="username">用户名:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">密碼:</label>
            <input type="password" id="password" name="password" required>
            <label for="email">電子郵件:</label>
            <input type="email" id="email" name="email" required>
            <input type="submit" value="注册">
        </form>
        <p>已有賬號？<a href="login.php">登入</a></p>
    </div>
</body>
</html>
