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

  $link = @mysqli_connect(
        'localhost',
        'root',
        '',
        'event_registration_php');
    
    //SQL語法
    $SQL = "INSERT INTO registrations (name, student_id, email, grade, phone, join_decision) VALUES ('$sName', '$sId', '$sEmail', '$sgrade', '$snumber', '$sjoin')";
    //送出查詢
    if($result = mysqli_query($link, $SQL)){
        echo "<br/>新增成功";
    }
    echo "<br/><a href='index.php'>查看資料庫資料</a>";
    
?>