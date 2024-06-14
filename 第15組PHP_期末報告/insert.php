<?php
$servername = "sql313.infinityfree.com";
$username = "if0_36681160";
$password = "phpyonex007";
$dbname = "if0_36681160_badminton_store";



// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

// 生成密码的哈希值
$admin_username = "cy0215";
$admin_password = password_hash("cy0215", PASSWORD_DEFAULT);
$admin_email = "chenyitang0435@gmail.com";

// 插入管理员账号
$sql = "INSERT INTO admins (username, password, email) VALUES ('$admin_username', '$admin_password', '$admin_email')";

if ($conn->query($sql) === TRUE) {
    echo "新记录插入成功";
} else {
    echo "错误: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>