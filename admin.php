<?php
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION["email"]) || $_SESSION["admin"] != 1) {
    header("Location: login.html");
    exit();
}

$connectdb = mysqli_connect("localhost","root","","dogebee");
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
mysqli_set_charset($connectdb,"utf8");

// Handle product deletion
if (isset($_GET['delete'])) {
    $productId = $_GET['delete'];
    $deleteQuery = "DELETE FROM items WHERE id = ?";
    $stmt = mysqli_prepare($connectdb, $deleteQuery);
    mysqli_stmt_bind_param($stmt, "i", $productId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: admin.php");
    exit();
}

// Get all products - using * since we're not sure of exact column names
$sql_check_items = "SELECT * FROM items";
$result = mysqli_query($connectdb, $sql_check_items);

// Get counts for filter display (matches products.php)
$over_count = 0;
$in_count = 0;
$sql_over = "SELECT count(*) FROM items WHERE remarks = 'over'";
$result_over = mysqli_query($connectdb, $sql_over);
if ($result_over) {
    $row = mysqli_fetch_row($result_over);
    $over_count = $row[0];
}

$sql_in = "SELECT count(*) FROM items WHERE remarks = 'in' OR remarks = 'half-in'";
$result_in = mysqli_query($connectdb, $sql_in);
if ($result_in) {
    $row = mysqli_fetch_row($result_in);
    $in_count = $row[0];
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
    <title>DogeBee Admin</title>
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
                <p class="tagline">Administration Panel</p>
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
    
    <!-- Admin Content -->
    <div class="admin-container">
        <div class="admin-header">
            <h1><i class="fas fa-tools"></i> Administration Page</h1>
            <p>Manage your product inventory and settings</p>
        </div>
        
        <!-- Statistics Cards -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-value"><?= mysqli_num_rows($result) ?></div>
                <div class="stat-label">Total Products</div>
            </div>
            <div class="stat-card">
                <div class="stat-value"><?= $over_count ?></div>
                <div class="stat-label">Headphones</div>
            </div>
            <div class="stat-card">
                <div class="stat-value"><?= $in_count ?></div>
                <div class="stat-label">Earphones</div>
            </div>
        </div>
        
        <table class="products-table">
            <tr>
                <th>ID</th>
                <th>Brand</th>
                <th>Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = mysqli_fetch_row($result)): ?>
                <tr>
                    <td><?= htmlspecialchars($row[0] ?? '') ?></td>
                    <td><?= htmlspecialchars($row[1] ?? '') ?></td>
                    <td><?= htmlspecialchars($row[2] ?? '') ?></td>
                    <td><?= number_format($row[3] ?? 0, 1) ?> HKD</td>
                    <td><?= htmlspecialchars($row[4] ?? '') ?></td>
                    <td>
                        <?php if (!empty($row[6])): ?>
                            <img src="<?= htmlspecialchars($row[6]) ?>" alt="<?= htmlspecialchars($row[2] ?? 'Product Image') ?>">
                        <?php else: ?>
                            No Image
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="action-icons">
                            <a href="admin_edit.php?productID=<?= $row[0] ?>" class="edit-btn" title="Edit">
                                <i class="fas fa-pen-to-square"></i>
                            </a>
                            <a href="admin.php?delete=<?= $row[0] ?>" class="delete-btn" title="Delete" onclick="return confirm('Are you sure you want to delete this product?');">
                                <i class="fas fa-trash-can"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
        
        <a href="admin_add.php" class="add-btn">
            <i class="fas fa-plus"></i> Add New Product
        </a>
    </div>

</body>
</html>

<?php
mysqli_close($connectdb);
?>