<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>About - ScoopNest</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-image: url('bg1.jpg.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      background-attachment: fixed;
      overflow-x: hidden;
    }

    .about-box {
      max-width: 900px;
      background-color: rgba(255, 248, 240, 0.95);
      padding: 50px 40px;
      border-radius: 20px;
      box-shadow: 0 12px 25px rgba(214, 51, 108, 0.3);
      text-align: center;
      margin: 80px auto;
    }

    .logo {
      height: 60px;
      margin-bottom: 20px;
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
      font-size: 1.3rem;
      line-height: 1.9;
      font-weight: 500;
      margin-bottom: 40px;
      color: #a61e4d;
      text-shadow: 0 0 5px #ffb6c1;
      text-align: justify;
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
  </style>
</head>
<body>
  <div class="about-box">
    <img src="logo.jpg.jpg" alt="ScoopNest Logo" class="logo">
    <h2>About ScoopNest</h2>
    <p>
      At ScoopNest, ice cream is more than a dessert it's an experience. Founded with a dream to bring flavor, joy, and artistry together in a single scoop, ScoopNest is dedicated to delivering handcrafted ice cream that not only tastes amazing but also tells a story.
    </p>
    <p>
      Our journey began with a passion for exploring exotic flavors and combining them with timeless classics. From rich chocolate fudge and creamy vanilla bean to adventurous mango chili and lavender honey, we cater to every craving. Every ingredient we use is sourced with care fresh milk, organic fruits, and natural sweeteners so your indulgence is always wholesome and delightful.
    </p>
    <p>
      We believe in community, creativity, and the magic of moments shared over ice cream. Our vibrant stores are more than places to grab a cone they're cozy hangouts, date spots, and family favorites. With seasonal specials, limited-edition launches, and engaging events, ScoopNest brings something new every time you visit.
    </p>
    <p>
      Whether you're picking up a pint to-go or exploring our latest creations in store, we promise to serve you scoops filled with care, quality, and unforgettable taste. Thank you for making ScoopNest your go-to sweet escape.
    </p>
    <button onclick="window.location.href='index.php'">Back to Home</button>
  </div>
</body>
</html>
