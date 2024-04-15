<?php
require('./forms/connection.php');

if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $number = $_POST['number'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];
  // $date = date("Y-m-d H:i:s");

  $queryCreate = "INSERT INTO `tbl_support`(`name`, `email`, `number`, `subject`, `message`) VALUES ('$name','$email','$number','$subject','$message')";
  $sqlCreate = mysqli_query($conn, $queryCreate);

  if ($sqlCreate) {
    echo "<script>alert('Thank You for your feedback!');</script>";
  } else {
    echo "<script>alert('Error: Form submission failed.');</script>";
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <link rel="stylesheet" href="index.css" />
  <title>APP2.0</title>
</head>
<style>
  .startup-animation {
  animation: fadeIn 1s ease-in-out;
}
</style>
<body>
  <header>
    <div class="container">
      <h1 class="logo">BMS</h1>
      <nav id="menu">
        <ul>
          <li><a href="./index.php">Home</a></li>
          <li><a href="./about.php">About</a></li>
          <li><a href="#SERVICES">Services</a></li>
          <li><a href="./track.php">Track</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
      </nav>
      <svg onclick="menuShow()" onblur="menuClose()" id="burger" fill=" #FFFFFF" viewBox="0 0 448 512" title="bars">
        <path d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z" />
      </svg>
    </div>
  </header>
  <section class="about" id="home">
    <img src="images/Mapulang-Lupa.png" class="startup-animation" alt="" />
    <div class="info startup-animation">
      <h2>Welcome to</h2>
      <h1>Brgy. Mapulang Lupa</h1>
      <p>
        <span>Address:</span> Sto. Rosario St. Mapulang Lupa, Valenzuela,
        Philippine
      </p>
      <p><span>Open Hours of Barangay:</span> Monday to Saturday (8AM-5PM)</p>
      <p><span>Email:</span> brgy.mapulanglupa2018@gmail.com</p>
      <div class="about-btn">
        <a href="./about.php">About Us</a>
      </div>
    </div>
  </section>
  <section class="wave">
    <div class="custom-shape-divider-bottom-1677297097">
      <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="shape-fill"></path>
      </svg>
    </div>
  </section>
  <section class="tutorial startup-animation">
    <h2>How it Works</h2>
    <div class="images">
      <img src="images/step1.png" alt="img here" />
      <img src="images/step2.png" alt="img here" />
    </div>
  </section>

  <section class="sections services reveal" id="SERVICES">
    <div class="services-title">
      <h1>ONLINE PROCESS</h1>
      <p>List of Services of Barangay Mapulang Lupa</p>
    </div>
    <div class="cards-parent">
      <div class="card">
        <div class="card-title">
          <h2>Barangay Clearance</h2>
        </div>

        <div class="card-logo">
          <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
          <lord-icon src="https://cdn.lordicon.com/pqxdilfs.json" trigger="hover" colors="outline:#131432,primary:#606874,secondary:#850000,tertiary:#ebe6ef" stroke="20" scale="70" style="width: 90px; height: 70px">
          </lord-icon>
        </div>
        <div class="card-info">
          <p>Get your Barangay Clearance here!</p>
        </div>
        <a href="./forms/brgyClearance.php">PROCEED</a>
      </div>
      <div class="card">
        <div class="card-title">
          <h2>Business Permit</h2>
        </div>

        <div class="card-logo">
          <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
          <lord-icon src="https://cdn.lordicon.com/pqxdilfs.json" trigger="hover" colors="outline:#131432,primary:#606874,secondary:#850000,tertiary:#ebe6ef" stroke="20" scale="70" style="width: 90px; height: 70px">
          </lord-icon>
        </div>
        <div class="card-info">
          <p>Get your Business Permit here!</p>
        </div>
        <a href="./forms/businessPermit.php">PROCEED</a>
      </div>
      <div class="card">
        <div class="card-title">
          <h2>Certificate of Indigency</h2>
        </div>

        <div class="card-logo">
          <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
          <lord-icon src="https://cdn.lordicon.com/pqxdilfs.json" trigger="hover" colors="outline:#131432,primary:#606874,secondary:#850000,tertiary:#ebe6ef" stroke="20" scale="70" style="width: 90px; height: 70px">
          </lord-icon>
        </div>
        <div class="card-info">
          <p>Get your Certificate of Indigency here!</p>
        </div>
        <a href="./forms/certIndigency.php">PROCEED</a>
      </div>
    </div>
  </section>

  <!-- contact -->
  <div class="track slide2" id="track">
    <div class="track-title">
      <h1>CONTACT US</h1>
      <p>Tell us what you think!</p>
    </div>
    <div class="search" id="contact">
      <form action="index.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" placeholder="Juan Lucho" name="name" required />

        <label for="email">Email:</label>
        <input type="email" placeholder="juan@gmail.com" name="email" required />

        <label for="number">Contact Number:</label>
        <input type="text" placeholder="09xxxxxxxxx" name="number" required />

        <label for="subject">Subject:</label>
        <select name="subject" id="subject">
          <option value="Concerns">Concerns</option>
          <option value="Bugs">Bugs/Issues</option>
          <option value="Feedback">Feedback</option>
        </select>
        <label for="message">Message:</label>
        <input type="text" placeholder="Enter your message" name="message" id="feedback" required />

        <button type="submit" name="submit">Submit</button>
      </form>
    </div>
  </div>

  <hr>
  <footer id="footer">
    <div class="footer-content">
      <div class="concern">
        <img src="images/Mapulang-Lupa.png" alt="barangay-logo" srcset="">
      </div>
      <div class="concern">
        <p style="color: #8d9299;">© 2023 City of Valenzuela Local Barangay System. All Rights Reserved.</p>
      </div>

    </div>
  </footer>

  <script src="index.js"></script>
</body>

</html>