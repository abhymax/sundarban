<?php
require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = htmlspecialchars(trim($_POST['customer_name']));
    $phone_number = htmlspecialchars(trim($_POST['phone_number']));
    $email = htmlspecialchars(trim($_POST['email']));
    $tour_package = htmlspecialchars(trim($_POST['tour_package']));
    $travel_date = htmlspecialchars(trim($_POST['travel_date']));
    $number_of_people = intval($_POST['number_of_people']);

    if (!empty($customer_name) && !empty($phone_number) && !empty($tour_package) && !empty($travel_date) && $number_of_people > 0) {
        try {
            $stmt = $pdo->prepare("INSERT INTO bookings (customer_name, phone_number, email, tour_package, travel_date, number_of_people) VALUES (:customer_name, :phone_number, :email, :tour_package, :travel_date, :number_of_people)");
            $stmt->execute([
                ':customer_name' => $customer_name,
                ':phone_number' => $phone_number,
                ':email' => $email,
                ':tour_package' => $tour_package,
                ':travel_date' => $travel_date,
                ':number_of_people' => $number_of_people
            ]);

            // Redirect with success parameter
            header("Location: book_now.php?status=success");
            exit;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        header("Location: book_now.php?status=error");
        exit;
    }
} else {
    header("Location: book_now.php");
    exit;
}
?>