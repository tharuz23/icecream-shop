<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Thank You - ScoopNest</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
      background-image: url('bg1.jpg.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      background-attachment: fixed;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .message-box {
      background-color: rgba(255, 248, 240, 0.85);
      padding: 40px 60px;
      border-radius: 20px;
      text-align: center;
      box-shadow: 0 12px 25px rgba(214, 51, 108, 0.3);
    }
    .logo {
      width: 90px;
      height: auto;
      margin-bottom: 20px;
    }
    h2 {
      color: #d6336c;
      font-size: 2rem;
      margin-bottom: 25px;
    }
    button {
      background-color: #d6336c;
      color: white;
      padding: 12px 28px;
      border: none;
      border-radius: 12px;
      font-size: 1.1rem;
      font-weight: bold;
      cursor: pointer;
      box-shadow: 0 6px 12px rgba(214, 51, 108, 0.5);
      margin-top: 25px;
    }
    button:hover {
      background-color: #b12756;
    }
    .feedback-image {
      width: 250px;
      height: auto;
      margin: 0 auto;
      display: block;
      border-radius: 15px;
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }
  </style>
</head>
<body>
  <div class="message-box">
    <img src="logo.jpg.jpg" alt="ScoopNest Logo" class="logo" />
    <h2>Thank you for your feedback!</h2>
    <img src="fb.jpg.webp" class="feedback-image" alt="Feedback Art" />
    <button onclick="window.location.href='index.php'">Back to Home</button>
  </div>
</body>
</html>
