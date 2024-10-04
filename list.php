<?php
require 'db.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$excelFileUrl = 'https://www.alko.fi/INTERSHOP/static/WFS/Alko-OnlineShop-Site/-/Alko-OnlineShop/fi_FI/Alkon%20Hinnasto%20Tekstitiedostona/alkon-hinnasto-tekstitiedostona.xlsx';
$localFilePath = 'alkon-hinnasto-tekstitiedostona.xlsx';

try {
    // download the Excel file
    if (@file_put_contents($localFilePath, file_get_contents($excelFileUrl)) === false) {
        die("Error: Could not download the Excel file.");
    }

    // read the Excel file
    $reader = new Xlsx();
    $spreadsheet = $reader->load($localFilePath);
    $worksheet = $spreadsheet->getActiveSheet();

    // data starts from row 5
    foreach ($worksheet->getRowIterator(5) as $row) {
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false);
        $data = [];

        foreach ($cellIterator as $cell) {
            $data[] = $cell->getValue();
        }

        $number = $data[0];
        $name = $data[1];
        $bottle_size = $data[3];
        $price = $data[4];

        // update or insert into the products table
        $sql = "INSERT INTO products (number, name, bottle_size, price) 
                VALUES (:number, :name, :bottle_size, :price) 
                ON DUPLICATE KEY UPDATE name = :nameUpdate, bottle_size = :bottle_sizeUpdate, price = :priceUpdate";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':number' => $number,
            ':name' => $name,
            ':bottle_size' => $bottle_size,
            ':price' => $price,
            ':nameUpdate' => $name,
            ':bottle_sizeUpdate' => $bottle_size,
            ':priceUpdate' => $price
        ]);
    }

    // fetch updated products and display them as a table
    $sql = "SELECT * FROM products";
    $stmt = $pdo->query($sql);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table>";
    echo "<tr><th>Number</th><th>Name</th><th>Bottle Size</th><th>Price</th></tr>";
    foreach ($products as $product) {
        echo "<tr>
                <td>{$product['number']}</td>
                <td>{$product['name']}</td>
                <td>{$product['bottle_size']}</td>
                <td>{$product['price']}</td>
              </tr>";
    }
    echo "</table>";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}