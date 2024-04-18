<html>

<head>
<meta charset="utf-8">
</head>

<form action="check.php" method="get">

<h1>高大資管論文投稿系統</h1>
請選擇你的角色：<select name="sgrade">
<option value="chair">chair
<option value="Reviewer">Reviewer
<option value="Author">Author
</select></br>
賬號:<input type ="text" name="id"><br/>
密碼:<input type ="password" name="pwd"><br/>
<input type = "submit">

</form>
</body>

</html>

<?php
if(isset($_COOKIE["userName"])){
    echo $_COOKIE["userName"]."welcome back";
}else{
    echo"這是你第一次到這網站";
} 

?>

<?php
include("include.inc");
?>
