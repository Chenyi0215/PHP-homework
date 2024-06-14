<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

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

$user_id = $_SESSION['user_id'];

// 获取用户信息
$sql_user = "SELECT username, email FROM users WHERE id = $user_id";
$result_user = $conn->query($sql_user);
$user = $result_user->fetch_assoc();

// 获取用户订单
$sql_orders = "SELECT * FROM orders WHERE user_id = $user_id ORDER BY created_at DESC";
$result_orders = $conn->query($sql_orders);

// 获取用户地址
$sql_addresses = "SELECT * FROM addresses WHERE user_id = $user_id";
$result_addresses = $conn->query($sql_addresses);

// 更新用户信息
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_info'])) {
    $new_email = $_POST['email'];
    $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql_update = "UPDATE users SET email = '$new_email', password = '$new_password' WHERE id = $user_id";
    if ($conn->query($sql_update) === TRUE) {
        echo "個人信息更新成功";
        header('Location: account.php');
        exit();
    } else {
        echo "更新失敗: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>我的賬號</title>
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
        h1, h2 {
            text-align: center;
        }
        .section {
            margin-bottom: 20px;
        }
        .section table {
            width: 100%;
            border-collapse: collapse;
        }
        .section table, .section th, .section td {
            border: 1px solid #ddd;
        }
        .section th, .section td {
            padding: 10px;
            text-align: left;
        }
        .section th {
            background-color: #f2f2f2;
        }
        form {
            max-width: 500px;
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
    </style>
</head>
<body>
    <div class="container">
        <h1>我的賬號</h1>
        
        <!-- 用户信息 -->
        <div class="section">
            <h2>個人信息</h2>
            <p>用戶名: <?php echo $user['username']; ?></p>
            <p>電子郵件: <?php echo $user['email']; ?></p>
            <form method="post" action="account.php">
                <label for="email">新的電子郵件:</label>
                <input type="email" id="email" name="email" required>
                <label for="password">新的密碼:</label>
                <input type="password" id="password" name="password" required>
                <input type="submit" name="update_info" value="更新信息">
            </form>
        </div>

        <!-- 订单历史 -->
        <div class="section">
            <h2>歷史訂單</h2>
            <?php if ($result_orders->num_rows > 0) { ?>
                <table>
                    <tr>
                        <th>訂單號</th>
                        <th>總金額</th>
                        <th>狀態</th>
                        <th>支付方式</th>
                        <th>收货地址</th>
                        <th>下單時間</th>
                    </tr>
                    <?php while ($order = $result_orders->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $order['id']; ?></td>
                            <td>TWD <?php echo $order['total_amount']; ?></td>
                            <td><?php echo $order['order_status']; ?></td>
                            <td><?php echo $order['payment_method']; ?></td>
                            <td><?php echo $order['shipping_address']; ?></td>
                            <td><?php echo $order['created_at']; ?></td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } else { ?>
                <p>暫無訂單記錄。</p>
            <?php } ?>
        </div>

        <div class="section">
            <h2>收貨地址</h2>
            <?php if ($result_addresses->num_rows > 0) { ?>
                <table>
                    <tr>
                        <th>地址</th>
                        <th>城市</th>
                        <th>區</th>
                        <th>邮编</th>
                        <th>國家</th>
                    </tr>
                    <?php while ($address = $result_addresses->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $address['address']; ?></td>
                            <td><?php echo $address['city']; ?></td>
                            <td><?php echo $address['state']; ?></td>
                            <td><?php echo $address['postal_code']; ?></td>
                            <td><?php echo $address['country']; ?></td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } else { ?>
                <p>暫無收貨地址。</p>
            <?php } ?>
        </div>
        <div class="back-to-home">
        <a href="index.php">返回首頁</a>
    </div>

<?php
$conn->close();
?>
</body>
</html>
