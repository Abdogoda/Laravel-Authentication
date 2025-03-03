<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Link</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #1f2937;
      color: #f9fafb;
      text-align: center;
      padding: 2rem;
    }
    .container {
      background-color: #111827;
      padding: 2rem;
      border-radius: 8px;
      max-width: 500px;
      margin: auto;
      color: #f9fafb;
    }
    .button {
      display: inline-block;
      padding: 1rem 2rem;
      background-color: #3b82f6;
      color: #ffffff;
      border-radius: 5px;
      text-decoration: none;
      font-weight: bold;
      margin-top: 1rem;
    }
    .button:hover {
      background-color: #2563eb;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1 style="font-size: 24px; margin-bottom: 1rem;">Your Passwordless Login Link</h1>
    <p style="font-size: 16px; line-height: 1.5;">
      Hi, <br>
      Click the button below to securely log into your account.
    </p>
    <a href="{{ $loginLink }}" class="button">Login Now</a>
    <p style="margin-top: 2rem; font-size: 14px; color: #9ca3af;">
      This link is valid for a limited time and can only be used once.
    </p>
    
    <div class="footer">
      <p>If the button above does not work, copy and paste the following link into your browser:</p>
      <p>{{ $loginLink }}</p>
    </div>
  </div>
</body>
</html>
