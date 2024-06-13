<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理員登入</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
        }
        form {
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        p {
            text-align: center;
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>管理員登入</h1>
    <form action="admin_login.php" method="POST">
        <label for="username">用户名:</label>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="password">密碼:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <input type="submit" value="登入">
    </form>

    <?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

        $sql = "SELECT id, password FROM admins WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $hashed_password);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                $_SESSION['admin_id'] = $id;
                header("Location: admin.php");
            } else {
                echo "<p>密碼錯誤</p>";
            }
        } else {
            echo "<p>用戶不存在</p>";
        }

        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>
