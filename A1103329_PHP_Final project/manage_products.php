<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理產品</title>
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
        form input, form textarea {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        form input[type="submit"] {
            background-color: #333;
            color: #fff;
            cursor: pointer;
            border: none;
        }
    </style>
</head>
<body>
    <!-- 返回管理員頁面按鈕 -->
<div style="text-align: center; margin-bottom: 20px;">
        <a href="admin.php">返回管理員頁面</a>
<div class="container">
    <h1>管理產品</h1>

    <!-- 添加产品表单 -->
    <h2>添加新產品</h2>
    <form action="manage_products.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="產品名稱" required>
        <textarea name="description" placeholder="產品描述" required></textarea>
        <input type="number" step="0.01" name="price" placeholder="價格" required>
        <input type="file" name="image" required>
        <label>
            熱門產品
            <input type="checkbox" name="is_hot">
        </label>
        <label>
            最新產品
            <input type="checkbox" name="is_new">
        </label>
        <label>
            特別推薦
            <input type="checkbox" name="is_special">
        </label>
        <input type="submit" name="add_product" value="添加產品">
    </form>

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
    
    // 添加产品
    if (isset($_POST['add_product'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $image = $_FILES['image']['name'];
        $is_hot = isset($_POST['is_hot']) ? 1 : 0;
        $is_new = isset($_POST['is_new']) ? 1 : 0;
        $is_special = isset($_POST['is_special']) ? 1 : 0;

        // 上传图片
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

        $sql = "INSERT INTO products (name, description, price, image, is_hot, is_new, is_special) VALUES ('$name', '$description', $price, '$target_file', $is_hot, $is_new, $is_special)";
        if ($conn->query($sql) === TRUE) {
            echo "<p>新產品添加成功</p>";
        } else {
            echo "<p>錯誤: " . $sql . "<br>" . $conn->error . "</p>";
        }
    }

    // 删除产品
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $sql = "DELETE FROM products WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "<p>產品刪除成功</p>";
        } else {
            echo "<p>錯誤: " . $sql . "<br>" . $conn->error . "</p>";
        }
    }

    // 获取所有产品
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);
    ?>

    <h2>產品列表</h2>
    <table>
        <tr>
            <th>產品ID</th>
            <th>名稱</th>
            <th>描述</th>
            <th>價格</th>
            <th>圖片</th>
            <th>熱門</th>
            <th>最新</th>
            <th>特別推薦</th>
            <th>操作</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";
                echo "<td>" . $row['price'] . "</td>";
                echo "<td><img src='" . $row['image'] . "' width='100'></td>";
                echo "<td>" . ($row['is_hot'] ? '是' : '否') . "</td>";
                echo "<td>" . ($row['is_new'] ? '是' : '否') . "</td>";
                echo "<td>" . ($row['is_special'] ? '是' : '否') . "</td>";
                echo "<td><a href='manage_products.php?delete=" . $row['id'] . "'>刪除</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>没有產品</td></tr>";
        }
        ?>
    </table>
</div>

<?php
$conn->close();
?>

</body>
</html>
