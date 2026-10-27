<?php
require "PHPMailer-master/src/PHPMailer.php";
require "PHPMailer-master/src/SMTP.php";
require 'PHPMailer-master/src/Exception.php';

if (isset($_POST['email'])) {
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->CharSet = "utf-8";
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;

        $nguoigui = 'vund.25it@vku.udn.vn';
        $matkhau = 'wayrzxxvhxmymtac'; 
        $tennguoigui = 'Hệ thống Mail';

        $mail->Username = $nguoigui;
        $mail->Password = $matkhau;
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom($nguoigui, $tennguoigui);

        // Lấy dữ liệu từ Form gửi sang
        $to = $_POST['email'];
        $to_name = "Bạn";
        $tieude = $_POST['tieude'];

        $mail->addAddress($to, $to_name);

        $mail->isHTML(true);
        $mail->Subject = $tieude;

        // Định dạng lại giao diện nội dung HTML
        $noidungthu = '
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title"><b>Xin chào ' . htmlspecialchars($to_name) . '</b></h5>
                <p class="card-text">' . nl2br(htmlspecialchars($_POST['content'])) . '</p>
            </div>
        </div>';
        $mail->Body = $noidungthu;

        // Xử lý file đính kèm nếu người dùng có chọn file
        if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
            $uploadfile = tempnam(sys_get_temp_dir(), sha1($_FILES['file']['name']));
            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                $mail->addAttachment($uploadfile, $_FILES['file']['name']);
            }
        }

        $mail->smtpConnect(array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
                "allow_self_signed" => true
            )
        ));

        if ($mail->send()) {
            echo "<script>alert('Gửi mail thành công!'); window.location.href='index.php';</script>";
        }
    } catch (Exception $e) {
        echo 'Mail không gửi được. Lỗi: ', $mail->ErrorInfo;
    }
}
?>