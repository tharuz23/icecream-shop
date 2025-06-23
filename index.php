<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>ScoopNest - Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-image: url('index.jpg.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      position: relative;
      overflow-x: hidden;
      min-height: 100vh;
    }

    header {
      background-color: #ff85a2;
      padding: 15px 30px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      box-shadow: 0 4px 12px rgba(255, 182, 193, 0.4);
      z-index: 10;
      position: relative;
    }

    .nav-group {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .logo {
      height: 60px;
      width: auto;
    }

    .brand-title {
      font-size: 2.2rem;
      font-weight: 800;
      color: white;
    }

    .nav-center {
      flex-grow: 1;
      text-align: center;
    }

    nav a {
      color: white;
      text-decoration: none;
      margin: 0 10px;
      font-weight: 600;
      font-size: 1.1rem;
    }

    nav a:hover {
      text-decoration: underline;
    }

    .hero {
      background: rgba(255, 248, 240, 0.95);
      padding: 80px 30px;
      text-align: center;
      border-radius: 16px;
      max-width: 800px;
      margin: 80px auto;
      box-shadow: 0 8px 15px rgba(255, 182, 193, 0.3);
      position: relative;
      z-index: 5;
    }

    .hero h2 {
      color: #d6336c;
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 20px;
    }

    .hero p {
      font-size: 1.3rem;
      color: #a61e4d;
      margin-bottom: 30px;
    }

    .hero button {
      background-color: #ff69b4;
      border: none;
      padding: 12px 30px;
      font-size: 1.1rem;
      color: white;
      border-radius: 10px;
      font-weight: 600;
      box-shadow: 0 6px 12px rgba(255, 105, 180, 0.4);
      transition: background-color 0.3s ease;
      cursor: pointer;
    }

    .hero button:hover {
      background-color: rgb(210, 112, 164);
    }

    .icecream-drop {
      position: fixed;
      top: -50px;
      font-size: 30px;
      opacity: 0.8;
      pointer-events: none;
      user-select: none;
      animation-name: drop;
      animation-timing-function: linear;
      animation-iteration-count: infinite;
      z-index: 1000;
    }

    .drop1 { left: 10%; animation-duration: 7s; animation-delay: 0s; }
    .drop2 { left: 30%; animation-duration: 6s; animation-delay: 1.5s; }
    .drop3 { left: 50%; animation-duration: 8s; animation-delay: 0.7s; }
    .drop4 { left: 70%; animation-duration: 5.5s; animation-delay: 2.3s; }
    .drop5 { left: 85%; animation-duration: 7.5s; animation-delay: 1s; }

    @keyframes drop {
      0% { transform: translateY(0) rotate(0deg); opacity: 0; }
      10% { opacity: 1; }
      100% { transform: translateY(110vh) rotate(360deg); opacity: 0; }
    }
  </style>
</head>
<body>

  <header>
    <div class="nav-group">
      <img src="logo.jpg.jpg" alt="ScoopNest Logo" class="logo" />
      <span class="brand-title">ScoopNest</span>
    </div>
    <div class="nav-center"></div>
    <nav>
      <a href="index.php">Home</a>
      <a href="menu.php">Menu</a>
      <a href="order.php">Order Now</a>
      <a href="about.php">About</a>
      <a href="contact.php">Contact</a>
    </nav>
  </header>

  <main class="hero">
    <h2>Chill with our dreamy scoops!</h2>
    <p>Order your favorite flavor now with just a few clicks!</p>
    <button onclick="window.location.href='menu.php'">Explore Flavors</button>
  </main>

  <div class="icecream-drop drop1">🍦</div>
  <div class="icecream-drop drop2">🍧</div>
  <div class="icecream-drop drop3">🍨</div>
  <div class="icecream-drop drop4">🍦</div>
  <div class="icecream-drop drop5">🍧</div>

</body>
</html>
