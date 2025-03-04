<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
</head>
<body style="background-color: #1f2937; color: #e5e7eb; font-family: Arial, sans-serif; padding: 20px;">

    <table align="center" width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; background-color: #111827; padding: 20px; border-radius: 8px;">
        <tr>
            <td align="center" style="padding-bottom: 20px;">
                <h2 style="color: #10b981; font-size: 24px; margin: 0;">Reset Your Password</h2>
            </td>
        </tr>
        
        <tr>
            <td style="padding: 20px; color: #d1d5db;">
                <p>Hello,</p>
                <p>You requested to reset your password. Click the button below to create a new password:</p>
                <p style="text-align: center; margin: 20px 0;">
                    <a href="{{ $resetUrl }}" style="background-color: #3b82f6; color: #ffffff; padding: 10px 20px; text-decoration: none; border-radius: 4px; font-weight: bold;">
                        Reset Password
                    </a>
                </p>
                <p>If you did not request a password reset, please ignore this email.</p>
                <p>Thank you,<br>Your Application Team</p>
            </td>
        </tr>

        <tr>
            <td align="center" style="padding-top: 20px; font-size: 12px; color: #9ca3af;">
                <p>If the button above does not work, copy and paste the following link into your browser:</p>
                <p>{{ $resetUrl }}</p>
            </td>
        </tr>
    </table>

</body>
</html>
