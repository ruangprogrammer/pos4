<?php
//
// hjsjjs jjs jjsj jjs
// diskon = (diskon - 100) /100 * HARGA semula ;   
// jshdhsd hhs hhsbmmfkfiiiw jjdhfyyuwh nji
// 
//
//jshdjsd jksdj jjs
function isi_keranjang()
{
    include('config.php');
    $isikeranjang = array();
    $sid = session_id();
    $sql = mysqli_query($mysqli,"SELECT * FROM orders_temp WHERE id_session='$sid'");

    while ($r = mysqli_fetch_array($sql)) {
        $isikeranjang[] = $r;
    }
    return $isikeranjang;
}
$isikeranjang = isi_keranjang();
$jml = count($isikeranjang);
$chash_bayar = str_replace(".", "", $_POST['cash']);
$grand_total_product = str_replace(".", "", $_POST['grand_total']);

if($chash_bayar < $grand_total_product){
    echo "<script> alert('Maaf pembayaran kurang dari Rp. ".number_format($grand_total_product, 0, ',', '.')." '); location.href='index.php?hal=pos' </script>";
    exit();
}
if($_POST['diskon_price'] > $grand_total_product){
 echo "<script> alert('Maaf diskon tidak boleh melebihi grand total'); location.href='index.php?hal=pos' </script>";
 exit();
}


