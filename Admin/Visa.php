<!DOCTYPE html>
<html>
  <head>
    <title>MyProgrammingBook</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <style>
    * {
  box-sizing: border-box;
}

body {
  background-color: #f5f5f5;
  font-family: Arial, sans-serif;
}

.product-container {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
  background-color: #fff;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  display: flex;
  flex-wrap: wrap;
}

.product-image-container {
  width: 30%;
}

.product-info-container {
  width: 70%;
  padding-left: 20px;
}

img {
  width: 100%;
  height: auto;
}

form {
  display: flex;
  flex-wrap: wrap;
}

label, input[type="text"] {
  width: 100%;
  padding: 12px;
  margin-top: 8px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
}

label {
  width: 30%;
  padding-right: 10px;
}
input[type="text"] {
  width: 70%;
}

input[type="button"] {
  background-color: #ff5722;
  color: #fff;
  padding: 12px 24px;
  border: none;
  cursor: pointer;
  margin-top: 20px;
  width: 100%;
}

input[type="text"][name="card-number"], input[type="text"][name="expiry-date"], input[type="text"][name="cvv"] {
  width: 30%;
}


h1 {
  margin-top: 0;
}

.price {
  color: #ff5722;
  font-size: 1.5em;
  font-weight: bold;
}
  </style>
  <body>
    <div class="product-container">
      <div class="product-image-container">
        <img src="myprogrammingbook.jpg" alt="MyProgrammingBook">
      </div>
      <div class="product-info-container">
        <h1>MyProgrammingBook</h1>
        <p class="price">$0.99</p>
        <p class="product-description">
          Want to make all of your code run at O(1) speed? Then let me introduce MyProgrammingBook! Written by the world's leading expert on algorithmic optimization (me), this book will teach you everything you need to know to make your code lightning fast. Plus, it comes with a free unicorn* to help you implement all the techniques you learn. Don't miss out on this once-in-a-lifetime opportunity!
        </p>
        <p>*Terms and Conditions Apply</p>
      </div>
      <form>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required>
        <div class="card-info">
          <label for="card-number">Card Number:</label>
          <input type="text" id="card-number" name="card-number" required>
        </div>
        <div class="card-info">
          <label for="expiry-date">Expiry Date:</label>
          <input type="text" id="expiry-date" name="expiry-date" required>
          <label for="cvv">CVV:</label>
          <input type="text" id="cvv" name="cvv" required>
        </div>
        <input type="button" value="Buy Now" onclick="submitForm()">
</form>
    </div>
    
    <script>
        // Get references to the form elements
const form = document.getElementById("payment-form");
const cardNumber = document.getElementById("card-number");
const expiryDate = document.getElementById("expiry-date");
const cvv = document.getElementById("cvv");
const submitButton = document.getElementById("submit-button");

// Handle form submission
form.addEventListener("submit", (event) => {
  event.preventDefault();

  // Disable the submit button to prevent multiple submissions
  submitButton.disabled = true;

  // Create an object to hold the form data
  const formData = {
    cardNumber: cardNumber.value,
    expiryDate: expiryDate.value,
    cvv: cvv.value,
  };

  // Perform client-side validation on the form data
  if (!validateFormData(formData)) {
    // If the data is invalid, re-enable the submit button and return
    submitButton.disabled = false;
    return;
  }

  // Send the form data to the server
  // The following is just an example and should not be used in a real-world scenario
  // as it lacks security measures and proper payment gateway integration
  fetch("/charge", {
    method: "POST",
    body: JSON.stringify(formData),
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((response) => response.json())
    .then((data) => {
      // Handle the server response
      if (data.success) {
        // Payment was successful
        alert("Payment successful!");
      } else {
        // Payment failed
        alert("Payment failed. Please try again.");
        submitButton.disabled = false;
      }
    })
    .catch((error) => {
      console.error(error);
      alert("An error occurred. Please try again.");
      submitButton.disabled = false;
    });
});

function validateFormData(data) {
  // Example validation checks
  if (!data.cardNumber || data.cardNumber.length !== 16) {
    alert("Please enter a valid card number.");
    return false;
  }
  if (!data.expiryDate || data.expiryDate.length !== 5) {
    alert("Please enter a valid expiry date in the format MM/YY.");
    return false;
  }
  if (!data.cvv || data.cvv.length !== 3) {
    alert("Please enter a valid CVV.");
    return false;
  }
  return true;
}
    </script>
  </body>
</html>