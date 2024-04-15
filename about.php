<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="about.css">
  <title>ABOUT</title>
</head>
<style>
  .startup-animation {
    animation: fadeIn 0.1s ease-in-out;
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

  /* animation */
  .slide {
    position: relative;
    transform: translateX(-50px);
    opacity: 0;
    transition: all 1s ease;
  }

  .slide.active {
    position: relative;
    transform: translateX(0);
    opacity: 1;
  }

  .reveal {
    position: relative;
    transform: translateY(-50px);
    opacity: 0;
    transition: all 1s ease;
  }

  .reveal.active {
    transform: translateY(0);
    opacity: 1;
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
    }

    to {
      opacity: 1;
    }
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
          <li><a href="./index.php#SERVICES">Services</a></li>
          <li><a href="#">Track</a></li>
          <li><a href="./index.php#contact">Contact</a></li>
        </ul>
      </nav>
      <svg onclick="menuShow()" onblur="menuClose()" id="burger" fill=" #FFFFFF" viewBox="0 0 448 512" title="bars">
        <path d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z" />
      </svg>
    </div>

  </header>
  <div class="about-img">

  </div>
  <div id="loading-screen">
    <img src="images/Mapulang-Lupa.png" alt="loading">
    <div class="spinner">
    </div>
  </div>
  <section class="section about-section">
    <!-- <div class="about-pc"> -->
    <img class="about-pc" src="images/laptop456.png" alt="img here">
    <!-- </div> -->
    <div class=" section about-section-info startup-animation">
      <h2>Making Smart Barangays Happen</h2>
      <br>
      <p>The Mapulang Lupa Barangay Management System (BMS) is a web-based platform designed to enhance the management and operations of barangay Mapulang Lupa. This system provides an efficient and centralized approach to managing barangay records and services, enabling easier access and faster delivery of services to residents. BMS simplifies and streamlines various barangay transactions such as issuance of barangay clearances, certificates, permits, and other services. With BMS, barangay officials can better monitor, manage and track the barangay's important records. This system also facilitates communication and collaboration among barangay officials, promoting better coordination and decision-making. Overall, the Barangay Management System helps promote transparency, efficiency, and accountability in barangay governance, ultimately benefiting the community as a whole.</p>
    </div>
  </section>
  <section class="section additional-info startup-animation">
    <h2>Welcome to Mapulang Lupa</h2>
    <br>
    <p>Your gateway to community services and information.</p>
    <br>
    <p>
      Experience the convenience of the Mapulang Lupa Barangay System. Get access to essential services anytime, anywhere. Stay safe during these times and beyond by managing your barangay-related tasks online.
    </p>
    <br>
    <p>
      Provided to you from the City of Valenzuela
    </p>
    <br>
    <br>
    <h2>About Us</h2>
    <p>
      Empowering the City of Valenzuela's Digital Transformation
      <br>
      <br>
      Our system is an innovative solution designed to provide fast and efficient services to the residents of Mapulang Lupa. Our system is a brainchild of Mayor WES Gatchalian and Barangay Captain Arnold C. Natividad, who both share a common vision of a smarter and more efficient Barangay.
      <br>
      <br>
      Our system is created with the residents of Mapulang Lupa in mind, aiming to make essential services and transactions more accessible, efficient, and transparent. Through our system, you can easily access services such as requesting your Barangay Documents!.
      <br>
      <br>
      At the heart of our system is our commitment to serve the residents of Mapulang Lupa with utmost dedication and excellence. We strive to continuously improve our services, ensuring that we meet the evolving needs of our constituents. Our team of experts is dedicated to ensuring that our system is always up-to-date with the latest technologies and innovations, providing you with the best possible user experience.
      <br>

      <br>
      Thank you for choosing the Mapulang Lupa Barangay Management System as your go-to solution for your Barangay needs. We are committed to serving you better, and we look forward to hearing your feedback as we continue to enhance our services.
      <br>

      <br>
      <span>Maraming Salamat po</span>.
    </p>
  </section>
  <section class="section location">
    <div class="location-title">
      <h2>OUR LOCATION</h2>
      <p><a href="">Brgy. Mapulang Lupa, Philippines</a></p>
      <p>09230888995</p>
      <p><a href="brgy.mapulanglupa2018@gmail.com">brgy.mapulanglupa2018@gmail.com</a></p>
      <!-- <img src="images/Mapulang-Lupa.png" style="width: 200px; height: auto;" alt=""> -->
    </div>
    <div class="map">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15436.715843289!2d120.99439637811624!3d14.702469435801255!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b145c3460dd3%3A0xea6326b5477bd324!2sMapulang%20Lupa%2C%20Valenzuela%2C%20Metro%20Manila!5e0!3m2!1sen!2sph!4v1677636143743!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

  </section>
  <hr>
  <footer id="footer">
    <div class="footer-content">
      <div class="concern">
        <img src="images/Mapulang-Lupa.png" alt="barangay-logo" srcset="">
      </div>
      <div class="concern">
        <p style="color:#8d9299;">© 2023 City of Valenzuela Local Barangay System. All Rights Reserved.</p>
      </div>

    </div>
  </footer>
  <script>
    function menuShow() {
      document.getElementById("menu").classList.toggle("show");
    }

    function menuClose() {
      document.getElementById("menu").classList.remove("show");
    }

    window.addEventListener('scroll', slide);

    function slide() {
      var reveals = document.querySelectorAll('.slide');

      for (var i = 0; i < reveals.length; i++) {

        var windowheight = window.innerHeight;
        var revealtop = reveals[i].getBoundingClientRect().top;
        var revealpoint = 150;

        if (revealtop < windowheight - revealpoint) {
          reveals[i].classList.add('active');
        } else {
          reveals[i].classList.remove('active');
        }
      }
    }

    window.addEventListener("load", function() {
      var loadingScreen = document.getElementById("loading-screen");
      loadingScreen.style.display = "none";
    });

    window.addEventListener('scroll', reveal);

    function reveal() {
      var reveals = document.querySelectorAll('.reveal');

      for (var i = 0; i < reveals.length; i++) {

        var windowheight = window.innerHeight;
        var revealtop = reveals[i].getBoundingClientRect().top;
        var revealpoint = 150;

        if (revealtop < windowheight - revealpoint) {
          reveals[i].classList.add('active');
        } else {
          reveals[i].classList.remove('active');
        }
      }
    }
  </script>
  <!-- <script src="index.js"></script> -->
</body>

</html>