<?php
session_start();

// 检查用户是否已登录
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// 获取产品ID和操作类型
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($product_id > 0) {
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

    if ($action == 'remove') {
        // 删除产品
        $sql_delete = "DELETE FROM cart_items WHERE user_id = $user_id AND product_id = $product_id";
        $conn->query($sql_delete);
    } elseif ($action == 'update' && isset($_POST['quantity'])) {
        // 更新产品数量
        $quantity = intval($_POST['quantity']);
        if ($quantity > 0) {
            $sql_update = "UPDATE cart_items SET quantity = $quantity WHERE user_id = $user_id AND product_id = $product_id";
            $conn->query($sql_update);
        } else {
            $sql_delete = "DELETE FROM cart_items WHERE user_id = $user_id AND product_id = $product_id";
            $conn->query($sql_delete);
        }
    }

    $conn->close();
}

header("Location: cart.php");
exit;
?>

