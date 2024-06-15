<?php
    session_start();
?>

<meta charset = "utf-8">

<?php
    if(isset($_SESSION["check"])){
        if($_SESSION["check"] == "Yes"){
            echo "<a href='form.php'>2024資管晚會報名表</a>";
        }
        else{
            echo "非法進入網頁"."<br/>";
            echo "3秒後回登入畫面";
            header("Refresh: 3; url = login.php");
        }
    }
    else{
        echo "非法進入網頁"."<br/>";
        echo "3秒後回登入畫面";
        header("Refresh: 3; url = login.php");
    }
?>