<meta charset = "utf-8">

<?php
   
    $link = @mysqli_connect( 
        'localhost',  
        'root',       
        '', 
        'event_registration_php');  


    if(!$link)
        die("無法開啟資料庫!<br/>");
    else
        echo "資料庫開啟成功!";

   
        $SQL = "SELECT * FROM registrations";

        // 送出查詢
        $result = mysqli_query($link, $SQL);
        
        // 結果轉陣列
        echo "<table border='1'>";
        echo "<tr><th>No</th><th>姓名</th><th>學號</th><th>電子郵件</th><th>年級</th><th>聯絡電話</th><th>報名決定</th><th>操作</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>".$row["id"]."</td>";
            echo "<td>".$row["name"]."</td>";
            echo "<td>".$row["student_id"]."</td>";
            echo "<td>".$row["email"]."</td>";
            echo "<td>".$row["grade"]."</td>";
            echo "<td>".$row["phone"]."</td>";
            echo "<td>".$row["join_decision"]."</td>";
            echo "<td><a href='del.php?id=".$row["id"]."'>刪除</a> | <a href='edit.php?id=".$row["id"]."'>修改</a></td>";
            echo "</tr>";
        }
        echo "</table>";
        
        // 關閉資料庫連接
        mysqli_close($link);
        ?>



