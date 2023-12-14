<?php
include 'header.php';
include 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>

<div id="content" class="container mt-5">
    <h2>Order History</h2>

    <?php
    $user_id = $_SESSION['user_id'];

    // Retrieve order history for the current user
    $order_query = "SELECT * FROM orders WHERE user_id = $user_id";
    $order_result = $mysqli->query($order_query);

    // Display order history
    while ($order_row = $order_result->fetch_assoc()) {
        echo '<div class="card mb-3">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">Order ID: ' . $order_row['order_id'] . '</h5>';
        echo '<p class="card-text">Order Date: ' . $order_row['order_date'] . '</p>';
        echo '<p class="card-text">Name: ' . $order_row['first_name'] . ' ' . $order_row['last_name'] . '</p>';
        echo '<p class="card-text">Address: ' . $order_row['address'] . '</p>';
        echo '</div>';
        echo '</div>';
    }
    $mysqli->close();
    ?>

</div>

<?php
include 'footer.php';
?>
