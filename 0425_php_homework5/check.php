<?php
    session_start();
?>

<meta charset = "utf-8">

<?php
    $sId = "a1103329";
    $sPwd = "a1103329";

    $uId = $_GET["uId"];
    $uPwd = $_GET["uPwd"];

    if($uId == $sId && $uPwd == $sPwd){
        $_SESSION["check"] = "Yes";
        header("Location: login_success.php");
    }
    else{
        $_SESSION["check"] = "No";
        header("Location: fail.php");
    }
?>