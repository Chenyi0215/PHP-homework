<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Badminton Store</title>
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
        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        label {
            font-weight: bold;
        }
        input, select, textarea {
            padding: 10px;
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 5px;
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
            text-align: center;
        }
        .total {
            font-size: 20px;
            font-weight: bold;
            text-align: right;
            padding: 20px 0;
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

// Database connection
$servername = "localhost";
$username = "root";
$password = "";// 檢查用戶是否已登錄
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// 獲取用戶ID
$user_id = $_SESSION['user_id'];

// 數據庫連接
$servername = "sql313.infinityfree.com";
$username = "if0_36681160";
$password = "phpyonex007";
$dbname = "if0_36681160_badminton_store";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("連接失敗: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

// 獲取購物車內容
$cart_items = [];
$total_price = 0;

$sql_cart = "SELECT cart_items.*, products.name, products.price 
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
    echo "<div class='container'><p>您的購物車是空的。</p></div>";
    exit();
}
?>

<!-- 導航欄 -->
<header>
    <nav>
        <ul>
            <li><a href="index.php">首頁</a></li>
            <li><a href="search.php">搜尋</a></li>
            <li><a href="cart.php">購物車</a></li>
        </ul>
    </nav>
</header>

<!-- 主體內容 -->
<div class="container">
    <h1>結帳</h1>
    <form action="place_order.php" method="post">
        <div>
            <label for="name">姓名:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="address">送貨地址:</label>
            <textarea id="address" name="address" rows="4" required></textarea>
        </div>
        <div>
            <label for="payment_method">付款方式:</label>
            <select id="payment_method" name="payment_method" required>
                <option value="credit_card">信用卡</option>
                <option value="paypal">PayPal</option>
                <option value="bank_transfer">銀行轉賬</option>
            </select>
        </div>
        <div class="total">總價: TWD<?php echo $total_price; ?></div>
        <div>
            <button type="submit" class="btn">確認訂單</button>
            <a href="cart.php" class="btn">返回購物車</a>
        </div>
    </form>
</div>

<!-- 腳注 -->
<footer>
    <p>版權所有 © YYDS 羽毛球拍商店。保留所有權利。</p>
</footer>

<?php
// 關閉數據庫連接
$conn->close();
?>
</body>
</html>


