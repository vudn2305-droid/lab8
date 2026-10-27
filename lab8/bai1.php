<?php
require "PHPMailer-master/src/PHPMailer.php";
require "PHPMailer-master/src/SMTP.php";
require 'PHPMailer-master/src/Exception.php';

$mail = new PHPMailer\PHPMailer\PHPMailer(true);
$mail->SMTPDebug = 2; // Bật chế độ debug để xem chi tiết kết nối SMTP

try {
    $mail->isSMTP();
    $mail->CharSet = "utf-8";
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;

    // Điền email và mật khẩu ứng dụng của bạn vào đây
    $nguoigui = 'vund.25it@vku.udn.vn';
    $matkhau = 'wayrzxxvhxmymtac'; //em đã ẩn mk vì lí do bảo mật
    $tennguoigui = 'Nguyễn Đình Vũ';

    $mail->Username = $nguoigui;
    $mail->Password = $matkhau;
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom($nguoigui, $tennguoigui);

    // Thông tin người nhận
    $to = "nguyendinhvu9876@gmail.com";
    $to_name = "Thắng Riêu";
    $mail->addAddress($to, $to_name);

    $mail->isHTML(true);
    $mail->Subject = 'Gửi thư từ php';
    $mail->Body = "<b>Chào bạn!</b><br>Chúc an lành!";

    // Đính kèm file (đảm bảo file 4.jpg có sẵn trong thư mục)
    if (file_exists("4.jpg")) {
        $mail->AddAttachment("4.jpg", "picture");
    }

    // Bỏ qua kiểm tra SSL nếu chạy ở localhost
    $mail->smtpConnect(array(
        "ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
            "allow_self_signed" => true
        )
    ));

    $mail->send();
    echo 'Đã gửi mail xong';
} catch (Exception $e) {
    echo 'Mail không gửi được. Lỗi: ', $mail->ErrorInfo;
}
?>