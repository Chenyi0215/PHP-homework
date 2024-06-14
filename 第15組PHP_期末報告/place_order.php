<?php
session_start();

// 检查用户是否已登录
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
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

// 获取用户ID
$user_id = $_SESSION['user_id'];

// 获取购物车内容
$cart_items = [];
$total_price = 0;

$sql_cart = "SELECT cart_items.*, products.price 
             FROM cart_items 
             JOIN products ON cart_items.product_id = products.id 
             WHERE cart_items.user_id = $user_id";
$result_cart = $conn->query($sql_cart);

if ($result_cart->num_rows > 0) {
    while ($row = $result_cart->fetch_assoc()) {
        $cart_items[] = $row;
        $total_price += $row['price'] * $row['quantity'];
    }
} else {
    echo "您的購物車是空的。";
    exit();
}

// 获取表单数据
$name = isset($_POST['name']) ? $conn->real_escape_string($_POST['name']) : '';
$address = isset($_POST['address']) ? $conn->real_escape_string($_POST['address']) : '';
$payment_method = isset($_POST['payment_method']) ? $conn->real_escape_string($_POST['payment_method']) : '';

// 插入订单数据
$sql_order = "INSERT INTO orders (user_id, total_amount, order_status, payment_method, shipping_address)
              VALUES ('$user_id', '$total_price', 'Pending', '$payment_method', '$address')";

if ($conn->query($sql_order) === TRUE) {
    $order_id = $conn->insert_id;

    // 插入订单项数据
    foreach ($cart_items as $item) {
        $product_id = $item['product_id'];
        $quantity = $item['quantity'];
        $unit_price = $item['price'];

        $sql_order_item = "INSERT INTO order_items (order_id, product_id, quantity, unit_price)
                           VALUES ('$order_id', '$product_id', '$quantity', '$unit_price')";
        $conn->query($sql_order_item);
    }

    // 清空购物车
    $sql_clear_cart = "DELETE FROM cart_items WHERE user_id = $user_id";
    $conn->query($sql_clear_cart);

    echo "訂單已成功提交！";
    echo "<script>
            setTimeout(function(){
                window.location.href = 'index.php';
            }, 3000);
          </script>";
} else {
    echo "提交訂單時發生錯誤: " . $conn->error;
}

// 关闭数据库连接
$conn->close();
?>
