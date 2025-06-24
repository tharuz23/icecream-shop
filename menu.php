<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Menu - ScoopNest</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: url('menu1.jpg.webp') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
    }
    .container {
      background: rgba(255, 248, 240, 0.7);
      border-radius: 12px;
      padding: 60px;
      margin: 60px auto 100px auto;
      box-shadow: 0 8px 15px rgba(255, 182, 193, 0.3);
      max-width: 900px;
      text-align: center;
    }
    h2 {
      color: #d6336c;
      font-weight: 700;
      margin-bottom: 30px;
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
      font-weight: bold;
      color: #a61e4d;
      box-shadow: 0 4px 10px rgba(255, 182, 193, 0.3);
      transition: transform 0.3s ease;
    }
    .item:hover {
      transform: scale(1.05);
      background-color: #ffc2e0;
    }
    .item a {
      display: inline-block;
      margin-top: 10px;
      padding: 6px 12px;
      background-color: #d6336c;
      color: white;
      text-decoration: none;
      border-radius: 6px;
      font-size: 14px;
    }
    .item a:hover {
      background-color: #b02a5b;
    }
    .btn-home {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background-color: #d6336c;
      border: none;
      color: #fff;
      font-weight: 600;
      padding: 10px 25px;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(230, 132, 99, 0.5);
      text-decoration: none;
      display: inline-block;
      z-index: 1000;
    }
    .btn-home:hover {
      background-color: rgb(222, 104, 145);
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>🍨 Our Flavors</h2>
    <div class="menu">
      <?php
        $flavors = [
          "Classic Vanilla Dream" => 150,
          "Rich Chocolate Fudge" => 180,
          "Sweet Strawberry Swirl" => 170,
          "Fresh Minty Chip" => 160,
          "Cookies & Cream Delight" => 200,
          "Buttery Pecan Crunch" => 190,
          "Rocky Road Adventure" => 210,
          "Bold Coffee Brew" => 180,
          "Tropical Mango Bliss" => 160,
          "Nutty Pistachio Crunch" => 220,
          "Golden Salted Caramel" => 230,
          "Blueberry Cream Crumble" => 210,
          "Red Velvet Bliss" => 200,
          "Tiramisu Temptation" => 250,
          "Summer Peach Dream" => 180,
          "Coconut Snowflake" => 190,
          "Black Cherry Bomb" => 220,
          "Matcha Magic" => 240,
          "Choco Dough Delight" => 210,
          "Brownie Fudge Burst" => 260,
          "Raspberry Rush" => 200,
          "Lemon Zing Sorbet" => 170,
          "Apple Pie Scoop" => 190,
          "Nutty Buttercup" => 210,
          "Hazelnut Heaven" => 220
        ];

        foreach ($flavors as $flavorName => $price) {
          echo '<div class="item">' . htmlspecialchars($flavorName) . '<br>Rs. ' . $price . '<br>';
          echo '<a href="order.php?flavor=' . urlencode($flavorName) . '&price=' . $price . '">Order Now</a></div>';
        }
      ?>
    </div>
  </div>
  <a href="index.php" class="btn-home">Back to Home</a>
</body>
</html>
