<?php
// 数据库连接
$servername = "sql313.infinityfree.com";
$username = "if0_36681160";
$password = "phpyonex007";
$dbname = "if0_36681160_badminton_store";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

// 获取销售报告数据
$sql_sales = "SELECT DATE(created_at) as date, SUM(total_amount) as total_sales FROM orders GROUP BY DATE(created_at) ORDER BY date DESC LIMIT 10";
$result_sales = $conn->query($sql_sales);

// 检查是否有错误
if (!$result_sales) {
    echo "Error: " . $sql_sales . "<br>" . $conn->error;
}

// 格式化数据以便在JavaScript中使用
$sales_data = array();
while ($row = $result_sales->fetch_assoc()) {
    $sales_data[] = array($row['date'], (int)$row['total_sales']);
}

// 关闭数据库连接
$conn->close();
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>銷售報告</title>
    <!-- 引入 Google Charts JavaScript 库 -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['日期', '總銷售額'],
                <?php
                foreach ($sales_data as $sale) {
                    echo "['" . $sale[0] . "', " . $sale[1] . "],";
                }
                ?>
            ]);

            var options = {
                title: '每日銷售額',
                legend: { position: 'none' },
                vAxis: { title: '總銷售額' },
                hAxis: { title: '日期' }
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('sales_chart'));

            chart.draw(data, options);
        }
    </script>
</head>
<body>
    <!-- 返回管理員頁面按鈕 -->
    <div style="text-align: center; margin-bottom: 20px;">
        <a href="admin.php">返回管理員頁面</a>
    <!-- 銷售報告圖表 -->
    <div id="sales_chart" style="width: 100%; height: 400px;"></div>
</body>
</html>
