<?php
session_start();
include 'header.php';
include 'config.php';

// redirect to login page if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Retrieve user information from the database
$user_id = $_SESSION['user_id'];
$user_query = "SELECT * FROM users WHERE id = $user_id";
$user_result = $mysqli->query($user_query);

// Retrieve items in the cart for the current user
$cart_query = "SELECT p.id, p.name, p.price, p.image_url, c.quantity FROM cart c
               JOIN products p ON c.product_id = p.id
               WHERE c.user_id = $user_id";
$cart_result = $mysqli->query($cart_query);

// Calculate the total price
$total_price = 0;
while ($row = $cart_result->fetch_assoc()) {
    $total_price += $row['price'] * $row['quantity'];
}

?>

<div id="content" class="container mt-5">
    <h2 class="mb-4">Checkout</h2>

    <div class="row">
        <!-- Display cart items -->
        <div class="col-md-6">
            <h3 class="mb-3">Cart Items:</h3>
            <?php
            $cart_result->data_seek(0); // Reset the result pointer
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
            ?>
            <!-- Display total price -->
            <h3 class="mt-4">Total Price: $<?php echo $total_price; ?></h3>
        </div>

        <!-- Add a form for collecting additional order information -->
        <div class="col-md-6">
            <form action="process_order.php" method="post">
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" class="form-control" name="first_name" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" class="form-control" name="last_name" required>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" class="form-control" name="address" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Place Order</button>
            </form>
        </div>
    </div>

</div>

<?php
include 'footer.php';
?>
