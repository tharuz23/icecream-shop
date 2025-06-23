<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>ScoopNest - Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #fff0f6;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
    }

    header {
      background-color: #ff85a2;
      padding: 20px 0;
      text-align: center;
      box-shadow: 0 4px 12px rgba(255, 182, 193, 0.4);
    }

    header h1 {
      color: white;
      font-size: 2rem;
      font-weight: bold;
      margin: 0;
    }

    nav {
      margin-top: 10px;
    }

    nav a {
      color: white;
      text-decoration: none;
      margin: 0 15px;
      font-weight: 600;
    }

    nav a:hover {
      text-decoration: underline;
    }

    .hero {
      background: #fff8f0;
      padding: 80px 30px;
      text-align: center;
      border-radius: 16px;
      max-width: 800px;
      margin: 60px auto;
      box-shadow: 0 8px 15px rgba(255, 182, 193, 0.3);
    }

    .hero h2 {
      color: #d6336c;
      font-size: 2rem;
      font-weight: 700;
      margin-bottom: 30px;
    }

    .hero button {
      background-color: #ff69b4;
      border: none;
      padding: 12px 30px;
      font-size: 1rem;
      color: white;
      border-radius: 10px;
      font-weight: 600;
      box-shadow: 0 6px 12px rgba(255, 105, 180, 0.4);
      transition: background-color 0.3s ease;
    }

    .hero button:hover {
      background-color: rgb(210, 112, 164);
    }
  </style>
</head>
<body>
  <header>
    <h1>🍦 Welcome to ScoopNest!</h1>
    <nav>
      <a href="index.php">Home</a>
      <a href="menu.php">Menu</a>
      <a href="order.php">Order Now</a>
    </nav>
  </header>

  <main class="hero">
    <h2>Chill with our dreamy scoops!</h2>
    <button onclick="window.location.href='menu.php'">Explore Flavors</button>
  </main>
</body>
</html>
