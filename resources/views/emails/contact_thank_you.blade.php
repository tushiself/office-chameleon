<!DOCTYPE html>
<html>

<head>
    <title>Thank You for Contacting Us</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            border: 1px solid #e5e5e5;
            border-radius: 8px;
            overflow: hidden;
        }

        .email-header {
            background-color: #2c3e50;
            color: #ffffff;
            text-align: center;
            padding: 20px;
        }

        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }

        .email-body {
            padding: 20px;
        }

        .email-body p {
            margin: 15px 0;
        }

        .email-footer {
            text-align: center;
            background-color: #f4f4f4;
            color: #666;
            padding: 15px;
            font-size: 12px;
        }

        .highlight {
            color: #e67e22;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Header Section -->
        <div class="email-header">
            <h1>Thank You for Reaching Out!</h1>
        </div>

        <!-- Body Section -->
        <div class="email-body">
            <p>Dear <strong>{{ $user['first_name'] }} {{ $user['last_name'] }}</strong>,</p>

            <p>
                We are delighted to hear from you! Your message has been received by the <span class="highlight">Avina
                    Jewels</span> team, and we appreciate you taking the time to contact us. Whether it's an inquiry
                about our products, a special request, or feedback, we value every opportunity to assist you.
            </p>

            <p>
                At <span class="highlight">Chameleon Infotech</span>, we take pride in crafting timeless jewelry that reflects
                the unique elegance of our customers. Your interest drives us to continue delivering exquisite designs
                and outstanding service. Rest assured, our team is reviewing your message, and we will get back to you
                as soon as possible.
            </p>

            <p>
                Meanwhile, we invite you to explore our latest collections, promotions, and exclusive offers by visiting
                our website. Stay connected with us on social media to receive updates and discover the inspiration
                behind our stunning creations.
            </p>

            <p>
                If your matter is urgent, please don't hesitate to call us directly at <span class="highlight">+1 (800)
                    123-4567</span>. We're always here to help!
            </p>

            <p>
                Thank you once again for reaching out. We look forward to assisting you and creating a memorable
                experience with <span class="highlight">Chameleon Infotech</span>.
            </p>

            <p>
                Best regards,<br>
                <strong> Chameleon Infotech Team</strong>
            </p>
        </div>

        <!-- Footer Section -->
        <div class="email-footer">
            &copy; {{ date('Y') }} Chameleon Infotech. All rights reserved.<br>
            <a href="https://www.avinajewels.com" style="text-decoration: none; color: #2c3e50;">Visit Our Website</a>
        </div>
    </div>
</body>

</html>