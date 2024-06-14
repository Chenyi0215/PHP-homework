<?php
session_start();

// 检查用户是否已登录
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// 获取产品ID和数量
$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

if ($product_id > 0 && $quantity > 0) {
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

    // 检查购物车是否已经存在该产品
    $sql_check = "SELECT * FROM cart_items WHERE user_id = $user_id AND product_id = $product_id";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        // 如果已经存在，则更新数量
        $sql_update = "UPDATE cart_items SET quantity = quantity + $quantity WHERE user_id = $user_id AND product_id = $product_id";
        $conn->query($sql_update);
    } else {
        // 如果不存在，则插入新记录
        $sql_insert = "INSERT INTO cart_items (user_id, product_id, quantity) VALUES ($user_id, $product_id, $quantity)";
        $conn->query($sql_insert);
    }

    $conn->close();
}

header("Location: cart.php");
exit;
?>
