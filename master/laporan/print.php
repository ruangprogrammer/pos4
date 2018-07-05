<?php
session_start();
error_reporting(0);
include("../../config.php");
    //echo $sql
$sql = "SELECT *
FROM 
`product` 
JOIN `orders_detail` 
ON (`product`.`product_id` = `orders_detail`.`product_id`)
JOIN `orders` 
ON (`orders`.`id_orders` = `orders_detail`.`id_orders`) GROUP BY product.product_id";
$resultTransaksi=mysqli_query($mysqli,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="#" type="image/png">
    <title>Laporan Penjualan</title>
    <link href="../../assets/css/style.css" rel="stylesheet">
    <link href="../../assets/css/style-responsive.css" rel="stylesheet">
</head>
<body class="print-body">
    <section>
        <!--body wrapper start-->
        <div class="wrapper">
            <div class="panel">
                <div class="panel-body invoice">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-3">
                            <h2>Laporan Penjualan</h2>
                        </div>
                        <div class="col-md-4 col-md-offset-4 col-sm-4 col-sm-offset-4 col-xs-5 col-xs-offset-4 ">
                
                    </div>
                </div>
                <div class="invoice-address">
                  <div class="row">
                    <div class="col-md-5 col-sm-5 col-xs-5">
                     <h2 class="corporate-id"> CHOCHO MAMA</h2>
                     <p>

                        Jl. RAYA TANJUNG KM 5 BLENCONG<br>
                        GUNUNG SARI LOMBOK BARAT<br>
                        Phone: +61 3 8376 6284,
                        NPWP : 09.000.000.000.00.9-888.00
                        </p>
                </div>
            </div>
            <table class="table table-bordered table-invoice">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Id Order</th>
                        <th>Tanggal Order</th>
                        <th>Petugas</th>
                        <th>Jumlah Item</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    
                    while ($rowTransaksi = mysqli_fetch_array($resultTransaksi)) {
                        $sub_total = +$rowTransaksi['product_price'] * $rowTransaksi['jumlah'];
                        $total += $sub_total;
                        ?>
                        <tr class="">
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $rowTransaksi['id_orders'] ?></td>
                            <td><?php echo $rowTransaksi['tgl_order'] ?>/<?php echo $rowTransaksi['tgl_order'] ?></td>
                            <td><?php echo $rowTransaksi['nama_petugas'] ?></td>
                            <td>
                                <?php
                                $queryQTY = mysqli_query($mysqli,"SELECT SUM(orders_detail.jumlah) AS jumlahqty , product.product_id
                                    FROM
                                    `orders`
                                    INNER JOIN `orders_detail` 
                                    ON (`orders`.`id_orders` = `orders_detail`.`id_orders`)
                                    INNER JOIN `product` 
                                    ON (`product`.`product_id` = `orders_detail`.`product_id`) WHERE orders.id_orders='" . $rowTransaksi['id_orders'] . "' ");
                                $QTY = mysqli_fetch_array($queryQTY);

                                echo $QTY['jumlahqty'];
                                ?>
                            </td>
                            <td>
                                <?php
                                $queryTotal = mysqli_query($mysqli,"SELECT *
                                    FROM
                                    `orders`
                                    INNER JOIN `orders_detail` 
                                    ON (`orders`.`id_orders` = `orders_detail`.`id_orders`)
                                    INNER JOIN `product` 
                                    ON (`product`.`product_id` = `orders_detail`.`product_id`) WHERE orders.id_orders='" . $rowTransaksi['id_orders'] . "'");
                                $totalQuery = 0;
                                while ($rowQueryTotal = mysqli_fetch_array($queryTotal)) {

                                    $subTotal = +$rowQueryTotal['jumlah'] * $rowQueryTotal['product_price'];
                                    $totalQuery += $subTotal;
                                }
                                echo "Rp. " . number_format($totalQuery, 0, ',', ',');
                                ?>
                            </td>

                        </tr>
                        <?php } ?>

                    </tbody>

                </table>
            </div>
        </div>
    <script src="../../assets/js/jquery-1.10.2.min.js"></script>
    <script src="../../assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/modernizr.min.js"></script>
    <script src="../../assets/js/scripts.js"></script>
    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>
