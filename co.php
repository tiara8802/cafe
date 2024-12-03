<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pembelian</title>
    <link href="css/styles.css" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-10">
    
    <?php
    include 'koneksi.php';
    $id = (int)$_GET['id'];

    $trans = "SELECT * FROM tb_detail
    INNER JOIN tb_transaksi ON tb_detail.id_transaksi = tb_transaksi.id_transaksi
    WHERE tb_detail.id_transaksi='$id'";
    $query = mysqli_query($koneksi, $trans);
    $data = mysqli_fetch_array($query);

    $res = "SELECT * FROM tb_transaksi
    INNER JOIN tb_user ON tb_transaksi.id_pelanggan = tb_user.id
    WHERE tb_transaksi.id_transaksi='$id'";
    $query = mysqli_query($koneksi, $res);
    $user = mysqli_fetch_array($query);
    ?>
    <div class="max-w-3xl mx-auto bg-white p-8 shadow-lg rounded-lg">
        <h2 class="text-3xl font-bold text-center mb-6">Nota Pembelian</h2>

        <!-- User and Transaction Info -->
        <div class="mb-6">
            <div class="flex justify-between items-center mb-2">
                <p class="text-sm text-gray-600">No Nota:</p>
                <p class="font-semibold"><?php echo $id; ?></p>
            </div>
            <div class="flex justify-between items-center mb-2">
                <p class="text-sm text-gray-600">Nama Pelanggan:</p>
                <p class="font-semibold"><?php echo $user['nama']; ?></p>
            </div>
            <div class="flex justify-between items-center">
                <p class="text-sm text-gray-600">Tanggal Transaksi:</p>
                <p class="font-semibold"><?php echo $data['tanggal']; ?></p>
            </div>
        </div>

        <!-- Products Table -->
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-3 px-4 bg-gray-200 text-left text-sm font-semibold text-gray-700">Produk</th>
                    <th class="py-3 px-4 bg-gray-200 text-left text-sm font-semibold text-gray-700">Kuantitas</th>
                    <th class="py-3 px-4 bg-gray-200 text-left text-sm font-semibold text-gray-700">Harga</th>
                    <th class="py-3 px-4 bg-gray-200 text-left text-sm font-semibold text-gray-700">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $total = 0;
                    $prod = "SELECT * FROM tb_detail
                    INNER JOIN produk ON tb_detail.id_produk = produk.id
                    WHERE tb_detail.id_transaksi = $id";
                    $query2 = mysqli_query($koneksi, $prod);
                    while($row = mysqli_fetch_array($query2)){
                        $subtotal = $row['harga'] * $row['jumlah'];
                        $total += $subtotal;
                ?>
                <tr>
                    <td class="py-4 px-4 border-b"><?php echo $row['nama']; ?></td>
                    <td class="py-4 px-4 border-b"><?php echo $row['jumlah']; ?></td>
                    <td class="py-4 px-4 border-b"><?php echo number_format($row['harga']); ?></td>
                    <td class="py-4 px-4 border-b"><?php echo number_format($subtotal); ?></td>
                </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="py-4 px-4 text-right font-semibold text-gray-700">Total:</td>
                    <td class="py-4 px-4 text-right font-semibold text-gray-900"><?php echo number_format($total); ?> </td>
                </tr>
            </tfoot>
        </table>

        <!-- Footer -->
        <div class="mt-8 text-center">
            <p class="text-sm text-gray-500 mb-4">Terima kasih atas pembelian Anda!</p>
            <button class="bg-blue-600 text-white px-6 py-2 rounded-md shadow-md hover:bg-blue-700" id="print">Print Nota</button>
        </div>
    </div>

    <script>
        document.getElementById("print").addEventListener('click', () => {
            window.print();
        });
    </script>
</body>
</html>