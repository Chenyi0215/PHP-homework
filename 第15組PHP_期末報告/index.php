<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YYDS 羽毛球拍商店</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0fff0; /* 淡绿色背景 */
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
            margin-top: 20px;
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
            transition: color 0.3s;
        }
        nav ul li a:hover {
            color: #e74c3c;
        }
        h1 {
            text-align: center;
        }
        .product-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .product-item {
            width: 30%;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            text-align: center;
        }
        .product-item img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .product-item h2 {
            font-size: 18px;
            margin: 10px 0;
        }
        .product-item p {
            color: #333;
            margin: 5px 0;
        }
        .product-item .price {
            color: #e74c3c;
            font-size: 16px;
            margin: 10px 0;
        }
        .product-item .btn {
            display: inline-block;
            padding: 8px 16px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .product-item .btn:hover {
            background-color: #e74c3c;
        }
        .search-bar {
            text-align: center;
            margin: 20px 0;
        }
        .search-bar input[type="text"] {
            width: 50%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .search-bar input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: #333;
            color: #fff;
            cursor: pointer;
        }
    </style>
</head>
<body>

<!-- 导航栏 -->
<header>
    <nav>
        <ul>
            <li><a href="index.php">首頁</a></li>
            <li><a href="search.php">搜尋</a></li>
            <li><a href="cart.php">購物車</a></li>
            <li class="account">
                <?php
                session_start();
                if (isset($_SESSION['user_id'])) {
                    echo '<a href="account.php">我的賬號</a>';
                    echo ' | ';
                    echo '<a href="logout.php">登出</a>';
                } else {
                    echo '<a href="login.php">登入/注冊</a>';
                }
                ?>
            </li>
            <li class="admin">
                <a href="admin_login.php">管理者登入</a>
            </li>
        </ul>
    </nav>
</header>

<div class="container">
    <h1>YYDS 羽毛球拍商店</h1>

    <!-- 搜索栏 -->
    <div class="search-bar">
        <form action="search.php" method="GET">
            <input type="text" name="query" placeholder="搜尋产品...">
            <input type="submit" value="搜尋">
        </form>
    </div>

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

    // 获取热门产品
    $sql_hot = "SELECT id, name, description, price, image FROM products WHERE is_hot = TRUE LIMIT 3";
    $result_hot = $conn->query($sql_hot);

    // 获取最新产品
    $sql_new = "SELECT id, name, description, price, image FROM products WHERE is_new = TRUE LIMIT 3";
    $result_new = $conn->query($sql_new);

    // 获取特别推荐产品
    $sql_special = "SELECT id, name, description, price, image FROM products WHERE is_special = TRUE LIMIT 3";
    $result_special = $conn->query($sql_special);
    ?>

    <!-- 热门产品 -->
    <h2>热门產品</h2>
    <div class="product-list">
        <?php
        if ($result_hot->num_rows > 0) {
            while ($row = $result_hot->fetch_assoc()) {
                echo "<div class='product-item'>";
                echo "<img src='" . $row['image'] . "' alt='" . $row['name'] . "'>";
                echo "<h2>" . $row['name'] . "</h2>";
                echo "<p>" . $row['description'] . "</p>";
                echo "<p class='price'>價格: TWD " . $row['price'] . "</p>";
                echo "<a href='product.php?id=" . $row['id'] . "' class='btn'>查看詳情</a>";
                echo "</div>";
            }
        } else {
            echo "<p>暫无熱門產品。</p>";
        }
        ?>
    </div>

    <!-- 最新产品 -->
    <h2>最新產品</h2>
    <div class="product-list">
        <?php
        if ($result_new->num_rows > 0) {
            while ($row = $result_new->fetch_assoc()) {
                echo "<div class='product-item'>";
                echo "<img src='" . $row['image'] . "' alt='" . $row['name'] . "'>";
                echo "<h2>" . $row['name'] . "</h2>";
                echo "<p>" . $row['description'] . "</p>";
                echo "<p class='price'>價格: TWD " . $row['price'] . "</p>";
                echo "<a href='product.php?id=" . $row['id'] . "' class='btn'>查看詳情</a>";
                echo "</div>";
            }
        } else {
            echo "<p>暫無最新產品。</p>";
        }
        ?>
    </div>

    <!-- 特别推荐产品 -->
    <h2>特別推薦</h2>
    <div class="product-list">
        <?php
        if ($result_special->num_rows > 0) {
            while ($row = $result_special->fetch_assoc()) {
                echo "<div class='product-item'>";
                echo "<img src='" . $row['image'] . "' alt='" . $row['name'] . "'>";
                echo "<p>" . $row['description'] . "</p>";
                echo "<p class='price'>價格: TWD " . $row['price'] . "</p>";
                echo "<a href='product.php?id=" . $row['id'] . "' class='btn'>查看詳情</a>";
                echo "</div>";
            }
        } else {
            echo "<p>暫无特別推薦產品。</p>";
        }
        ?>
    </div>
</div>
</body>
</html>
