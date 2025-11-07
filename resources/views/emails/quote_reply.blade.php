<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Response to your Quote Request</title>
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
        .quote-info {
            background: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 15px;
            margin: 20px 0;
        }
        .quote-info p {
            margin: 5px 0;
        }
        .quote-info strong {
            color: #667eea;
        }
        .reply-message {
            background: #ffffff;
            border: 1px solid #e1e4e8;
            border-radius: 6px;
            padding: 20px;
            margin: 20px 0;
        }
        .email-footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #6c757d;
            border-top: 1px solid #e1e4e8;
        }
        .button {
            display: inline-block;
            background: #667eea;
            color: #ffffff;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            margin: 15px 0;
        }
        .button:hover {
            background: #5568d3;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Response to your Quote Request</h1>
            <p>JasaIbnu - Digital Solutions</p>
        </div>
        
        <div class="email-body">
            <p>Dear <strong>{{ $customerName }}</strong>,</p>
            
            <p>Thank you for your interest in our services. We have received your quote request and here is our response:</p>
            
            <div class="reply-message">
                <h2>Our Response:</h2>
                <p>{!! nl2br(e($replyMessage)) !!}</p>
            </div>
            
            <div class="quote-info">
                <p><strong>Your Original Request:</strong></p>
                <p><strong>Service:</strong> {{ $service }}</p>
                <p><strong>Message:</strong></p>
                <p>{{ $originalMessage }}</p>
            </div>
            
            <p>If you have any questions or need further clarification, please don't hesitate to contact us.</p>
            
            <div style="text-align: center;">
                <a href="mailto:info@jasaibnu.com" class="button">Reply to This Email</a>
            </div>
        </div>
        
        <div class="email-footer">
            <p><strong>JasaIbnu</strong></p>
            <p>Your trusted partner for digital solutions and business consulting services</p>
            <p>&copy; {{ date('Y') }} JasaIbnu. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
