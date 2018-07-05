<?php
session_start();
error_reporting(0);
include 'config.php';
//http://harviacode.com/2014/09/23/membuat-fungsi-terbilang-php/

$bulan = array(
    '01' => 'Januari',
    '02' => 'Februari',
    '03' => 'Maret',
    '04' => 'April',
    '05' => 'Mei',
    '06' => 'Juni',
    '07' => 'Juli',
    '08' => 'Agustus',
    '09' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember',
);



function kekata($x) {
    $x = abs($x);
    $angka = array("", "satu", "dua", "tiga", "empat", "lima",
        "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($x <12) {
        $temp = " ". $angka[$x];
    } else if ($x <20) {
        $temp = kekata($x - 10). " belas";
    } else if ($x <100) {
        $temp = kekata($x/10)." puluh". kekata($x % 10);
    } else if ($x <200) {
        $temp = " seratus" . kekata($x - 100);
    } else if ($x <1000) {
        $temp = kekata($x/100) . " ratus" . kekata($x % 100);
    } else if ($x <2000) {
        $temp = " seribu" . kekata($x - 1000);
    } else if ($x <1000000) {
        $temp = kekata($x/1000) . " ribu" . kekata($x % 1000);
    } else if ($x <1000000000) {
        $temp = kekata($x/1000000) . " juta" . kekata($x % 1000000);
    } else if ($x <1000000000000) {
        $temp = kekata($x/1000000000) . " milyar" . kekata(fmod($x,1000000000));
    } else if ($x <1000000000000000) {
        $temp = kekata($x/1000000000000) . " trilyun" . kekata(fmod($x,1000000000000));
    }     
    return $temp;
}


function terbilang($x, $style=4) {
    if($x<0) {
        $hasil = "minus ". trim(kekata($x));
    } else {
        $hasil = trim(kekata($x));
    }     
    switch ($style) {
        case 1:
        $hasil = strtoupper($hasil);
        break;
        case 2:
        $hasil = strtolower($hasil);
        break;
        case 3:
        $hasil = ucwords($hasil);
        break;
        default:
        $hasil = ucfirst($hasil);
        break;
    }     
    return $hasil;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="#" type="image/png">
    <title>Techindo Global Solusi</title>
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
</head>
<body class="print-body">
    <section>
        <!--body wrapper start-->
        <div class="wrapper">
            <div class="panel">
                <div class="panel-body invoice">
                    <div class="row">
                        <div class="col-md-5 col-sm-4 col-xs-3">
                            <h4>Techindo Global Solusi</h4>
                        </div>
                        <div class="col-md-3 col-md-offset-4 col-sm-4 col-sm-offset-4 col-xs-5 col-xs-offset-4 ">

                            <h1>INVOICE</h1> <br/>
                            <p>Kepada : CASH</p>

                        </div>
                    </div>

                    <div class="invoice-address">
                        <div class="row">
                            <div class="col-md-5 col-sm-5 col-xs-5">
                                <h4 class="inv-to">NO. INVOICE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php  echo $_POST['id_orders']; ?> </h4>
                                <h4 class="inv-to">NO. ORDER&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $_POST['id_orders']; ?></h4>
                                <h4 class="inv-to">PEMBAYARAN&nbsp;&nbsp;&nbsp;: CASH</h4>
                            </div>
                            <div class="col-md-4 col-md-offset-3 col-sm-4 col-sm-offset-3 col-xs-4 col-xs-offset-3">
                                <div class="inv-col2"><span>Telp//Fax : +62 1234567</span> </div>
                            </div>
                        </div>
                    </div>
                </div>


                <table class="table table-bordered table-invoice" border="2">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>KETERANGAN</th>
                            <th class="text-center">QTY</th>
                            <th class="text-center">HARGA/UNIT</th>
                            <th class="text-center">JUMLAH</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $CetakNota = mysqli_query($mysqli, "SELECT * FROM orders_detail,product 
                         WHERE orders_detail.product_id=product.product_id 
                         AND id_orders='$_POST[id_orders]'");
                        $totalcetak = 0;
                        $itemcetak = 0;
                        $no = 1;
                        while ($datacetak = mysqli_fetch_array($CetakNota)) {
                            $subtotalcetak = +$datacetak['jumlah'] * $datacetak['product_price'];
                            $totalcetak += $subtotalcetak;
                            $itemcetak += $datacetak['jumlah'];
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td>
                                    <h4><?php echo $datacetak['product_name']; ?></h4>

                                </td>
                                <td class="text-center"><strong><?php echo $datacetak['jumlah'] ?> UNIT</strong></td>
                                <td class="text-center">
                                    <strong>Rp. <?php echo number_format($datacetak['product_price'], 0, ',', '.'); ?></strong>
                                </td>
                                <td class="text-center">
                                    <strong>Rp. <?php echo number_format($subtotalcetak, 0, ',', '.'); ?></strong></td>
                                </tr>
                            <?php } ?>

                            <tr>
                                <td colspan="4" class="text-right" style="text-align: right;">
                                    <strong>
                                       JUMLAH
                                    </strong>
                                </td>
                                <td class="text-center">
                                    <strong>
                                        Rp. <?php 
                                        $list_price = str_replace(".", "", $_POST['cash']);
                                        $discount_total = $_POST['diskon_price'];
                                        //$discount_amount = $list_price * $discount_percent * .01;

                                        $discount_price = $list_price - $discount_total;

                                        echo number_format(str_replace(".", "", $discount_price), 0, ',', '.'); ?>
                                    </strong>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="4" class="text-right" style="text-align: right;"><strong>DISKON</strong></td>
                                <td  style="text-align:  center;"><strong>Rp. <?php echo number_format($_POST['diskon_price'], 0, ',', '.'); ?></strong></td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-right" style="text-align: right;"><strong>CASH</strong></td>
                                <td  style="text-align:  center;"><strong>Rp. <?php echo number_format(str_replace(".", "", $_POST['cash']), 0, ',', '.'); ?></strong></td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-right" style="text-align: right;"><strong>KEMBALI</strong></td>
                                <td  style="text-align:  center;"><strong>Rp. <?php 
                                
                                echo number_format($_POST['kembali'], 0, ',', '.'); 

                                ?></strong></td>
                            </tr>


                        </tbody>
                    </div>
                </table>
                <br>
                <div class="panel-body invoice">

                    <div class="invoice-address">
                        <div class="row">
                            <div class="col-md-5 col-sm-5 col-xs-5">  
                             &nbsp; &nbsp; &nbsp; Jakarta, <?php echo date('d')." ".$bulan[date('m')]." ".date('Y'); ?><br><br><br><br>
                             &nbsp; &nbsp;
                             <br>&nbsp; &nbsp;&nbsp; &nbsp;Authorized Signature
                         </div>
                         <div class="col-md-4 col-md-offset-3 col-sm-4 col-sm-offset-3 col-xs-4 col-xs-offset-3">
                            &nbsp; &nbsp; &nbsp; Di terima Oleh,<br><br><br><br>
                            &nbsp; &nbsp;
                            <br> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Customer
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--body wrapper end -->
    </section>

<!--
 Placed js at the end of the document so the pages load faster 
-->

<script src="assets/js/jquery-1.10.2.min.js"></script>
<script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/modernizr.min.js"></script>
<!--common scripts for all pages-->
<script src="assets/js/scripts.js"></script>
<script type="text/javascript">
  window.print();
</script>

</body>
</html>
