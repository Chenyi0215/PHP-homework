<meta charset="utf8">

<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET["id"];

// 連接資料庫
$link = @mysqli_connect( 
    'localhost',  
    'root',       
    '', 
    'event_registration_php');

if (!$link) {
    die("無法開啟資料庫!<br/>");
}

// SQL 語法
$SQL = "DELETE FROM registrations WHERE id = '$id'";

// 送出查詢
if ($result = mysqli_query($link, $SQL)) {
    echo "刪除成功";
} else {
    echo "刪除失敗: " . mysqli_error($link);
}
echo "<br/><a href='index.php'>查看資料庫資料</a>";

// 關閉資料庫連接
mysqli_close($link);
?>

