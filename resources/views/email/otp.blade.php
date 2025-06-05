<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Your OTP Code</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                padding: 0;
                margin: 0;
            }
            .container {
                max-width: 600px;
                margin: 30px auto;
                background-color: #fff;
                border-radius: 10px;
                padding: 30px;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
            }
            .title {
                text-align: center;
                font-size: 22px;
                font-weight: bold;
                margin-bottom: 20px;
            }
            .salam {
                text-align: center;
                font-weight: bold;
                margin-bottom: 20px;
            }
            .message {
                ont-size: 16px;
                line-height: 1.5;
                margin-bottom: 30px;
                text-align: center;
            }
            .otp-box {
                background-color: #f0f0f0;
                padding: 15px 30px;
                font-size: 24px;
                letter-spacing: 4px;
                text-align: center;
                border-radius: 8px;
                font-weight: bold;
                margin-bottom: 30px;
            }
            .footer {
                text-align: center;
                font-size: 13px;
                color: #777;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="title">Kode One-Time Password (OTP) Anda</div>
            <div class="salam">Yang Terhormat {{ $username }}</div>
            <div class="message">
                Gunakan kode OTP di bawah ini untuk menyelesaikan proses verifikasi anda.
            </div>
            <div class="otp-box">{{ $otp }}</div>
            <div class="footer">
                Jika Anda tidak meminta OTP ini, harap abaikan email ini.<br>
                Terimakasih atas perhatiannya, Tim Tracer Study SIB 2A Kelompok 6
            </div>
        </div>
    </body>
</html>
