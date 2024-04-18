<?php

session_start();
?>
<meta charset="utf-8">
<?php

$chairID = "chair";
$chairPWD = "123";

$reviewerID = "reviewer";
$reviewerPWD = "234";

$authorID = "author";
$authorPWD = "345";


$id = $_GET["id"];
$pwd = $_GET["pwd"];

if ($chairID==$id && $chairPWD==$pwd){
    setcookie("userName",$id,time()+3600);
    $_SESSION["check"]="Yes";
    header("Location:chair.php");
} else if (($reviewerID == $id) && ($reviewerPWD == $pwd)) {
    setcookie("userName",$id,time()+3600);
    $_SESSION["check"]="Yes"
    header("Location:reviewer.php");
} else if (($authorID == $id) && ($authorPWD == $pwd)) {
    setcookie("userName",$id,time()+3600);
    $_SESSION["check"]="Yes"
    header("Location:author.php");
} else {
    $_SESSION["check"] = "No";
    header("Location:fail.php");
}
ob_flush();
?>