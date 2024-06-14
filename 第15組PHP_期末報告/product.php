<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details - Badminton Store</title>
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
        .product-detail {
            display: flex;
            gap: 20px;
        }
        .product-detail img {
            width: 50%;
            height: auto;
            border-radius: 5px;
        }
        .product-info {
            width: 50%;
        }
        .product-info h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .product-info p {
            color: #333;
            margin-bottom: 10px;
        }
        .product-info .price {
            font-size: 20px;
            color: #e74c3c;
            margin-bottom: 20px;
        }
        .product-info .quantity {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .product-info .quantity input {
            width: 50px;
            padding: 5px;
            margin-left: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .product-info .btn {
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

    // 获取产品ID
    $product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    if ($product_id <= 0) {
        die("无效的產品ID");
    }

    // 查询产品信息
    $sql_product = "SELECT id, name, description, price, image FROM products WHERE id = $product_id";
    $result_product = $conn->query($sql_product);
    if ($result_product->num_rows == 0) {
        die("找不到该產品");
    }
    $product = $result_product->fetch_assoc();
    echo "<img src='" . $image_path . "' alt='" . $product['name'] . "' width='100'>";
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
    <div class="product-detail">
        <img src="<?php echo $image_path . $product['image']; ?>" alt="<?php echo $product['name']; ?>">
        <div class="product-info">
            <h2><?php echo $product['name']; ?></h2>
            <p><?php echo $product['description']; ?></p>
            <p class="price">價格: TWD<?php echo $product['price']; ?></p>
            <form action="add_to_cart.php" method="post">
                <div class="quantity">
                    <label for="quantity">數量:</label>
                    <input type="number" id="quantity" name="quantity" value="1" min="1">
                </div>
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                <button type="submit" class="btn">加入購物車</button>
                <a href="checkout.php?id=<?php echo $product['id']; ?>" class="btn">直接購買</a>
            </form>
        </div>
    </div>
</div>

<!-- 脚注 -->
<footer>
    <p>版權所有 © YYDS 羽毛球拍商店。保留所有權力。</p>
</footer>

<?php
// 关闭数据库连接
$conn->close();
?>
</body>
</html>
