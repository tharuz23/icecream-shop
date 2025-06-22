<form action="payment.php" method="POST">
  <label for="name">Your Name:</label>
  <input type="text" name="name" required>

  <label for="flavor">Choose a Flavor:</label>
  <select name="flavor" required>
    <option disabled selected hidden>-- Select a Flavor --</option>
    <option>Classic Vanilla Dream</option>
    <option>Rich Chocolate Fudge</option>
    <option>Sweet Strawberry Swirl</option>
    <option>Fresh Minty Chip</option>
    <option>Cookies & Cream Delight</option>
    <option>Buttery Pecan Crunch</option>
    <option>Rocky Road Adventure</option>
    <option>Bold Coffee Brew</option>
    <option>Tropical Mango Bliss</option>
    <option>Nutty Pistachio Crunch</option>
  </select>

  <label for="quantity">Quantity:</label>
  <input type="number" name="quantity" min="1" required>

  <label for="payment_method">Payment Method:</label>
  <select name="payment_method" id="payment_method" required onchange="toggleCardFields()">
    <option disabled selected hidden>-- Select Payment Method --</option>
    <option value="Cash">Cash</option>
    <option value="Card">Card</option>
  </select>

  <div id="cardFields" style="display: none;">
    <label>Cardholder Name:</label>
    <input type="text" name="card_holder">

    <label>Card Number:</label>
    <input type="text" name="card_number">
  </div>

  <button type="submit">Complete Order</button>
</form>

<script>
  function toggleCardFields() {
    var method = document.getElementById("payment_method").value;
    document.getElementById("cardFields").style.display = method === "Card" ? "block" : "none";
  }
</script>
