<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Chameleon Infotech</title>
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
            <h1>Welcome to Chameleon Infotech, {{ $user->first_name }}!</h1>
            <p>Your Professional Journey Begins Here</p>
        </div>

        <div class="email-body">
            <p>Dear <span class="highlight">{{ $user->first_name }}</span>,</p>
            <p>We are thrilled to welcome you to <strong>Chameleon Infotech</strong>! You are now part of an innovative team dedicated to delivering cutting-edge technology solutions and services.</p>

            <p>At <strong>Chameleon Infotech</strong>, we believe in empowering our team members to grow, innovate, and collaborate in a dynamic work environment. We are excited to have you onboard and look forward to seeing your contributions as we build the future together.</p>

            <p>Your account has been successfully created using the email address
                <span class="highlight">{{ $user->email }}</span> with the password <span class="highlight">{{ $plainPassword }}</span>.
            </p>

            <p>To help you get started, you can visit our internal portal and explore important resources to kick-start your journey with us:</p>

            <a href="https://office.chameleoninfotech.com" class="button">Visit Employee Portal</a>
        </div>

        <div class="footer">
            <p>If you have any questions, feel free to <a href="mailto:info@chameleoninfotech.com">contact HR</a>. We are here to support you!</p>
            <p>&copy; 2025 Chameleon Infotech. All rights reserved.</p>
        </div>
    </div>

</body>

</html>
