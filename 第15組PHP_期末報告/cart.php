<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Badminton Store</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f8f8f8;
        }
        .total {
            font-size: 20px;
            font-weight: bold;
            text-align: right;
            padding: 20px 0;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 10px;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
        nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        nav ul li {
            display: inline;
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
        }
        footer {
            text-align: center;
            padding: 10px 0;
            background-color: #333;
            color: #fff;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>
<?php
session_start();

// 检查用户是否已登录
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

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

// 获取购物车内容
$cart_items = [];
$total_price = 0;

$sql_cart = "SELECT cart_items.*, products.name, products.price, products.image 
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
?>

<!-- 导航栏 -->
<header>
    <nav>
        <ul>
            <li><a href="index.php">首頁</a></li>
            <li><a href="search.php">搜尋</a></li>
            <li><a href="cart.php">購物車</a></li>
        </ul>
    </nav>
</header>

<!-- 主体内容 -->
<div class="container">
    <h1>購物車</h1>
    <?php if (!empty($cart_items)) { ?>
        <table>
            <thead>
                <tr>
                    <th>產品</th>
                    <th>數量</th>
                    <th>單價</th>
                    <th>總價</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart_items as $item) { ?>
                    <tr>
                        <td><?php echo $item['name']; ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>TWD<?php echo $item['price']; ?></td>
                        <td>TWD<?php echo $item['price'] * $item['quantity']; ?></td>
                        <td>
                            <a href="update_cart.php?id=<?php echo $item['product_id']; ?>&action=remove" class="btn">删除</a>
                            <a href="update_cart.php?id=<?php echo $item['product_id']; ?>&action=update" class="btn">更新</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="total">總價: TWD<?php echo $total_price; ?></div>
        <a href="checkout.php" class="btn">結算</a>
    <?php } else { ?>
        <p>您的購物車是空的。</p>
    <?php } ?>
</div>

<!-- 脚注 -->
<footer>
    <p>版权所有 © YYDS 羽毛球拍商店。保留所有权利。</p>
</footer>

<?php
// 关闭数据库连接
$conn->close();
?>
</body>
</html>