if ($jml == 0) {
    echo "<script> alert('Product masih kosong'); location.href='index.php?hal=pos' </script>";
    exit();
}
//$tgl_skrg = date("Y-m-d");
$jam_skrg = date("H:i:s");
// simpan data pemesanan
mysqli_query($mysqli,"INSERT INTO 
    orders(nama_petugas, tgl_order, jam_order) 
    VALUES ('" . $_SESSION['username'] . "',NOW(),'$jam_skrg')");
//exit();
// mendapatkan nomor orders
$id_orders = mysqli_insert_id($mysqli);
// panggil fungsi isi_keranjang dan hitung jumlah produk yang dipesan
// simpan data detail pemesanan
for ($i = 0; $i < $jml; $i++) {
    mysqli_query($mysqli,"INSERT INTO orders_detail(id_orders, product_id, jumlah) 
     VALUES('$id_orders',{$isikeranjang[$i]['product_id']}, {$isikeranjang[$i]['jumlah']})");

    mysqli_query($mysqli,"UPDATE product SET product_stock=product_stock - {$isikeranjang[$i]['jumlah']} WHERE product_id={$isikeranjang[$i]['product_id']}");

}
//exit();
for ($i = 0; $i < $jml; $i++) {

    mysqli_query($mysqli,"DELETE FROM orders_temp WHERE id_orders_temp = {$isikeranjang[$i]['id_orders_temp']}");
}
$daftarproduk = mysqli_query($mysqli,"SELECT * FROM orders_detail,product 
   WHERE orders_detail.product_id=product.product_id 
   AND id_orders='$id_orders'");
   ?>
   <!--header start -->

   <!-- header end -->
   <div class="wrapper">

    <div class="row blog">

        <div class="col-md-7">

            <div class="panel">
                <div class="panel-body"> 
                    <h1>Cash Rp. <?php echo number_format(str_replace(".", "", $_POST['cash']), 0, ',', '.'); ?></h1>
                </div>
            </div>

            <div class="panel">
                <div class="panel-body">
                    <div class="blog-post">
                        <div class="media">
                            <div class="panel-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Harga</th>
                                            <th>Qty</th>
                                            <th>Sub Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $total = 0;
                                        while ($data = mysqli_fetch_array($daftarproduk)) {
                                            $sub_total = +$data['product_price'] * $data['jumlah'];
                                            $total += $sub_total;
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $data['product_name'] ?></td>
                                                    <td>
                                                        Rp. <?php echo number_format($data['product_price'], 0, ',', '.'); ?></td>
                                                        <td><?php echo $data['jumlah']; ?></td>
                                                        <td>Rp. <?php echo number_format($sub_total, 0, ',', '.'); ?></td>
                                                    </tr>
                                                <?php }
                                                ?>
                                                <tr>
                                                    <td colspan="3">Diskon</td>
                                                    <td>Rp. <?php echo number_format($_POST['diskon_price'], 0, ',', '.')?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                        Total
                                                    </td>
                                                    <td>Rp.
                                                        <?php

                                                        $list_price = str_replace(".", "", $total);
                                                        $discount_total = $_POST['diskon_price'];
                                                      //  $discount_amount = $list_price * $discount_percent * .01;

                                                        $discount_price = $list_price - $discount_total;

                                                        echo number_format($discount_price, 0, ',', '.'); 
                                                        $kembalinya = str_replace(".", "", $_POST['cash']) - $discount_price;
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" align="reight">
                                                        <!-- print new -->
                                                        <form method="post" action="struct_print.php" target="_blank">

                                                            <input type="hidden" name="kembali" value="<?php echo $kembalinya; ?>">

                                                            <input type="hidden" name="diskon_price" value="<?php echo $_POST['diskon_price']; ?>">
                                                            <input type="hidden" name="cash" value="<?php echo $_POST['cash']; ?>">
                                                            <input type="hidden" name="id_orders" value="<?php echo $id_orders; ?>">
                                                            <button class="btn btn-primary" type="submit">
                                                                <i class="fa fa-print"></i> print
                                                            </button>
                                                        </form>
                                                        <!-- print end -->
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div id="struk">
                        <!-- struk -->
                        <div style="width:327px; 
                        padding:0 10px 20px 10px; 
                        margin:0 auto; 
                        background:#ffffff; color:#4d4d4d;
                        font:13px /1.5 Tahoma; border:4px double #dddddd;">
                        <table cellpadding="0" cellspacing="0" border="0">
                            <tbody>
                                <tr>
                                    <td valign="top"
                                    style="width:100px; padding:10px 0; border-bottom:4px double #dddddd;text-align: center;">
                                    <img src="assets/images/logoo.jpg" style="margin:0 auto; width:75px; border:0;">
                                </td>
                                <td colspan="2" valign="top"
                                style="width:180px; padding:10px 0; border-bottom:4px double #dddddd; text-align:center; font-size:11px; line-height:16px;    padding-top: 20px;">
                                Techindo Global Solusi<br>
                                Mangga Dua Mall, Lantai 5 Blok B-80<br>
                                Jl.Mangga Dua Raya,Jakarta 10730<br>
                                TLP. 021 62304298, 021 623099406<br>                                    
                            </td>
                        </tr>

                        <tr>
                            <td valign="top" style="width:100px; padding:10px 0 0 0; font-size:11px; ">
                                Nota : <?php echo $id_orders; ?> </td>
                                <td colspan="2" valign="top" style="width:100px; padding:10px 0 0 0;font-size:11px; "> KASA
                                    : 01 <?php echo $_SESSION['username']; ?>
                                </td>
                            </tr>
                            <?php
                            $CetakNota = mysqli_query($mysqli,"SELECT * FROM orders_detail,product 
                               WHERE orders_detail.product_id=product.product_id 
                               AND id_orders='$id_orders'");
                            $totalcetak = 0;
                            $itemcetak = 0;
                            while ($datacetak = mysqli_fetch_array($CetakNota)) {
                                $subtotalcetak = +$datacetak['jumlah'] * $datacetak['product_price'];
                                $totalcetak += $subtotalcetak;
                                $itemcetak += $datacetak['jumlah'];
                                ?>
                                <tr>
                                    <td valign="top"
                                    style="width:100px; padding:10px 0 0 0; font-size:11px; "><?php echo $datacetak['product_id']; ?></td>
                                    <td valign="top" style="width:100px; padding:10px 0 0 0;font-size:11px; ">
                                        <?php echo $datacetak['product_name']; ?>
                                    </td>
                                    <td style="font-size:11px; text-align: right;">
                                        Rp. <?php echo number_format($subtotalcetak, 0, ',', '.'); ?></td>
                                    </tr>
                                </tr>
                                <?php
                            }
                            ?>

                            <tr>
                                <td></td>
                                <td valign="top" style="width:100px; padding:10px 0 0 0;font-size:11px; ">Netto</td>
                                <td valign="top" style="width:100px; padding:10px 0 0 0;font-size:11px;text-align: right; ">
                                    Rp. <?php

                                    $list_price = $totalcetak;
                                    $discount_total = $_POST['diskon_price'];
                                   // $discount_amount = $list_price * $discount_percent * .01;

                                    $discount_price = $list_price - $discount_total;

                                    echo number_format($discount_price, 0, ',', '.'); 


                                    ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td valign="top" style="width:100px; padding:3px 0 0 0;font-size:11px; ">CASH</td>
                                    <td valign="top" style="width:100px; padding:3px 0 0 0;font-size:11px;text-align: right; ">
                                        Rp. <?php echo number_format(str_replace(".", "", $_POST['cash']), 0, ',', '.'); ?></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td valign="top" style="width:100px; padding:3px 0 0 0;font-size:11px; ">Kembali</td>
                                        <td valign="top" style="width:100px; padding:3px 0 0 0;font-size:11px;text-align: right;">
                                            <?php
                                           // $kembali = str_replace(".", "", $_POST['cash']) - $totalcetak;
                                            echo number_format($kembalinya, 0, ',', '.');
                                            ?>
                                        </td>
                                    </tr>

                                    
                                    <tr>
                                        <td></td>
                                        <td valign="top" style="width:100px; padding:3px 0 0 0;font-size:11px; ">Diskon</td>
                                        <td valign="top" style="width:100px; padding:3px 0 0 0;font-size:11px;text-align: right;">
                                         Rp. 
                                         <?php
                                         echo number_format($_POST['diskon_price'], 0, ',', '.'); 

                                         ?>
                                     </td>
                                 </tr> 



                                 <tr>
                                    <td></td>
                                    <td valign="top" style="width:100px; padding:3px 0 0 0;font-size:11px; ">Items</td>
                                    <td valign="top"
                                    style="width:100px; padding:3px 0 0 0;font-size:11px;text-align: right; "><?php echo $itemcetak; ?></td>
                                </tr>

                                <tr>
                                    <td colspan="3" valign="top"
                                    style="text-align: center;width:100px; padding:10px 0 0 0;font-size:11px; ">
                                    ***************<?php echo date("Y-m-d") . "-" . date("H:i:s"); ?>**************
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" style="text-align: center;font-size:11px; ">BARANG YANG SUDAH DIBELI</td>
                            </tr>
                            <tr>
                                <td colspan="3" style="text-align: center;font-size:11px; ">TIDAK DAPAT
                                    DITUKAR/DIKEMBALIKAN
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- struk end -->
        </div>
    </div>
</div>