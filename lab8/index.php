<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Gửi Email</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h2>Email tới bạn</h2>
    <form action="mail.php" enctype="multipart/form-data" method="POST">
        <div class="form-group">
            <label>Email người nhận:</label>
            <input type="email" class="form-control" name="email" placeholder="Nhập Email" required>
        </div>
        <div class="form-group">
            <label>Tiêu đề:</label>
            <input type="text" class="form-control" name="tieude" placeholder="Nhập tiêu đề" required>
        </div>
        <div class="form-group">
            <label>Nội dung:</label>
            <textarea name="content" id="editor" class="form-control" rows="5"></textarea>
        </div>
        <div class="form-group">
            <label>File đính kèm:</label>
            <input type="file" class="form-control-file" name="file">
        </div>
        <button type="submit" class="btn btn-primary">Gửi</button>
    </form>
</body>
</html>