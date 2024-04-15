<?php
require("connection.php");

if (isset($_POST['clearance'])) {
  $fname = $_POST['fname'];
  $mname = $_POST['mname'];
  $lname = $_POST['lname'];
  $payment = $_POST['payment'];
  $reference = $_POST['reference'];
  $tracking_code = strtoupper('BMS' . uniqid());
  $date_req = date("Y-m-d");
  $purpose = $_POST['purpose'];
  $type = $_POST['type'];
  $pickup = $_POST['pickup'];
  $docstatus = $_POST['docstatus'];

  $queryCreate = "INSERT INTO `tbldocument`(`fname`, `mname`, `lname`,`pickup`, `payment`, `reference`,`purpose`,`type`, `date_req`, `docstatus`, `tracking_code` ) VALUES ('$fname','$mname','$lname','$pickup','$payment','$reference','$purpose','$type', '$date_req','$docstatus','$tracking_code')";

  $sqlCreate = mysqli_query($conn, $queryCreate);

  echo "<script>
    window.onload = function() {
      var modal = document.getElementById('myModal');
      var span = document.getElementsByClassName('close')[0];
      var transactionNumber = document.getElementById('transaction-number');
      transactionNumber.innerHTML = '$tracking_code';
      modal.style.display = 'block';
      span.onclick = closeModal;
      window.onclick = function(event) {
        if (event.target == modal) {
          closeModal();
        }
      }
    }
  </script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <title>Barangay Clearance</title>
</head>
<style>
  nav {
    background-color: #850000;
    display: flex;
    justify-content: space-between;
    padding: 1.8rem 5rem;
  }

  a {
    text-decoration: none;
  }

  #home {
    color: white;
  }

  nav a {
    border-bottom: 2px solid transparent;
    padding-bottom: 0.5em;
    transition: all 200ms ease;
    cursor: pointer;
  }

  nav a:hover {
    border-bottom: 2px solid white;
  }

  #loading-screen {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #fff;
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  #loading-screen img {
    height: 100px;
    width: 100px;
  }

  .spinner {
    position: absolute;
    width: 99px;
    height: 99px;
    border-radius: 50%;
    border: 5px solid #850000;
    border-top-color: transparent;
    animation: spin 1s ease-in-out infinite;
  }

  @keyframes spin {
    from {
      transform: rotate(0deg);
    }

    to {
      transform: rotate(360deg);
    }
  }
</style>

