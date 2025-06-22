<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Menu - ScoopNest</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #fff0f6;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .container {
      background: #fff8f0;
      border-radius: 12px;
      padding: 40px;
      margin-top: 60px;
      box-shadow: 0 8px 15px rgba(255, 182, 193, 0.3);
      max-width: 700px;
    }
    h2 {
      color: #d6336c;
      font-weight: 700;
      margin-bottom: 30px;
      text-align: center;
    }
    .menu {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
      gap: 20px;
    }
    .item {
      background-color: #ffdef2;
      padding: 15px;
      border-radius: 10px;
      text-align: center;
      font-weight: bold;
      color: #a61e4d;
      box-shadow: 0 4px 10px rgba(255, 182, 193, 0.3);
      transition: transform 0.3s ease;
    }
    .item:hover {
      transform: scale(1.05);
      background-color: #ffc2e0;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>🍨 Our Flavors</h2>
    <div class="menu">
      <div class="item">VanillaClassic Vanilla Dream</div>
      <div class="item">Rich Chocolate Fudge</div>
      <div class="item">Sweet Strawberry Swirl</div>
      <div class="item">Fresh Minty Chip</div>
      <div class="item">Cookies & Cream Delight</div>
      <div class="item">Buttery Pecan Crunch</div>
      <div class="item">Rocky Road Adventure</div>
      <div class="item">Bold Coffee Brew</div>
      <div class="item">Tropical Mango Bliss</div>
      <div class="item">Nutty Pistachio Crunch</div>
    </div>
  </div>
</body>
</html>
