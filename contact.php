<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
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
        <h1 class="section-title">Contact Us</h1>
        <p>We are ready to plan your perfect trip to the Sundarbans.</p>

        <div style="margin: 40px 0; padding: 20px; background: #fff; border: 1px solid #ddd; border-radius: 8px;">
            <h3>Visit Us</h3>
            <p><strong>Address:</strong> Chandipur, West Bengal 743370</p>

            <h3 style="margin-top: 20px;">Call Us</h3>
            <p><strong>Phone:</strong> 097756 06350</p>
        </div>

        <?php
        if (isset($_GET['status'])) {
            if ($_GET['status'] == 'success') {
                echo '<p style="color: green; font-weight: bold;">Thank you! Your inquiry has been sent successfully.</p>';
            } elseif ($_GET['status'] == 'error') {
                echo '<p style="color: red; font-weight: bold;">Please fill in all fields.</p>';
            }
        }
        ?>
        <form action="submit_inquiry.php" method="POST" style="max-width: 600px; margin: 0 auto; text-align: left;">
            <div style="margin-bottom: 15px;">
                <label for="name" style="display: block; margin-bottom: 5px;">Name</label>
                <input type="text" id="name" name="name" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label for="email" style="display: block; margin-bottom: 5px;">Email</label>
                <input type="email" id="email" name="email" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            <div style="margin-bottom: 15px;">
                <label for="message" style="display: block; margin-bottom: 5px;">Message</label>
                <textarea id="message" name="message" rows="5" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;"></textarea>
            </div>
            <button type="submit" class="btn" style="border: none; cursor: pointer;">Send Inquiry</button>
        </form>
    </div>

    <footer>
        <p>Sundarban Boat Safari</p>
        <p>Address: Chandipur, West Bengal 743370 | Phone: 097756 06350</p>
    </footer>

</body>
</html>