<body>

  <!-- nav -->
  <nav>
    <div id="home">
      <h5>BMS</h5>
    </div>
    <div>
      <a href="../index.php" class="text-white">HOME</a>
    </div>
  </nav>
  <!-- end of nav -->
  <div id="loading-screen">
    <img src="../images/Mapulang-Lupa.png" alt="loading">
    <div class="spinner">
    </div>
  </div>
  <div class="container mt-lg-5 mt-3 rounded-2">
    <div class="row p-lg-4 row-cols-12">
      <!-- gcash -->
      <div class="card p-2 col-md-6 mx-auto col-2 mb-4" style="width: 18rem; height: auto;">
        <h4 class="text-primary md-text-danger text-center">GCash Payment</h4>
        <img src="../images/qrcode.png" class="card-img-top" alt="..." />
        <div class="card-body">
          <p class="card-text text-primary">Amount: ₱100.00</p>
          <p class="card-text text-primary">GCash No: 09992838478</p>
        </div>
      </div>
      <!-- form -->
      <div class="alert alert-danger d-none" role="alert" id="alert">
        <i class="fas fa-exclamation-circle me-2"></i>
        <span id="alert-message"></span>
      </div>
      <!-- form -->
      <form action="brgyClearance.php" method="POST" onsubmit="return validateForm()" class="border border-2 p-4 h-100 rounded-2 formA bg-light col-lg-9 col-12">
        <div>
          <h1 class="pb-5" style="color:#850000;">Barangay Clearance Form</h1>
          <p>Fill out all the necessary informations.</p>
          <p class="text-success">Please be reminded to bring a valid ID when you come for your scheduled
            appointment at the barangay hall.</p>
          <hr />
        </div>

        <div class="row mb-3">
          <div class="col-md-4">
            <label for="fname" class="form-label">First Name<span class="text-danger">*</span></label>
            <input type="text" id="fname" name="fname" placeholder="Juan" class="form-control" required>
          </div>
          <div class="col-md-4">
            <label for="mname" class="form-label">Middle Name</label>
            <input type="text" id="mname" name="mname" placeholder="Leonor" class="form-control">
          </div>
          <div class="col-md-4">
            <label for="lname" class="form-label">Last Name<span class="text-danger">*</span></label>
            <input type="text" id="lname" name="lname" placeholder="Dela Cruz" class="form-control" required>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-4">
            <label for="age" class="form-label">Purpose<span class="text-danger">*</span></label>
            <input type="text" id="pickup" name="purpose" placeholder="what is it for?" class="form-control" required>
          </div>
          <div class="col-md-4">
            <label for="age" class="form-label">Pick Up Date<span class="text-danger">*</span></label>
            <input type="date" id="pickup" name="pickup" placeholder="" class="form-control" required>
          </div>
          <div class="col-md-4">
            <label for="payment" class="form-label">Payment Method</label>
            <select id="payment" name="payment" onchange="refnumber()" class="form-select">
              <option value="Cash">Cash on Pickup</option>
              <option value="Gcash">Gcash</option>
            </select>
          </div>
          <div class="col-md-4">
            <input type="hidden" id="date" name="date_req" placeholder="" class="form-control" required>
          </div>
          <div class="col-md-4">
            <input type="hidden" name="type" value="Barangay Clearance">
          </div>
          <div class="col-md-4">
            <input type="hidden" name="docstatus" value="Pending">
          </div>

        </div>

        <div class="row mb-3" id="rf" style="display:none">
          <div class="col-md-12">
            <label for="reference" class="form-label">Reference Number (Gcash Payment)</label>
            <textarea id="reference" name="reference" placeholder="Input your reference number if you chose Gcash as mode of payment" class="form-control" rows="3"></textarea>
          </div>
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-danger" name="clearance">Submit</button>
        </div>
      </form>
    </div>

  </div>
  <!-- </section> -->

  <div id="myModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <p>Please save your transaction number</p>
      <p>Your transaction number is: <span id="transaction-number"></span></p>
      <button onclick="copyTransactionNumber()" id="copy">Copy Transaction Number</button>
      <button onclick="closeModal()" id="okay">Okay</button>
    </div>
  </div>

</body>
<script>
  function validateForm() {
    var fname = document.getElementById("fname").value;
    var lname = document.getElementById("lname").value;
    var age = document.getElementById("age").value;

    if (fname == "" || lname == "" || age == "") {
      alert("Please fill up all required fields.");
      return false;
    }

    return true;
  }

  function refnumber() {
    var select = document.getElementById("payment");

    if (select.value == "Gcash") {
      document.getElementById("rf").style.display = "block";
      document.getElementById("rfs").style.display = "block";
    } else {
      document.getElementById("rf").style.display = "none";
      document.getElementById("rfs").style.display = "none";

    }
  }

  function copyTransactionNumber() {
    var transactionNumber = document.getElementById("transaction-number").innerText;
    navigator.clipboard.writeText(transactionNumber);
  }

  function closeModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
  }

  function copyTransactionNumber() {
    var transactionNumber = document.getElementById("transaction-number").innerText;
    navigator.clipboard.writeText(transactionNumber).then(function() {
      var notification = document.createElement("div");
      notification.innerHTML = "Transaction number copied to clipboard!";
      notification.style.position = "fixed";
      notification.style.bottom = "20px";
      notification.style.right = "20px";
      notification.style.padding = "10px";
      notification.style.backgroundColor = "#4CAF50";
      notification.style.color = "white";
      notification.style.borderRadius = "5px";
      notification.style.opacity = "0";
      notification.style.transition = "opacity 0.5s ease-in-out";
      document.body.appendChild(notification);
      setTimeout(function() {
        notification.style.opacity = "1";
      }, 10);
      setTimeout(function() {
        notification.style.opacity = "0";
        setTimeout(function() {
          document.body.removeChild(notification);
        }, 500);
      }, 3000);
    });
  }

  function menuShow() {
    document.getElementById("menu").classList.toggle("show");
  }

  function menuClose() {
    document.getElementById("menu").classList.remove("show");
  }
  window.addEventListener("load", function() {
    var loadingScreen = document.getElementById("loading-screen");
    loadingScreen.style.display = "none";
  });
</script>

</html>