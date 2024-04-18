<?php
session_start();
?>

<html>
<meta charset="utf-8">

<?php
    if($_SESSION["check"]=="Yes"){
        echo "歡迎進入chair網站<br/r>";
        echo "<a href='logout.php'>登出</a>";
    }else{
        echo "非法進入網頁<br/>";
        echo "3秒後回去登入畫面";
        header("Refresh:3;url=login.php");
    }

?>

</html>