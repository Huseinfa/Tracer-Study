<!DOCTYPE html>
<html>
    <head>
        <title>Kode OTP Anda</title>
    </head>
    <body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
        <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
            <h2 style="color: #1a73e8;">Kode OTP Anda</h2>
            <p>Yang Terhormat {{ $username }},</p>
            <p>One-Time Password (OTP) Anda untuk verifikasi adalah:</p>
            <h3 style="background: #f1f1f1; padding: 10px; text-align: center;">{{ $otp }}</h3>
            <p>Tolong jangan bagikan dengan siapa pun.</p>
            <p>Jika Anda tidak meminta OTP ini, harap abaikan email ini atau hubungi tim dukungan kami.</p>
            <p>Terimakasih,<br>Tim Tracer Study SIB 2A Kelompok 6</p>
        </div>
    </body>
</html>