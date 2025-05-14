<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Updated - Chameleon Infotech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            color: #333;
            font-family: 'Arial', sans-serif;
        }

        .email-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        .header {
            background-color: #1e3d58;
            color: #ffffff;
            padding: 25px;
            text-align: center;
            border-radius: 8px 8px 0 0;
            font-size: 24px;
        }

        .footer {
            background-color: #1e3d58;
            color: #ffffff;
            padding: 20px;
            text-align: center;
            border-radius: 0 0 8px 8px;
            font-size: 14px;
        }

        .body {
            margin-top: 20px;
            font-size: 18px;
            line-height: 1.6;
            color: #333;
        }

        h3 {
            font-size: 22px;
            font-weight: bold;
            color: #1e3d58;
        }

        .button {
            background-color: #007bff;
            color: #ffffff;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 20px;
            display: inline-block;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .highlight {
            color: #007bff;
        }
    </style>
</head>

<body>
    <div class="container" style="max-width: 600px; margin-top: 50px;">
        <div class="email-container">
            <div class="header">
                Chameleon Infotech
            </div>
            <div class="body">
                <h3>Hello, {{ $user->first_name }} {{ $user->middel_name }} {{ $user->last_name }}</h3>
                <p>
                    We wanted to let you know that your password has been successfully updated in our system.
                    If you did not initiate this request, please contact our support team immediately.
                    We take your account's security seriously and are here to assist you in any way we can.
                </p>
                <p>
                    If you need further assistance or have any questions, feel free to reach out to us.
                </p>
                <p>
                    Thank you for choosing <strong>Chameleon Infotech</strong>.
                </p>
                <p>
                    Best regards,<br>
                    The Chameleon Infotech Team
                </p>
            </div>
            <div class="footer">
                <p>&copy; {{ date('Y') }} Chameleon Infotech. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>

</html>
