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
      <h1>Thank you for registration</h1>
    </div>
    <div class="content">
      <p>Dear {{ $user->name }},</p>
      <p>You have successfuly registered to our blog page!!</p>
      <p>Thank you,<br>
      The [Your Company] Team</p>
    </div>
  </div>
</body>
</html>
