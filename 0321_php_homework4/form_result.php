<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>表單結果</title>
</head>
<body>
<?php
$sName = $_POST["sName"];
echo "你的姓名: " . htmlspecialchars($sName) . "<br/>";
$sId = $_POST["sId"];
echo "你的學號: " . htmlspecialchars($sId) . "<br/>";
$sEmail = $_POST["sEmail"];
echo "你的電子郵件: " . htmlspecialchars($sEmail) . "<br/>";
$sgrade = $_POST["sgrade"];
echo "你的年級是: " . htmlspecialchars($sgrade) . "<br/>";
$snumber = $_POST["snumber"];
echo "你的聯絡電話: " . htmlspecialchars($snumber) . "<br/>";
$sjoin = $_POST["sjoin"];
echo "你的決定是: " . htmlspecialchars($sjoin) . "<br/>";
?>
</body>
</html>
