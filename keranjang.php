<?php
include "koneksi.php";
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

// Initialize cart if not set
if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = array();
}

$koneksi = mysqli_connect("localhost", "root", "", "db_toko");

// Add item to cart
if (isset($_GET['action']) && $_GET['action'] == 'add' && isset($_POST['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    $jumlah = isset($_POST['jumlah']) ? intval($_POST['jumlah']) : 1;

    // Get product details
    $query = "SELECT * FROM product WHERE ID='$id'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        $produk = mysqli_fetch_assoc($result);

        // Add to cart
        $_SESSION['keranjang'][$id] = array(
            'nama' => $produk['nama'],
            'foto' => $produk['foto'],
            'harga' => $produk['harga'],
            'jumlah' => $jumlah
        );
    }
}

// Handle item deletion
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    // Remove item from cart
    if (isset($_SESSION['keranjang'][$id])) {
        unset($_SESSION['keranjang'][$id]);
    }
}

// Display cart items
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cart</title>
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
   
<header data-bs-theme="white">
  <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Sora Cafe</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
      </div>
    </div>
  </nav>
</header>

    <div class="container py-5">
        <h1 class="mb-4">YOUR CART</h1>

        <?php if (empty($_SESSION['keranjang'])): ?>
            <p>Your Cart Is Empty</p>
        <?php else: ?>
            <form method="post" action="co.php">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Amount</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        foreach ($_SESSION['keranjang'] as $id => $item):
                            $subtotal = $item['harga'] * $item['jumlah'];
                            $total += $subtotal;
                        ?>
                            <tr>
                                <td><img src="img/<?= htmlspecialchars($item['foto']) ?>" width="100"></td>
                                <td><?= htmlspecialchars($item['nama']) ?></td>
                                <td>$<?= number_format($item['harga']) ?></td>
                                <td><?= $item['jumlah'] ?></td>
                                <td>$<?= number_format($subtotal) ?></td>
                                <td>
                                    <a href="keranjang.php?action=delete&id=<?= $id ?>" class="btn btn-danger btn-sm">DELETE</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-end"><strong>TOTAL</strong></td>
                            <td><strong>$<?= number_format($total) ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
                <input type="hidden" name="total" value="<?= $total ?>">
                <?php foreach ($_SESSION['keranjang'] as $id => $item): ?>
                    <input type="hidden" name="keranjang[<?= $id ?>][nama]" value="<?= htmlspecialchars($item['nama']) ?>">
                    <input type="hidden" name="keranjang[<?= $id ?>][foto]" value="<?= htmlspecialchars($item['foto']) ?>">
                    <input type="hidden" name="keranjang[<?= $id ?>][harga]" value="<?= htmlspecialchars($item['harga']) ?>">
                    <input type="hidden" name="keranjang[<?= $id ?>][jumlah]" value="<?= htmlspecialchars($item['jumlah']) ?>">
                <?php endforeach; ?>
                <div class="d-flex justify-content-between mt-4">
    <a href="index.php" class="btn btn-outline-secondary">
        <i class="fa fa-arrow-left"></i>CONTINUE SHOPPING
    </a>
    <a href="cetak.php" class="btn btn-primary">
        CHECKOUT <i class="fa fa-arrow-right"></i>
    </a>
</div>

            </form>
        <?php endif; ?>
    </div>
</body>
</html>