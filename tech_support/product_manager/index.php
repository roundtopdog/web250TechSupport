<?php
require('../model/database.php');
require('../model/product_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'list_products';
    }
}

if ($action == 'list_products') {
    $products = get_products();
    include('product_list.php');
} else if ($action == 'delete_product') {
    $product_code = filter_input(INPUT_POST, 'product_code');
    delete_product($product_code);
    header("Location: ."); // redirect request returns to the same page
} else if ($action == 'show_add_form') {
    include 'product_add.php';
} else if ($action == 'add_product') {
    $code = filter_input(INPUT_POST, 'code');
    $name = filter_input(INPUT_POST, 'name');
    $version = filter_input(INPUT_POST, 'version', FILTER_VALIDATE_FLOAT);
    $release_date = filter_input(INPUT_POST, 'release_date');

    // Validate the inputs
    if ( $code === NULL || $name === FALSE || 
            $version === NULL || $version === FALSE || 
            $release_date === NULL) {
        $error = "Invalid product data. Check all fields and try again.";
        include('../errors/error.php');
    } else {
        add_product($code, $name, $version, $release_date);
        header("Location: .");
    }
}



?>