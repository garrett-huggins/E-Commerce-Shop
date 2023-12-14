<?php
include 'header.php';
?>

<div id="content" class="container mt-5">
    <h2>User Registration</h2>

    <form action="register_process.php" method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" name="username" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" required>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Register</button>
    </form>

</div>

<?php
include 'footer.php';
?>
