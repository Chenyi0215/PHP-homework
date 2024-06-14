<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// 引入PHPMailer的檔案
require '../email/PHPMailer/src/Exception.php';
require '../email/PHPMailer/src/PHPMailer.php';
require '../email/PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $subject = $_POST['subject'] ?? '';
    $content = $_POST['content'] ?? '';
    $content = nl2br($content);

    // 連接到資料庫
    $conn = @mysqli_connect('localhost', 'root', '', 'phpmailer');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // 查詢所有email
    $sql = "SELECT email FROM emails";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $emails = [];
        while ($row = $result->fetch_assoc()) {
            $emails[] = $row['email'];
        }

        // Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->SMTPDebug = false;                      // Enable verbose debug output
            $mail->isSMTP();                               // Send using SMTP
            $mail->Host = 'smtp.gmail.com';                // Set the SMTP server to send through
            $mail->SMTPAuth = true;                        // Enable SMTP authentication
            $mail->Username = 'chenyitang0435@gmail.com';  // SMTP username
            $mail->Password = 'qecd kamg rlbn syyf';       // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable implicit TLS encryption
            $mail->Port = 465;                             // TCP port to connect to
            $mail->CharSet = 'UTF-8';

            // Recipients
            $mail->setFrom('chenyitang0435@gmail.com', 'Mailer');
            foreach ($emails as $email) {
                $mail->addAddress($email);
            }
            $mail->addReplyTo('chenyitang0435@gmail.com', 'Information');

            // Content
            $mail->isHTML(true); 
            $mail->Subject = $subject;
            $mail->Body    = $content;

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "No email addresses found.";
    }

    $conn->close();
}
?>
