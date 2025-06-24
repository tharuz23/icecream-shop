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
    .logo {
      height: 70px;
      margin-bottom: 25px;
    }
    h2 {
      color: #d6336c;
      font-weight: 700;
      margin-bottom: 30px;
    }
    .menu {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
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
    .price {
      font-size: 16px;
      color: #b02a5b;
      font-weight: 600;
      margin-top: 5px;
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
    <img src="logo.jpg.jpg" alt="ScoopNest Logo" class="logo">
    <h2>🍨 Our Flavors</h2>
    <div class="menu">
      <?php
        $flavors = [
          "Classic Vanilla Dream" => "Rs. 450",
          "Rich Chocolate Fudge" => "Rs. 500",
          "Sweet Strawberry Swirl" => "Rs. 480",
          "Fresh Minty Chip" => "Rs. 470",
          "Cookies & Cream Delight" => "Rs. 520",
          "Buttery Pecan Crunch" => "Rs. 550",
          "Rocky Road Adventure" => "Rs. 530",
          "Bold Coffee Brew" => "Rs. 500",
          "Tropical Mango Bliss" => "Rs. 490",
          "Nutty Pistachio Crunch" => "Rs. 550",
          "Golden Salted Caramel" => "Rs. 520",
          "Blueberry Cream Crumble" => "Rs. 540",
          "Red Velvet Bliss" => "Rs. 560",
          "Tiramisu Temptation" => "Rs. 580",
          "Summer Peach Dream" => "Rs. 490",
          "Coconut Snowflake" => "Rs. 470",
          "Black Cherry Bomb" => "Rs. 510",
          "Matcha Magic" => "Rs. 560",
          "Choco Dough Delight" => "Rs. 520",
          "Brownie Fudge Burst" => "Rs. 550",
          "Raspberry Rush" => "Rs. 490",
          "Lemon Zing Sorbet" => "Rs. 460",
          "Apple Pie Scoop" => "Rs. 530",
          "Nutty Buttercup" => "Rs. 550",
          "Hazelnut Heaven" => "Rs. 570"
        ];

        foreach ($flavors as $flavor => $price) {
          echo '<div class="item">' . $flavor . '<div class="price">' . $price . '</div><a href="order.php?flavor=' . urlencode($flavor) . '">Order Now</a></div>';
        }
      ?>
    </div>
  </div>
  <a href="index.php" class="btn-home">Back to Home</a>
</body>
</html>
