<?php
require "PHPMailer-master/src/PHPMailer.php";
require "PHPMailer-master/src/SMTP.php";
require 'PHPMailer-master/src/Exception.php';

$mail = new PHPMailer\PHPMailer\PHPMailer(true);
$mail->SMTPDebug = 2;

try {
    // Cấu hình SMTP Gmail
    $mail->isSMTP();
    $mail->CharSet = "utf-8";
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;

    // Điền thông tin Gmail người gửi của bạn
    $nguoigui = 'vund.25it@vku.udn.vn';
    $matkhau = 'wayrzxxvhxmymtac'; //em đã ẩn mk vì lí do bảo mật
    $tennguoigui = 'Hệ thống gửi mail hàng loạt';

    $mail->Username = $nguoigui;
    $mail->Password = $matkhau;
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom($nguoigui, $tennguoigui);

    // Danh sách email người nhận phân tách bởi dấu phẩy
    $recipients = "thanhvcvl222@gmail.com, vanthanhvl2011@gmail.com";
    $email_array = explode(",", $recipients);

    // Duyệt qua từng email để thêm vào danh sách nhận
    foreach ($email_array as $email) {
        $to = trim($email); // Xóa khoảng trắng thừa
        $mail->addAddress($to, "Khách hàng");
    }

    // Nội dung Email
    $mail->isHTML(true);
    $mail->Subject = 'Thư gửi hàng loạt từ PHP';
    $mail->Body = '<b>Chào bạn!</b><br>Đây là email tự động gửi tới nhiều địa chỉ cùng lúc.';

    // Bỏ qua kiểm tra SSL trên localhost
    $mail->smtpConnect(array(
        "ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
            "allow_self_signed" => true
        )
    ));

    $mail->send();
    echo 'Đã gửi email thành công tới tất cả các địa chỉ!';
} catch (Exception $e) {
    echo 'Mail không gửi được. Lỗi: ', $mail->ErrorInfo;
}
?>