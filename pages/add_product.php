<!DOCTYPE html>
<html>
    <head>
        <title>Add Product</title>
        <link rel="stylesheet" href="../css/general.css">
        <link rel="stylesheet" href="../css/form.css">
        <link rel="stylesheet" href="../css/button.css">
        <link rel="stylesheet" href="../css/header.css">
    </head>
    <body>
        
        <header>
            QuickShop
            <div class="subtitle">Your one-stop shop for quick and easy shopping</div>
        </header>
        
        <form action="../backend/process_add_product.php" method="POST">

            <label for="product_name">Product Name</label><br>
            <input type="text" id="product_name" name="product_name" required><br>

            <label for="product_description">Product Description</label><br>
            <input type="text" id="product_description" name="product_description"required><br>

            <label for="product_price">Price</label><br>
            <input type="number" id="product_price" name="product_price" required><br>

            <label for="product_quantity">Quantity</label><br>
            <input type="number" id="product_quantity" name="product_quantity" required><br>

            <input type="submit" value="Add">
        </form>
    </body>
</html>