
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Phản hồi liên hệ</title>
</head>

<body style="
    margin: 0;
    padding: 30px 15px;
    background-color: #f3f6fb;
    font-family: Arial, Helvetica, sans-serif;
    color: #1f2937;
">

    <div style="
        max-width: 620px;
        margin: 0 auto;
        background: #ffffff;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e5e7eb;
    ">

        <!-- Header -->
        <div style="
            padding: 28px 32px;
            background: #172554;
            color: #ffffff;
        ">
            <h2 style="margin: 0; font-size: 22px;">
                Portfolio
            </h2>

            <p style="
                margin: 8px 0 0;
                color: #cbd5e1;
                font-size: 14px;
            ">
                Phản hồi từ quản trị viên
            </p>
        </div>

        <!-- Nội dung -->
        <div style="padding: 32px;">

            <p style="
                margin-top: 0;
                font-size: 16px;
            ">
                Xin chào,
            </p>

            <p style="
                font-size: 15px;
                line-height: 1.8;
                color: #475569;
            ">
                Cảm ơn bạn đã liên hệ qua website Portfolio.
                Dưới đây là nội dung phản hồi:
            </p>

            <div style="
                background: #f8fafc;
                border-left: 4px solid #2563eb;
                padding: 18px 20px;
                margin: 24px 0;
                border-radius: 6px;
                font-size: 15px;
                line-height: 1.8;
                white-space: pre-wrap;
                overflow-wrap: break-word;
            ">{{ $replyBody }}</div>

            <p style="
                margin-top: 30px;
                font-size: 15px;
                line-height: 1.8;
            ">
                Trân trọng,<br>
                <strong>Quản trị viên Portfolio</strong>
            </p>

        </div>

        <!-- Footer -->
        <div style="
            padding: 20px 32px;
            background: #f8fafc;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            font-size: 12px;
            color: #64748b;
        ">
            Email này được gửi từ hệ thống Portfolio.
        </div>

    </div>

</body>
</html>
