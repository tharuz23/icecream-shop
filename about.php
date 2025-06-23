<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>About - ScoopNest</title>
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
    }

    header {
      background-color: #ff85a2;
      padding: 15px 30px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      box-shadow: 0 4px 12px rgba(255, 182, 193, 0.4);
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

    .content {
      max-width: 800px;
      background-color: rgba(255, 248, 240, 0.95);
      margin: 60px auto;
      padding: 40px 30px;
      border-radius: 16px;
      box-shadow: 0 8px 15px rgba(255, 182, 193, 0.3);
      text-align: center;
    }

    .content h2 {
      color: #d6336c;
      font-size: 2.3rem;
      margin-bottom: 20px;
    }

    .content p {
      font-size: 1.2rem;
      color: #a61e4d;
      line-height: 1.7;
    }
  </style>
</head>
<body>

  <header>
    <div class="nav-group">
      <img src="logo.jpg.jpg" alt="ScoopNest Logo" class="logo" />
      <span class="brand-title">ScoopNest</span>
    </div>
    <nav>
      <a href="index.php">Home</a>
      <a href="menu.php">Menu</a>
      <a href="order.php">Order Now</a>
      <a href="about.php">About</a>
      <a href="contact.php">Contact</a>
    </nav>
  </header>

  <div class="content">
    <h2>About ScoopNest</h2>
    <p>
      At ScoopNest, we believe that every scoop tells a story — of joy, of flavor, and of unforgettable memories. 
      Our journey began with a simple dream: to bring handcrafted ice cream and desserts to every heart in town. 
      Whether you're a fan of creamy classics or adventurous new blends, we've got a flavor for you!
    </p>
  </div>

</body>
</html>
