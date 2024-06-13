<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理員管理頁面</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            color: #333;
        }
        h1, h2 {
            text-align: center;
            color: #555;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .links {
            text-align: center;
            margin-top: 30px;
        }
        .links h2 {
            margin-bottom: 10px;
            color: #555;
        }
        .links a {
            display: inline-block;
            padding: 12px 24px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin: 0 15px;
            transition: background-color 0.3s;
        }
        .links a:hover {
            background-color: #45a049;
        }
        .return-home {
            text-align: center;
            margin-top: 20px;
        }
        .return-home a {
            color: #333;
            text-decoration: none;
            border-bottom: 2px solid #4CAF50;
            transition: border-bottom 0.3s;
        }
        .return-home a:hover {
            border-bottom: 2px solid #45a049;
        }
    </style>
</head>
<body>

<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$servername = "sql313.infinityfree.com";
$username = "if0_36681160";
$password = "phpyonex007";
$dbname = "if0_36681160_badminton_store";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("連接失敗: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

// 获取最新订单
$sql_orders = "SELECT * FROM orders ORDER BY created_at DESC LIMIT 10";
$result_orders = $conn->query($sql_orders);

?>

<div class="container">
    <h1>管理員管理頁面</h1>

    <h2>最新訂單</h2>
    <table>
        <tr>
            <th>訂單ID</th>
            <th>用户ID</th>
            <th>總金額</th>
            <th>訂單狀態</th>
            <th>支付方式</th>
            <th>收貨地址</th>
            <th>創建時間</th>
        </tr>
        <?php
        if ($result_orders->num_rows > 0) {
            while ($row = $result_orders->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['user_id'] . "</td>";
                echo "<td>" . $row['total_amount'] . "</td>";
                echo "<td>" . $row['order_status'] . "</td>";
                echo "<td>" . $row['payment_method'] . "</td>";
                echo "<td>" . $row['shipping_address'] . "</td>";
                echo "<td>" . $row['created_at'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>沒有訂單</td></tr>";
        }
        ?>
    </table>

    <!-- 銷售報告、管理產品和訂單處理連結 -->
    <div class="links">
        <h2>銷售報告</h2>
        <a href="sales_report.php">查看銷售報告</a>
        <h2>管理產品信息</h2>
        <a href="manage_products.php">管理產品</a>
        <h2>處理訂單</h2>
        <a href="manage_orders.php">處理訂單</a>
    </div>
</div>

<?php
$conn->close();
?>

<div class="return-home">
    <a href="index.php">返回首頁</a>
</div>

</body>
</html>
