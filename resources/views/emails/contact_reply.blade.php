<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Response to your Contact Message</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .email-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            padding: 30px 20px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .email-body {
            padding: 30px 20px;
        }
        .email-body h2 {
            color: #667eea;
            font-size: 20px;
            margin-top: 0;
        }
        .original-message {
            background: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 15px;
            margin: 20px 0;
        }
        .original-message h3 {
            margin-top: 0;
            color: #555;
            font-size: 14px;
            text-transform: uppercase;
        }
        .reply-message {
            margin: 20px 0;
            padding: 20px;
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
        }
        .email-footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #e0e0e0;
        }
        .email-footer p {
            margin: 5px 0;
            font-size: 14px;
            color: #666;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        .divider {
            height: 1px;
            background: #e0e0e0;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>JasaIbnu - Customer Support</h1>
            <p style="margin: 10px 0 0 0; font-size: 14px;">Response to Your Message</p>
        </div>
        
        <div class="email-body">
            <h2>Halo {{ $customerName }},</h2>
            
            <p>Terima kasih telah menghubungi kami melalui form contact. Berikut adalah balasan dari tim kami:</p>
            
            <div class="reply-message">
                {!! nl2br(e($replyMessage)) !!}
            </div>
            
            <div class="divider"></div>
            
            <div class="original-message">
                <h3>Pesan Asli Anda:</h3>
                <p><strong>Subject:</strong> {{ $originalSubject }}</p>
                <p style="margin-top: 10px;">{{ $originalMessage }}</p>
            </div>
            
            <p>Jika Anda memiliki pertanyaan lebih lanjut, jangan ragu untuk menghubungi kami kembali.</p>
            
            <div style="text-align: center;">
                <a href="https://jasaibnu.id/contact" class="button">Visit Our Website</a>
            </div>
        </div>
        
        <div class="email-footer">
            <p><strong>JasaIbnu</strong></p>
            <p>Digital Solutions & Web Development</p>
            <p style="font-size: 12px; margin-top: 10px;">
                Email: {{ config('mail.from.address') }}<br>
                Website: https://jasaibnu.id
            </p>
            <p style="font-size: 11px; color: #999; margin-top: 15px;">
                © {{ date('Y') }} JasaIbnu. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
