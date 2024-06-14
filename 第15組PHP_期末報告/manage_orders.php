<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>處理訂單</title>
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
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 20px;
        }
        form select, form input[type="submit"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <!-- 返回管理員頁面按鈕 -->
    <div style="text-align: center; margin-bottom: 20px;">
        <a href="admin.php">返回管理員頁面</a>
<div class="container">
    <h1>處理訂單</h1>

    <?php
$servername = "sql313.infinityfree.com";
$username = "if0_36681160";
$password = "phpyonex007";
$dbname = "if0_36681160_badminton_store";

    

    // 创建连接
    $conn = new mysqli($servername, $username, $password, $dbname);

    // 检查连接
    if ($conn->connect_error) {
        die("連接失敗: " . $conn->connect_error);
    }

    $conn->set_charset("utf8mb4");

    // 更新订单状态
    if (isset($_POST['update_order_status'])) {
        $order_id = $_POST['order_id'];
        $order_status = $_POST['order_status'];
        $sql = "UPDATE orders SET order_status='$order_status' WHERE id=$order_id";
        if ($conn->query($sql) === TRUE) {
            echo "<p>訂單狀態更新成功</p>";
        } else {
            echo "<p>錯誤: " . $sql . "<br>" . $conn->error . "</p>";
        }
    }

    // 获取所有订单
    $sql = "SELECT * FROM orders";
    $result = $conn->query($sql);
    ?>

    <h2>訂單列表</h2>
    <table>
        <tr>
            <th>訂單ID</th>
            <th>用户ID</th>
            <th>總金額</th>
            <th>訂單狀態</th>
            <th>付款方式</th>
            <th>配送地址</th>
            <th>創建時間</th>
            <th>操作</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['user_id'] . "</td>";
                echo "<td>" . $row['total_amount'] . "</td>";
                echo "<td>" . $row['order_status'] . "</td>";
                echo "<td>" . $row['payment_method'] . "</td>";
                echo "<td>" . $row['shipping_address'] . "</td>";
                echo "<td>" . $row['created_at'] . "</td>";
                echo "<td>";
                echo "<form action='manage_orders.php' method='POST'>";
                echo "<input type='hidden' name='order_id' value='" . $row['id'] . "'>";
                echo "<select name='order_status'>";
                echo "<option value='Pending'" . ($row['order_status'] == 'Pending' ? ' selected' : '') . ">待处理</option>";
                echo "<option value='Processing'" . ($row['order_status'] == 'Processing' ? ' selected' : '') . ">处理中</option>";
                echo "<option value='Completed'" . ($row['order_status'] == 'Completed' ? ' selected' : '') . ">已完成</option>";
                echo "<option value='Cancelled'" . ($row['order_status'] == 'Cancelled' ? ' selected' : '') . ">已取消</option>";
                echo "</select>";
                echo "<input type='submit' name='update_order_status' value='更新狀態'>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>没有訂單</td></tr>";
        }
        ?>
    </table>
</div>

<?php
$conn->close();
?>

</body>
</html>
