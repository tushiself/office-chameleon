<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Password Updated • {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>   

<body
    style="margin:0; padding:0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;">
    <!-- Container -->
    <table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="background:#f7f7f9; padding: 30px 0;">
        <tr>
            <td align="center">

                <!-- Card -->
                <table width="580" cellpadding="0" cellspacing="0" role="presentation"
                    style="background:#ffffff; border-radius:6px; box-shadow:0 2px 4px rgba(0,0,0,0.05); overflow:hidden;">
                    <!-- Header / Hero -->
                    <tr>
                        <td style="background:#0d6efd; padding: 24px 40px; color:#fff;">
                            <h1 style="margin:0; font-size:24px; line-height:1.2;">Welcome,
                                {{ $user->first_name ?? $user->name }}!</h1>
                            <p style="margin:4px 0 0; font-size:14px; opacity:.9;">Your password has been updated
                                successfully</p>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding: 32px 40px 24px 40px; color:#212529;">
                            <p style="margin-top:0;">We’re excited to have you on board. You can now log in and start
                                exploring your personal dashboard.</p>

                            <table width="100%" cellpadding="0" cellspacing="0" role="presentation"
                                style="margin:24px 0;">
                                <tr>
                                    <td style="background:#f1f3f5; border-radius:4px; padding:16px; font-size:14px;">
                                        <strong style="display:block; margin-bottom:8px;">Next steps</strong>
                                        <ul style="padding-left:18px; margin:0;">
                                            <li style="margin-bottom:6px;">Visit your dashboard for the latest updates.
                                            </li>
                                            <li style="margin-bottom:6px;">Complete your profile to help teammates know
                                                you.</li>
                                            <li style="margin-bottom:0;">Need help? Contact your supervisor or IT
                                                support.</li>
                                        </ul>
                                    </td>
                                </tr>
                            </table>

                            <!-- CTA button -->
                            <table role="presentation" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="center" bgcolor="#0d6efd" style="border-radius:4px;">
                                        <a href="{{ config('app.url') }}/dashboard"
                                            style="display:inline-block; padding:12px 24px; color:#fff; text-decoration:none; font-size:16px;">
                                            Go to My Dashboard
                                        </a>

                                    </td>
                                </tr>
                            </table>

                            <!-- Security notice -->
                            <p style="margin-top:32px; font-size:13px; color:#6c757d;">
                                If you did not request this password change, please reset your password immediately or
                                contact the administrator.
                            </p>

                            <!-- Signature -->
                            <p style="margin:0; font-size:14px;">Thanks,<br><strong>{{ config('app.name') }}
                                    Support</strong></p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background:#f8f9fa; padding:16px 40px; font-size:12px; color:#6c757d;">
                            If the button above doesn’t work, copy and paste the following URL into your browser:<br>
                            <a href="{{ config('app.url') }}/dashboard"
                                style="color:#0d6efd;">{{ config('app.url') }}/dashboard</a>
                        </td>
                    </tr>
                </table>
                <!-- /Card -->

            </td>
        </tr>
    </table>
</body>

</html>
