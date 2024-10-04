# Price Fetcher

This is a PHP web application for fetching information of an Excel file. This is then stored in MySQL and displayed on the page.

# Requirements

PHP 7.3 or higher
MySQL
Composer

You might also need these additional dependencies:

sudo apt install php-pdo-mysql
sudo apt install php-common php-mysql php-cli
sudo apt install php-zip
sudo apt install php-mbstring
sudo apt install php-xml

# Setup

1. Clone the repository:
    
    git clone https://github.com/yourusername/pricefetcher.git

2. Navigate to the project directory

    cd pricefetcher

3. Install Composer dependencies

    composer install

4. Set up the database with the SQL file (remember to change the password)

5. Run the web application from the project directory

    php -S localhost:8000

6. Access the webpage with the URL

    http://localhost:8000/

7. After pressing "List products" it may take some time to display the fetched results.