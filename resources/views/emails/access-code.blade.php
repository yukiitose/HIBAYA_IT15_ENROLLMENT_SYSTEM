<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <style>
    body { font-family: Arial, sans-serif; background: #f3f3f3; margin: 0; padding: 0; }
    .container { max-width: 560px; margin: 40px auto; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 16px rgba(0,0,0,0.08); }
    .header { background: #B71C1C; padding: 32px; text-align: center; }
    .header h1 { color: #fff; margin: 0; font-size: 22px; }
    .header p { color: rgba(255,255,255,0.8); margin: 4px 0 0; font-size: 14px; }
    .body { padding: 36px 32px; }
    .body h2 { color: #B71C1C; font-size: 20px; margin: 0 0 12px; }
    .body p { color: #555; font-size: 14px; line-height: 1.7; margin: 0 0 16px; }
    .code-box { background: #fef2f2; border: 2px dashed #B71C1C; border-radius: 12px; padding: 24px; text-align: center; margin: 20px 0; }
    .code { font-size: 42px; font-weight: 900; color: #B71C1C; letter-spacing: 10px; }
    .note { background: #fef2f2; border-left: 4px solid #B71C1C; padding: 12px 16px; border-radius: 4px; color: #991b1b; font-size: 13px; }
    .footer { background: #f9f9f9; padding: 20px 32px; text-align: center; color: #aaa; font-size: 12px; border-top: 1px solid #f0f0f0; }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h1>UM Tagum Portal</h1>
      <p>Tagum Campus</p>
    </div>
    <div class="body">
      <h2>Welcome, {{ $user->name }}!</h2>
      <p>Your account has been registered. Use the access code below to create your password:</p>
      <div class="code-box">
        <div class="code">{{ $accessCode }}</div>
      </div>
      <p>Go to the portal and click <strong>"Create Password"</strong> on the login page, then enter this code along with your email and new password.</p>
      <div class="note">
        ⚠️ Keep this code private. Do not share it with anyone.
      </div>
    </div>
    <div class="footer">
      &copy; {{ date('Y') }} UM Tagum College — Tagum Campus. All rights reserved.
    </div>
  </div>
</body>
</html>