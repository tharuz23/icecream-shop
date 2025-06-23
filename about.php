<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>About - ScoopNest</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-image: url('index.jpg.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      overflow-x: hidden;
      background-attachment: fixed;
      position: relative;
    }
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      position: relative;
      z-index: 0;
    }
    .container-box {
      max-width: 900px;
      background-color: rgba(255, 248, 240, 0.95);
      padding: 50px 40px;
      border-radius: 20px;
      box-shadow: 0 12px 25px rgba(214, 51, 108, 0.3);
      text-align: center;
      position: relative;
      z-index: 2;
    }
    h2 {
      font-size: 3rem;
      font-weight: 900;
      margin-bottom: 30px;
      letter-spacing: 2px;
      color: #d6336c;
      text-shadow: 1px 1px 3px rgba(214, 51, 108, 0.6);
    }
    p {
      font-size: 1.4rem;
      line-height: 1.8;
      font-weight: 600;
      margin-bottom: 40px;
      max-width: 700px;
      margin-left: auto;
      margin-right: auto;
      color: #a61e4d;
      text-shadow: 0 0 5px #ffb6c1;
    }
    button {
      background-color: #d6336c;
      color: white;
      font-weight: 700;
      border: none;
      border-radius: 15px;
      padding: 14px 36px;
      font-size: 1.2rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
      box-shadow: 0 6px 12px rgba(214, 51, 108, 0.5);
    }
    button:hover {
      background-color: #b12756;
    }

    .icecream-drop {
      position: fixed;
      top: -60px;
      font-size: 32px;
      opacity: 0.85;
      pointer-events: none;
      user-select: none;
      animation-name: drop;
      animation-timing-function: linear;
      animation-iteration-count: infinite;
      z-index: 9999;
    }

    .drop1 { left: 10%; animation-duration: 7s; animation-delay: 0s; }
    .drop2 { left: 25%; animation-duration: 6.5s; animation-delay: 1s; }
    .drop3 { left: 40%; animation-duration: 8s; animation-delay: 0.5s; }
    .drop4 { left: 60%; animation-duration: 7.2s; animation-delay: 1.7s; }
    .drop5 { left: 75%; animation-duration: 5.8s; animation-delay: 0.9s; }
    .drop6 { left: 90%; animation-duration: 6.7s; animation-delay: 1.2s; }

    @keyframes drop {
      0% { transform: translateY(0) rotate(0deg); opacity: 0; }
      10% { opacity: 1; }
      100% { transform: translateY(120vh) rotate(360deg); opacity: 0; }
    }
  </style>
</head>
<body>
  <div class="container-box">
    <h2>About ScoopNest</h2>
    <p>
      Welcome to ScoopNest, your ultimate destination for irresistible ice cream delights.
      We craft each scoop with passion and precision, blending traditional recipes with innovative flavors.
      Our commitment is to bring you moments of pure joy and refreshment, served in every cone or cup.
      Join us in celebrating the art of ice cream and create sweet memories that last a lifetime.
    </p>
    <button onclick="window.location.href='index.php'">Back to Home</button>
  </div>

  <div class="icecream-drop drop1">🍦</div>
  <div class="icecream-drop drop2">🍧</div>
  <div class="icecream-drop drop3">🍨</div>
  <div class="icecream-drop drop4">🍦</div>
  <div class="icecream-drop drop5">🍧</div>
  <div class="icecream-drop drop6">🍨</div>
</body>
</html>
