<?php
require_once 'auth_check.php';
require_once '../db_connect.php';

// Handle Booking Status Update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_status'])) {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("CSRF token validation failed.");
    }

    $booking_id = intval($_POST['booking_id']);
    $new_status = $_POST['status'];

    try {
        $stmt = $pdo->prepare("UPDATE bookings SET status = :status WHERE id = :id");
        $stmt->execute([':status' => $new_status, ':id' => $booking_id]);
        $status_message = "Booking status updated successfully.";
    } catch (PDOException $e) {
        $status_message = "Error updating status: " . $e->getMessage();
    }
}

// Fetch Inquiries
try {
    $stmt = $pdo->query("SELECT * FROM inquiries ORDER BY created_at DESC");
    $inquiries = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $inquiries = [];
    $error_msg = "Error fetching inquiries: " . $e->getMessage();
}

// Fetch Bookings
try {
    $stmt = $pdo->query("SELECT * FROM bookings ORDER BY created_at DESC");
    $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $bookings = [];
    $error_msg = "Error fetching bookings: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        .dashboard-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        .tabs {
            display: flex;
            margin-bottom: 20px;
            border-bottom: 2px solid #ddd;
        }
        .tab {
            padding: 10px 20px;
            cursor: pointer;
            background: #f4f4f4;
            margin-right: 5px;
            border-radius: 5px 5px 0 0;
            border: 1px solid #ddd;
            border-bottom: none;
        }
        .tab.active {
            background: var(--primary-color);
            color: white;
            font-weight: bold;
        }
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: var(--primary-color);
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .status-pending {
            color: orange;
            font-weight: bold;
        }
        .status-confirmed {
            color: green;
            font-weight: bold;
        }
        .status-cancelled {
            color: red;
            font-weight: bold;
        }
    </style>
    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
                tabcontent[i].classList.remove("active");
            }
            tablinks = document.getElementsByClassName("tab");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].classList.remove("active");
            }
            document.getElementById(tabName).style.display = "block";
            document.getElementById(tabName).classList.add("active");
            evt.currentTarget.classList.add("active");
        }
    </script>
</head>
<body>

    <header>
        <div class="navbar">
            <div class="logo">Admin Panel</div>
            <a href="logout.php" class="btn" style="margin-top: 0;">Logout</a>
        </div>
    </header>

    <div class="dashboard-container">
        <div class="header">
            <h2>Dashboard</h2>
            <?php if (isset($status_message)) echo "<p style='color: green;'>$status_message</p>"; ?>
        </div>

        <div class="tabs">
            <div class="tab active" onclick="openTab(event, 'inquiries')">Inquiries</div>
            <div class="tab" onclick="openTab(event, 'bookings')">Bookings</div>
        </div>

        <div id="inquiries" class="tab-content active">
            <h3>Recent Inquiries</h3>
            <?php if (count($inquiries) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($inquiries as $inquiry): ?>
                    <tr>
                        <td><?php echo $inquiry['id']; ?></td>
                        <td><?php echo htmlspecialchars($inquiry['name']); ?></td>
                        <td><?php echo htmlspecialchars($inquiry['email']); ?></td>
                        <td><?php echo nl2br(htmlspecialchars($inquiry['message'])); ?></td>
                        <td><?php echo $inquiry['created_at']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
                <p>No inquiries found.</p>
            <?php endif; ?>
        </div>

        <div id="bookings" class="tab-content">
            <h3>Recent Bookings</h3>
            <?php if (count($bookings) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Phone</th>
                        <th>Package</th>
                        <th>Date</th>
                        <th>Pax</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?php echo $booking['id']; ?></td>
                        <td>
                            <?php echo htmlspecialchars($booking['customer_name']); ?><br>
                            <small><?php echo htmlspecialchars($booking['email']); ?></small>
                        </td>
                        <td><?php echo htmlspecialchars($booking['phone_number']); ?></td>
                        <td><?php echo htmlspecialchars($booking['tour_package']); ?></td>
                        <td><?php echo htmlspecialchars($booking['travel_date']); ?></td>
                        <td><?php echo $booking['number_of_people']; ?></td>
                        <td>
                            <span class="status-<?php echo strtolower($booking['status']); ?>">
                                <?php echo $booking['status']; ?>
                            </span>
                        </td>
                        <td>
                            <form method="POST" style="display: inline;">
                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">
                                <input type="hidden" name="update_status" value="1">
                                <select name="status" onchange="this.form.submit()" style="padding: 5px;">
                                    <option value="Pending" <?php if ($booking['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                                    <option value="Confirmed" <?php if ($booking['status'] == 'Confirmed') echo 'selected'; ?>>Confirmed</option>
                                    <option value="Cancelled" <?php if ($booking['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
                <p>No bookings found.</p>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>