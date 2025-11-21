<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Your Tour</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <div class="navbar">
            <a href="index.html" class="logo">Sundarban Boat Safari</a>
            <ul class="nav-links">
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li class="dropdown">
                    <a href="#" class="dropbtn">Packages</a>
                    <div class="dropdown-content">
                        <a href="tour-1n2d.html">1 Night 2 Days</a>
                        <a href="tour-2n3d.html">2 Nights 3 Days</a>
                        <a href="sonar-bangla.html">Sonar Bangla</a>
                    </div>
                </li>
                <li><a href="activities.html">Activities</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>
    </header>

    <div class="container" style="text-align: center;">
        <h1 class="section-title">Book Your Tour</h1>
        <p>Fill out the form below to reserve your spot.</p>

        <?php
        if (isset($_GET['status'])) {
            if ($_GET['status'] == 'success') {
                echo '<p style="color: green; font-weight: bold;">Thank you! Your booking request has been received. We will contact you shortly.</p>';
            } elseif ($_GET['status'] == 'error') {
                echo '<p style="color: red; font-weight: bold;">Please fill in all fields.</p>';
            }
        }
        ?>

        <form action="submit_booking.php" method="POST" style="max-width: 600px; margin: 0 auto; text-align: left;">
            <div style="margin-bottom: 15px;">
                <label for="customer_name" style="display: block; margin-bottom: 5px;">Full Name</label>
                <input type="text" id="customer_name" name="customer_name" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label for="phone_number" style="display: block; margin-bottom: 5px;">Phone Number</label>
                <input type="tel" id="phone_number" name="phone_number" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label for="email" style="display: block; margin-bottom: 5px;">Email</label>
                <input type="email" id="email" name="email" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label for="tour_package" style="display: block; margin-bottom: 5px;">Tour Package</label>
                <select id="tour_package" name="tour_package" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="1N 2D">1 Night 2 Days</option>
                    <option value="2N 3D">2 Nights 3 Days</option>
                    <option value="Sonar Bangla">Sonar Bangla Luxury</option>
                </select>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="travel_date" style="display: block; margin-bottom: 5px;">Travel Date</label>
                <input type="date" id="travel_date" name="travel_date" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label for="number_of_people" style="display: block; margin-bottom: 5px;">Number of People</label>
                <input type="number" id="number_of_people" name="number_of_people" min="1" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <button type="submit" class="btn" style="border: none; cursor: pointer;">Submit Booking Request</button>
        </form>
    </div>

    <footer>
        <p>Sundarban Boat Safari</p>
        <p>Address: Chandipur, West Bengal 743370 | Phone: 097756 06350</p>
    </footer>

</body>
</html>