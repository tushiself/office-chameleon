<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .email-header h1 {
            font-size: 28px;
            color: #1a1a1a;
            margin: 0;
        }

        .email-header p {
            font-size: 16px;
            color: #888;
        }

        .email-body {
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }

        .email-body p {
            margin-bottom: 20px;
        }

        .email-body a {
            color: #fff;
        }

        .email-body .highlight {
            font-weight: bold;
            color: #00003D;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #888;
        }

        .footer a {
            color: #8b1e3f;
            text-decoration: none;
        }

        .button {
            background-color: #00003D;
            color: #fff;
            padding: 12px 20px;
            font-size: 16px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
        }

        .button:hover {
            background-color: #9f2249;
        }

        @media (max-width: 600px) {
            .email-container {
                padding: 15px;
            }
        }
    </style>
</head>

<body>

    <div class="email-container">
        <div class="email-header">
            <h1>Password Reset Request for {{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</h1>
            <p>We received a request to reset your password</p>
        </div>

        <div class="card-body">
            <p>Hello {{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }},</p>
            <p>Your password has been reset. Use the password below to log in to your account:</p>
            <div class="alert alert-info text-center">
                <strong>{{ $randomPassword }}</strong>
            </div>
            <p>
                After logging in, we recommend changing your password for security purposes.
            </p>
            <p>Thank you,<br>Chameleon Infotech Team</p>
        </div>

        <div class="footer">
            <p>&copy; 2025 Chameleon Infotech. All rights reserved.</p>
        </div>
    </div>

</body>

</html>