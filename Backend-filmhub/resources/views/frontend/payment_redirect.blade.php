<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chuyển Hướng Thanh Toán</title>
    <script type="text/javascript">
        function redirectToHome() {
            window.location.href = "{{ route('movies.index') }}"; // Quay lại trang chính
        }

        // Thiết lập timeout 3 phút (180000 ms)
        setTimeout(redirectToHome, 180000); // 3 phút
    </script>
</head>
<body>
    <h1>Đang chuyển hướng đến VNPAY...</h1>
    <p>Xin vui lòng đợi trong giây lát.</p>
    <script type="text/javascript">
        // Chuyển hướng đến VNPAY sau 1 giây
        setTimeout(function() {
            window.location.href = "{{ $vnp_Url }}";
        }, 1000);
    </script>
</body>
</html>
