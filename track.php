<?php
require('./forms/connection.php');

if (isset($_POST['search'])) {
    $tracking_code = $_POST['tracking_code'];

    if (!empty($tracking_code)) {

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("SELECT fname, lname, pickup, docstatus, type FROM tbldocument WHERE tracking_code = ?");
        $stmt->bind_param("s", $tracking_code);
        $stmt->execute();

        // Check if the connection to the database is successful
        if (!$stmt) {
            die("Database query failed.");
        }

        $result = $stmt->get_result();

        mysqli_close($conn);
    } else {
        echo "Please enter a transaction number.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>TRACK</title>
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
    <nav>
        <div id="home">
            <h5>BMS</h5>
        </div>
        <div>
            <a href="./index.php" class="text-white">HOME</a>
        </div>
    </nav>
    <div id="loading-screen">
        <img src="images/Mapulang-Lupa.png" alt="loading">
        <div class="spinner">
        </div>
    </div>
    <div class="container mt-5">
        <form method="post" action="track.php">
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="tracking_code" class="form-label">Transaction Number:</label>
                </div>
                <div class="col-md-9 mb-2">
                    <input type="text" id="tracking_code" name="tracking_code" class="form-control" placeholder="Enter transaction number" required>
                </div>
                <div class="col-md-2">
                    <button type="submit" name="search" class="btn text-white w-100" style="background-color: #850000;">Search</button>
                </div>
            </div>
        </form>



        <?php
        if (isset($_POST['search']) && mysqli_num_rows($result) > 0) {


            while ($row = mysqli_fetch_array($result)) {
                echo "<div class='mt-5 text-center mt-0'>";
                echo "<h5>" . "Hello " .  '<span class="text-success">' . strtoupper($row['fname']) . " " .  strtoupper($row['lname']) . '</span>' . " your " . ($row['type']) . " is " . '<span class="text-danger">' . strtoupper($row['docstatus']) . '</span>' . "</h5>";
                echo "<h5>" . "Your pick up date is on " . '<span class="text-primary">' . ($row['pickup']) . '</span>' . "</h5>";

                if ($row['docstatus'] == 'pending') {
                    echo "<div class='container-fluid'>";
                    echo "<img src='images/pending1.png' alt='Pending' class='img-fluid' >";
                    echo "</div>";
                } else if ($row['docstatus'] == 'cancelled') {
                    echo "<div class='container-fluid'>";
                    echo "<img src='images/cancel1.png' alt='Cancelled' class='img-fluid'> ";
                    echo "</div>";
                } else if ($row['docstatus'] == 'ready') {
                    echo "<div class='container-fluid'>";
                    echo "<img src='images/ready1.png' alt='Ready' class='img-fluid' ";
                    echo "</div>";
                } else {
                    echo "<div class='container-fluid'>";
                    echo "<img src='images/released1.png' alt='Released' class='img-fluid' >";
                    echo "</div>";
                }
            }
        }
        ?>

    </div>

    <script>
        function validateForm() {
            var transactionNumber = document.getElementById("tracking_code").value;

            if (transactionNumber == "") {
                alert("Please enter a transaction number.");
                return false;
            }

            return true;
        }
        window.addEventListener("load", function() {
            var loadingScreen = document.getElementById("loading-screen");
            loadingScreen.style.display = "none";
        });
    </script>
</body>

</html>