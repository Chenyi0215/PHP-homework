
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>2024資管晚會報名表單</title>
</head>
<body>
<form action="form_result.php" method="post">
<h1>2024資管晚會報名表單</h1>
姓名:<input type="text" name="sName" placeholder="Please enter your name" required><br/>
學號:<input type="text" name="sId" placeholder="Please enter your id" required><br/>
電子郵件:<input type="email" name="sEmail" placeholder="Please enter your email" required><br/>
年級：
<select name="sgrade" required>
<option value="1">1
<option value="2">2
<option value="3">3
<option value="4">4
<option value="master">master
</select></br>
聯絡電話:<input type="number" name="snumber" placeholder="Please enter your phone number" required><br/>
報名嗎？:
<select name="sjoin" required>
<option value="yes">一定來
<option value="no">還是下次吧
</select></br>
</br>
<input type="submit" value="送出">
<input type="reset" value="重填">
</form>
<a href="logout.php">Logout</a>
</body>
</html>

