<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = $_POST['name'];
  $feedback_type = $_POST['feedback_type'];
  $message = $_POST['message'];

  $stmt = $conn->prepare("INSERT INTO messages (name, feedback_type, message) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $name, $feedback_type, $message);
  if ($stmt->execute()) {
    header("Location: thankyou_contact.php");
    exit();
  }
  $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Contact - ScoopNest</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <style>
    html, body {
      height: 100%;
      margin: 0; padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-image: url('bg1.jpg.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      background-attachment: fixed;
      overflow-x: hidden;
    }
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }
    .contact-box {
      max-width: 700px;
      background-color: rgba(255, 248, 240, 0.7);
      padding: 25px 30px;
      border-radius: 20px;
      box-shadow: 0 12px 25px rgba(214, 51, 108, 0.3);
      overflow-y: auto;
      position: relative;
    }
    .logo {
      height: 60px;
      width: auto;
      display: block;
      margin: 0 auto 20px;
    }
    .top-header {
      font-size: 2.8rem;
      font-weight: 900;
      color: #d6336c;
      text-align: center;
      margin-bottom: 30px;
    }
    .scoop-info-row {
      display: flex;
      justify-content: center;
      gap: 40px;
      font-size: 1.05rem;
      font-weight: 600;
      color: #a61e4d;
      margin-bottom: 20px;
      flex-wrap: nowrap;
    }
    .scoop-info-row a, .scoop-info-row div {
      display: flex;
      align-items: center;
      color: #a61e4d;
      text-decoration: none;
      gap: 6px;
      min-width: 120px;
      justify-content: center;
    }
    .scoop-info-row i {
      color: #d6336c;
      font-size: 1.25rem;
    }
    label {
      font-weight: 600;
      color: #d6336c;
      font-size: 1.05rem;
    }
    input, textarea, select {
      width: 100%;
      padding: 9px;
      border: 2px solid #d6336c;
      border-radius: 12px;
      margin-bottom: 14px;
      font-size: 1rem;
    }
    button {
      background-color: #d6336c;
      color: white;
      font-weight: 700;
      padding: 11px 28px;
      border: none;
      border-radius: 12px;
      font-size: 1.1rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
      box-shadow: 0 6px 12px rgba(214, 51, 108, 0.5);
      display: block;
      margin: 0 auto 18px;
    }
    button:hover {
      background-color: #b12756;
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
      cursor: pointer;
      z-index: 1000;
    }
    .btn-home:hover {
      background-color: rgb(222, 104, 145);
    }
  </style>
</head>
<body>
  <div class="contact-box">
    <img src="logo.jpg.jpg" alt="ScoopNest Logo" class="logo" />
    <div class="top-header">Contact Us</div>

    <div class="scoop-info-row">
      <a href="https://www.instagram.com/scoopnest.icecream" target="_blank"><i class="fab fa-instagram"></i>@scoopnest.icecream</a>
      <a href="https://www.facebook.com/scoopnest.icecream" target="_blank"><i class="fab fa-facebook"></i>ScoopNest</a>
      <a href="https://www.tiktok.com/@scoopnest.icecream" target="_blank"><i class="fab fa-tiktok"></i>@scoopnest.icecream</a>
    </div>
    <div class="scoop-info-row">
      <div><i class="fas fa-phone"></i>+94 71 234 5678</div>
      <div><i class="fas fa-envelope"></i>hello@scoopnest.com</div>
    </div>

    <form method="post">
      <label for="name">Your Name</label>
      <input type="text" id="name" name="name" required />
      <label for="feedback_type">Type of Feedback</label>
      <select id="feedback_type" name="feedback_type" required>
        <option value="">Choose...</option>
        <option value="General Inquiry">💬 General Inquiry</option>
        <option value="Product Feedback">🌟 Product Feedback</option>
        <option value="Delivery Feedback">🚚 Delivery Feedback</option>
        <option value="Complaint">😟 Complaint</option>
        <option value="Compliment">🙌 Compliment</option>
      </select>
      <label for="message">Message</label>
      <textarea id="message" name="message" rows="4" required></textarea>
      <button type="submit">Send Message</button>
    </form>
  </div>
  <a href="index.php" class="btn-home">Back to Home</a>
</body>
</html>
