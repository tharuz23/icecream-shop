<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact - ScoopNest</title>
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

    .contact-box {
      max-width: 800px;
      background-color: rgba(255, 248, 240, 0.95);
      margin: 60px auto;
      padding: 40px 30px;
      border-radius: 16px;
      box-shadow: 0 8px 15px rgba(255, 182, 193, 0.3);
    }

    .contact-box h2 {
      color: #d6336c;
      font-size: 2.3rem;
      margin-bottom: 25px;
      text-align: center;
    }

    .contact-box label {
      font-weight: 600;
      color: #d6336c;
    }

    .contact-box input,
    .contact-box textarea {
      width: 100%;
      padding: 10px;
      border: 2px solid #d6336c;
      border-radius: 10px;
      margin-bottom: 20px;
      font-size: 1rem;
    }

    .contact-box button {
      background-color: #ff69b4;
      color: white;
      font-weight: bold;
      padding: 12px 25px;
      border: none;
      border-radius: 12px;
      font-size: 1.1rem;
      display: block;
      margin: 0 auto;
      cursor: pointer;
    }

    .contact-box button:hover {
      background-color: #d6336c;
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

  <div class="contact-box">
    <h2>Contact Us</h2>
    <form action="#" method="post">
      <label for="name">Your Name</label>
      <input type="text" id="name" name="name" placeholder="Enter your name" required />

      <label for="email">Your Email</label>
      <input type="email" id="email" name="email" placeholder="Enter your email" required />

      <label for="message">Message</label>
      <textarea id="message" name="message" rows="5" placeholder="Write your message here..." required></textarea>

      <button type="submit">Send Message</button>
    </form>
  </div>

</body>
</html>
