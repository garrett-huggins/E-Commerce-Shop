<?php
session_start();
include 'header.php';
include 'config.php';

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Retrieve products from the database
$product_query = "SELECT * FROM products";
$product_result = $mysqli->query($product_query);
?>

<!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

<div id="content" class="container landing-page">

    <!-- Hero Section -->
    <div class="hero-section text-center">
        <h1>Welcome to Slanted Tech</h1>
        <p class="lead">Discover the Art of Typing with Our Custom Keyboards and Accessories</p>
        <a href="#featured-products" class="btn btn-primary explore-btn">Explore Now</a>
    </div>

    <!-- About Us Section -->
    <section id="about-us" class="my-5">
        <div class="row">
            <div class="col-md-6">
                <h2>About Us</h2>
                <p>Welcome to Slanted Tech, your go-to destination for custom keyboards and keyboard accessories. Founded by two passionate individuals, our journey started in a humble garage where we crafted keyboards with precision and dedication. Over the years, we've evolved into a thriving community of keyboard enthusiasts.</p>
                <p>At Slanted Tech, we take pride in handcrafting each keyboard, ensuring that it's unique to your individual request. Our commitment to quality and craftsmanship is reflected in every product we deliver. Join us in the world of personalized and ergonomic keyboards that cater to your preferences.</p>
            </div>
            <div class="col-md-6">
                <img src="images/about_us.jpg" alt="About Us Image" class="img-fluid rounded">
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section id="featured-products" class="mb-5">
        <h2 class="text-center mb-4">Featured Products</h2>

        <div class="row">
            <?php
            while ($row = $product_result->fetch_assoc()) {
                echo '<div class="col-md-4 mb-4">';
                echo '<div class="card">';
                echo '<img class="card-img-top" src="images/' . $row['image_url'] . '" alt="' . $row['name'] . '">';
                echo '<div class="card-body">';
                echo '<h3 class="card-title">' . $row['name'] . '</h3>';
                echo '<p class="card-text">' . $row['description'] . '</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </section>

    <!-- Product Showcase Section -->
    <section id="product-showcase" class="text-center my-5">
        <h2>Discover Our Exclusive Products</h2>
        <p>Immerse yourself in a world of unique and customizable keyboards. Each product at Slanted Tech is crafted with precision and designed for a superior typing experience.</p>
        <a href="/ecommerce_project/products.php" class="btn btn-primary">View Products</a>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="text-center my-5">
        <h2>What Our Customers Say</h2>

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <p class="card-text">"I love my new keyboard from Slanted Tech! The customization options are fantastic, and the typing feel is unparalleled."</p>
                        <span class="customer-name">- Jane Doe</span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <p class="card-text">"Exceptional quality and attention to detail. Slanted Tech is the go-to place for keyboard enthusiasts."</p>
                        <span class="customer-name">- John Smith</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Us Section -->
    <section id="contact-us" class="text-center my-5">
        <h2>Contact Us</h2>
        <p>Have questions or need assistance? Reach out to us. We're here to help!</p>
        
        <form action="contact_process.php" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" required>
            </div>

            <div class="form-group">
                <label for="message">Message:</label>
                <textarea class="form-control" name="message" rows="4" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
    </section>

</div>

<?php
include 'footer.php';
?>
