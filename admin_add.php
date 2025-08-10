<?php
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION["email"]) || $_SESSION["admin"] != 1) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="./css&js/index_ai.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="./css&js/product.css">
    <link rel="stylesheet" href="./css&js/admin.css">
    <link rel="icon" href="photos/doge_logo_v2.png" type="image/png" />
    <title>DogeBee Admin - Add Product</title>
</head>
<body>
    <!-- Top Navigation -->
    <div class="topnav">
        <nav class="navbar bg-body-tertiary">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img src="./photos/doge_logo_v2.png" alt="DogeBee Logo" width="60" height="70">
                </a>
            </div>
            <div class="header" style="color:rgb(255, 255, 255);">
                <h1>DogeBee</h1>
                <p class="tagline">Add New Product</p>
            </div>
        </nav>
    </div>
    
    <!-- Main Navigation -->
    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="products.php">Products</a>
        <div class="dropdown">
            <button class="dropbtn">Browse by Brand
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="products.php?brand=Sennheiser">Sennheiser</a>
                <a href="products.php?brand=Audio-Technica">Audio Technica</a>
                <a href="products.php?brand=Shure">Shure</a>
            </div>
        </div>
        <a href="products.php?remarks=over">Headphones</a>
        <a href="about.html">About</a>
        <div class="nav-utilities">
            <div class="search-container">
                <input type="text" placeholder="Search..." class="search-input">
                <button class="search-btn"><i class="fa fa-search"></i></button>
            </div>
            <div class="nav-icons">
                <a href="cart.php">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <?php if (!empty($_SESSION['cart'])): ?>
                        <span class="cart-count"><?= count($_SESSION['cart']) ?></span>
                    <?php endif; ?>
                </a>
                <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
            </div>
        </div>
    </div>
    
    <!-- Add Product Form -->
    <div class="edit-container">
        <div class="edit-header">
            <h1><i class="fas fa-plus-circle"></i> Add New Product</h1>
            <p>Enter product information below</p>
        </div>
        
        <form method="POST" action="admin_add_submit.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="brand">Brand</label>
                <input type="text" class="form-control" name="brand" placeholder="Enter Brand" required>
            </div>
            
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter Product Name" required>
            </div>
            
            <div class="form-group">
                <label for="price">Price (HKD)</label>
                <input type="number" step="1" class="form-control" name="price" placeholder="Enter Price" required>
            </div>
            
            <div class="form-group">
                <label for="style">Style</label>
                <select name="style" class="form-control" required>
                    <option value="neutural">Neutural</option>
                    <option value="bright">Bright</option>
                    <option value="bass">Bass</option>
                </select>
            </div>

            <div class="form-group">
                <label for="remarks">Category</label>
                <select name="remarks" class="form-control" required>
                    <option value="over">Headphones</option>
                    <option value="in">Earphones (In-ear)</option>
                    <option value="half-in">Earphones (Half-in)</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="product_link">Product Link</label>
                <input type="text" class="form-control" name="product_link" placeholder="Enter Product URL">
            </div>
            
            <div class="form-group">
                <label for="image">Product Image</label>
                <input type="file" class="form-control" name="image" required>
            </div>
            
            <button type="submit" class="btn-primary">Add Product</button>
            <a href="admin.php" class="btn-primary" style="background-color: #777; text-decoration: none; display: inline-block; margin-left: 10px;">Cancel</a>
        </form>
    </div>
    
    <script>
        // Simple form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const price = document.querySelector('input[name="price"]');
            if (price.value <= 0) {
                alert('Price must be greater than 0');
                e.preventDefault();
            }
        });
    </script>
</body>
</html>