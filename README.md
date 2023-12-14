# E-Commerce Final Project

## Documentation

### Chosen Platform/CMS:

The application is a custom-built e-commerce platform using PHP and MySQL. No specific CMS (Content Management System) was used to maintain full control over the application's structure and functionality.

### Feature Showcasing PHP and MySQL:

The feature that primarily showcases the use of PHP and MySQL is the complete e-commerce system. Key features include:

1. **User Authentication:** Users can register, log in, and log out. Passwords are securely hashed using password_hash().

2. **Product Management:** Products are retrieved from the database and displayed dynamically on the product listings page.

3. **Shopping Cart:** Users can add products to their shopping cart. The cart information is stored in the database.

4. **Checkout and Order Processing:** Users can proceed to checkout, providing their address. Orders are stored in the database, along with order items.

5. **Order History:** Users can view their order history, including order details and associated products.

6. **Responsive Design:** Bootstrap is used to enhance the visual appeal and responsiveness of the front-end.

### Challenges:

1. **User Authentication:** Ensuring secure user authentication was a challenge. It was overcome by using PHP's password_hash() and password_verify() functions for secure password handling.

2. **Session Management:** Maintaining user sessions across various pages without loss of user information required careful handling of PHP sessions. This was achieved by ensuring that session_start() is called on every page that needs access to session variables, and using one continuous mysqli connection located in `config.php`.

3. **Database Relationships:** Establishing and managing relationships between different tables (e.g., users, products, orders) required careful consideration of foreign keys. Using MySQL foreign keys helped maintain data integrity.

In summary, the challenges were addressed through a combination of careful planning, leveraging built-in PHP and MySQL functionalities, and utilizing Bootstrap for a responsive and visually appealing design. Regular testing and debugging were integral to the development process.

## Database Schema

### Users Table

| Column   | Type         | Constraints                 |
| -------- | ------------ | --------------------------- |
| id       | INT          | PRIMARY KEY, AUTO_INCREMENT |
| username | VARCHAR(255) | NOT NULL                    |
| password | VARCHAR(255) | NOT NULL                    |

### Products Table

| Column      | Type           | Constraints                 |
| ----------- | -------------- | --------------------------- |
| id          | INT            | PRIMARY KEY, AUTO_INCREMENT |
| name        | VARCHAR(255)   | NOT NULL                    |
| description | TEXT           |                             |
| price       | DECIMAL(10, 2) | NOT NULL                    |
| image_url   | VARCHAR(255)   |                             |

### Cart Table

| Column     | Type | Constraints                         |
| ---------- | ---- | ----------------------------------- |
| id         | INT  | PRIMARY KEY, AUTO_INCREMENT         |
| user_id    | INT  | NOT NULL, FOREIGN KEY (users.id)    |
| product_id | INT  | NOT NULL, FOREIGN KEY (products.id) |
| quantity   | INT  | NOT NULL                            |

### Orders Table

| Column     | Type         | Constraints                      |
| ---------- | ------------ | -------------------------------- |
| order_id   | INT          | PRIMARY KEY, AUTO_INCREMENT      |
| user_id    | INT          | NOT NULL, FOREIGN KEY (users.id) |
| order_date | TIMESTAMP    | DEFAULT CURRENT_TIMESTAMP        |
| first_name | VARCHAR(255) |                                  |
| last_name  | VARCHAR(255) |                                  |
| address    | VARCHAR(255) |                                  |

### Order_Items Table

| Column     | Type | Constraints                             |
| ---------- | ---- | --------------------------------------- |
| item_id    | INT  | PRIMARY KEY, AUTO_INCREMENT             |
| order_id   | INT  | NOT NULL, FOREIGN KEY (orders.order_id) |
| product_id | INT  | NOT NULL, FOREIGN KEY (products.id)     |
| quantity   | INT  | NOT NULL                                |

### SQL Code

```sql
CREATE DATABASE IF NOT EXISTS ecommerce_db;
USE ecommerce_db;

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    image_url VARCHAR(255)
);

CREATE TABLE cart (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE orders (
    order_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    address VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE order_items (
    item_id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

INSERT INTO products (name, description, price, image_url) VALUES
('Twilight', '60% Wireless Mechanical Keyboard Bluetooth Dual Mode', 19.99, 'product1.png'),
('RedDragon Fizz', 'K617 RGB USB Mini Mechanical Gaming Wired Keyboard', 29.99, 'product2.png'),
('MageGee TS91', 'Mini 60% keyboard with waterproof keycaps', 39.99, 'product3.png');
```

## Setup Instructions

1. Download and Extract the Project Files

- Download the project files.
- Extract the contents into your web server's document root (e.g., ` htdocs` for Apache, `www` for Nginx).

2. Create the Database

- using the SQL code above, create the database and tables.

3. Configure the Database Connection

- Open the `config.php` file in the project folder.
- Update the database connection details (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) with your MySQL credentials. The default is `ecommerce_db` for the database name.
  > Note: This only needs to be changed if you want to use a different database name.

4. Run the Application

- Start your web server and MySQL server.
- Open your web browser and navigate to `http://localhost/ecommerce_project/`.
