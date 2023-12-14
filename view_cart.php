<?php
include 'header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<div id="content" class="container mt-5">
    <h2>Shopping Cart</h2>

    <?php
    // Connect to MySQL (Replace with your database credentials)
    include 'config.php';

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Get user ID from the session (assuming you have a 'users' table with an 'id' column)
    $user_id = $_SESSION['user_id']; // Adjust this based on your session variable

    // Retrieve items in the cart for the current user
    $cart_query = "SELECT p.id, p.name, p.price, p.image_url, c.quantity FROM cart c
                   JOIN products p ON c.product_id = p.id
                   WHERE c.user_id = $user_id";
    $cart_result = $mysqli->query($cart_query);

    // Check if the cart is empty
    if ($cart_result->num_rows === 0) {
        echo '<div class="alert alert-info" role="alert">Your shopping cart is empty.</div>';
    } else {
        // Display cart items
        while ($row = $cart_result->fetch_assoc()) {
            echo '<div class="card mb-3">';
            echo '<div class="row g-0">';
            echo '<div class="col-md-4">';
            echo '<img src="images/' . $row['image_url'] . '" alt="' . $row['name'] . '" class="img-fluid rounded-start">';
            echo '</div>';
            echo '<div class="col-md-8">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $row['name'] . '</h5>';
            echo '<p class="card-text">Price: $' . $row['price'] . '</p>';
            echo '<p class="card-text">Quantity: ' . $row['quantity'] . '</p>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }

        // Calculate the total price
        $total_query = "SELECT SUM(p.price * c.quantity) AS total FROM cart c
                        JOIN products p ON c.product_id = p.id
                        WHERE c.user_id = $user_id";
        $total_result = $mysqli->query($total_query);
        $total_row = $total_result->fetch_assoc();
        $total_price = $total_row['total'];

        echo '<div class="total-price">';
        echo '<p class="lead">Total : $' . $total_price . '</p>';
        echo '</div>';

        // Checkout button
        echo '<a href="checkout.php" class="btn btn-primary">Checkout</a>';
    }

    // Close the database connection
    $mysqli->close();
    ?>

</div>

<?php
include 'footer.php';
?>
