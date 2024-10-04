<?php
require 'db.php';  // include the database connection

try {
    // truncate the products table (delete all rows)
    $sql = "TRUNCATE TABLE products";
    $pdo->exec($sql);

    // show confirmation
    echo "All products have been removed from the database.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
