<?php
include 'header.php';

// Handle Search Query
$search_query = isset($_GET['q']) ? $_GET['q'] : '';
$search_condition = $search_query ? "WHERE name LIKE '%$search_query%'" : '';
?>

<!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<!-- Include products CSS -->
<link rel="stylesheet" href="css/products.css">

<div id="content" class="container mt-5">
    <h2 class="mb-4">Product Listings</h2>

    <!-- Search Bar -->
    <form id="searchForm" action="products.php" method="get" class="mb-4">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search products..." value="<?php echo htmlspecialchars($search_query); ?>">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Search</button>
                <button type="button" class="btn btn-secondary" onclick="clearSearch()">Clear</button>
            </div>
        </div>
    </form>

    <div class="row">
        <?php
        // Connect to MySQL (Replace with your database credentials)
        session_start();
        include 'config.php';

        // Check connection
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        // Retrieve products from the database with optional search condition
        $result = $mysqli->query("SELECT * FROM products $search_condition");

        // Check if products were found
        if ($result->num_rows > 0) {
            // Display products
            while ($row = $result->fetch_assoc()) {
                echo '<div class="col-md-4 mb-4">';
                echo '<div class="card">';
                echo '<img class="card-img-top" src="images/' . $row['image_url'] . '" alt="' . $row['name'] . '">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . $row['name'] . '</h5>';
                echo '<p class="card-text">' . $row['description'] . '</p>';
                echo '<p class="card-price">$' . $row['price'] . '</p>';
                echo '<form action="add_to_cart.php" method="post">';
                echo '<input type="hidden" name="product_id" value="' . $row['id'] . '">';
                echo '<label for="quantity">Quantity:</label>';
                echo '<input type="number" name="quantity" value="1" min="1" class="form-control mb-2">';
                echo '<button type="submit" class="btn btn-primary">Add to Cart</button>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            // No products found
            echo '<div class="col-md-12"><p>No products found.</p></div>';
        }

        // Close the database connection
        $mysqli->close();
        ?>
    </div>
</div>

<?php
include 'footer.php';
?>

<script>
    function clearSearch() {
        document.querySelector('input[name="q"]').value = '';
        document.getElementById('searchForm').submit();
    }
</script>
