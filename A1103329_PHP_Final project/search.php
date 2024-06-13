<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>搜索结果 - YYDS 羽毛球拍商店</title>
    <style>
        /* CSS 样式，您可以根据需要进行调整 */
        body {
            font-family: Arial, sans-serif;
            background-color: #e5f6e5; /* 浅绿色背景 */
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
        }
        .product-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .product-card {
            border: 1px solid #ddd;
            padding: 10px;
            width: calc(33.333% - 20px);
            text-align: center;
            background-color: #fff;
            border-radius: 5px;
            transition: background-color 0.3s; /* 添加过渡效果 */
        }
        .product-card:hover {
            background-color: #f5f5f5; /* 悬停时背景颜色 */
        }
        .product-card img {
            width: 100%;
            height: auto;
        }
        .product-card h3 {
            font-size: 18px;
            margin: 10px 0;
        }
        .product-card p {
            color: #333;
        }
        .product-card .btn {
            display: inline-block;
            padding: 10px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
            transition: background-color 0.3s; /* 添加过渡效果 */
        }
        .product-card .btn:hover {
            background-color: #555; /* 悬停时背景颜色 */
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
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        footer p {
            margin: 0;
        }
        .search-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .search-container input[type="text"] {
            padding: 10px;
            width: 50%;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }
        .search-container input[type="submit"] {
            padding: 10px 20px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s; /* 添加过渡效果 */
        }
        .search-container input[type="submit"]:hover {
            background-color: #45a049;
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
        die("连接失败: " . $conn->connect_error);
    }

    $conn->set_charset("utf8mb4");

    // 处理搜索关键字
    $search_query = isset($_GET['query']) ? $_GET['query'] : '';
    
    // 查询匹配搜索关键字的产品
    $sql_search = "SELECT id, name, description, price, image FROM products WHERE name LIKE '%$search_query%' OR description LIKE '%$search_query%'";
    $result_search = $conn->query($sql_search);
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

    <!-- 搜索表单 -->
    <div class="search-container">
        <form action="search.php" method="GET">
            <input type="text" placeholder="搜尋產品..." name="query" value="<?php echo $search_query; ?>">
            <input type="submit" value="搜尋">
        </form>
    </div>

    <!-- 主体内容 -->
    <div class="container">
        <h1>搜尋结果</h1>

        <?php
        if ($result_search->num_rows > 0) {
            // 输出搜索结果
            echo '<div class="product-grid">';
            while($row = $result_search->fetch_assoc()) {
                echo '<div class="product-card">';
                echo "<img src='" . $row['image'] . "' alt='" . $row['name'] . "'>";
                echo '<h3>' . $row["name"] . '</h3>';
                echo '<p>' . $row["description"] . '</p>';
                echo '<p>價格: TWD' . $row["price"] . '</p>';
                echo '<a href="product.php?id=' . $row["id"] . '" class="btn">查看詳情</a>';
                echo '</div>';
            }
            echo '</div>';
        } else {
            echo "未找到符合條件的產品。";
        }

        // 关闭数据库连接
        $conn->close();
        ?>
    </div>

    <!-- 脚注 -->
    <footer>
        <p>版权所有 © YYDS 羽毛球拍商店。保留所有权利。</p>
    </footer>
</body>
</html>
