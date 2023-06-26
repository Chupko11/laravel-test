<!DOCTYPE html>
<html>
<head>
  <style>
    body {
      font-family: Arial, sans-serif;
      line-height: 1.5;
    }

    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
    }

    .header {
      background-color: #f2f2f2;
      padding: 10px;
      text-align: center;
    }

    h1 {
      color: #333333;
      margin: 0;
    }

    .content {
      background-color: #ffffff;
      padding: 20px;
    }

    .button {
      display: inline-block;
      background-color: #2a25be;
      color: #ffffff;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 4px;
    }

    .button:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>Reset Your Password</h1>
    </div>
    <div class="content">
      <p>Dear {{ $user->name }},</p>
      <p>We received a request to reset the password for your account. To proceed with the password reset, please click the button below:</p>
      <p><a class="button" href="{{ route('author.resetPassword') }}">Reset Password</a></p>
      <p>If you didn't request a password reset, you can safely ignore this email. Your current password will remain unchanged.</p>
      <p>For security reasons, this password reset link will expire in [expiration time]. If the link is no longer valid, you can request another password reset by visiting our website.</p>
      <p>Please note that this is an automated message. If you have any questions or need further assistance, please contact our support team at [support email].</p>
      <p>Thank you,<br>
      The [Your Company] Team</p>
    </div>
  </div>
</body>
</html>
