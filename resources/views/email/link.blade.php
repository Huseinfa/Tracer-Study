<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }
            .container {
                max-width: 600px;
                margin: 30px auto;
                background-color: fff;
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
                font-size: 16px;
                line-height: 1.5;
                margin-bottom: 30px;
                text-align: center;
            }
            .button {
                text-align: center;
                margin-bottom: 30px;
            }
            .button a {
                background-color: #4285f4;
                color: white;
                padding: 12px 24px;
                text-decoration: none;
                border-radius: 5px;
                font-weight: bold;
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
            <div class="title">Tautan Survey Kepuasan Pengguna Lulusan</div>
            <div class="salam">Yang Terhormat {{ $username }}</div>
            <div class="message">
                Link survey kepuasan pengguna lulusan anda sebagai berikut:
            </div>
            <div class="button">
                <a href="http://127.0.0.1:8000/survey-kepuasan/{{ $otp }}">Klik untuk melanjutkan</a>
            </div>
            <div class="footer">
                Jika anda tidak berkaitan dengan survey ini, harap abaikan email ini.<br>
                Terimakasih atas perhatiannya, Tim Tracer Study SIB 2A Kelompok 6
            </div>
            </div>
        </div>
    </body>
</html>
