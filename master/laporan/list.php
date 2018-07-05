<?php
error_reporting(0);
$sql = "SELECT *
FROM 
`product` 
JOIN `orders_detail` 
ON (`product`.`product_id` = `orders_detail`.`product_id`)
JOIN `orders` 
ON (`orders`.`id_orders` = `orders_detail`.`id_orders`) GROUP BY product.product_id";
$resultProduct = mysqli_query($mysqli,$sql);
?>
<div class="wrapper">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    Laporan Penjualan 
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                        <a href="javascript:;" class="fa fa-times"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="adv-table editable-table ">
                        <div class="clearfix">
                            <!-- start -->
                            <div class="btn-group pull-right">
                                <a href="http://localhost/pos/master/laporan/print.php">
                                    <button class="btn btn-primary" type="submit" name="hapus"><i class="fa fa-print"></i> Print</button></a>
                                </div>
                                <!-- end -->
                            </div>
                            <div class="space15"></div>
                            <div id="laporan_pengeluaran">
                                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Nama</th>
                                            <th>Qty</th>
                                            <th>Satuan</th>
                                            <th width="11%">Harga</th>
                                            <th>Sub Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $subtotal = 0;
                                        while ($rowProduct = mysqli_fetch_array($resultProduct)) {
                                            ?>
                                            <tr class="">
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $rowProduct['tgl_order']; ?></td>
                                                <td><b><?php echo $rowProduct['product_name']; ?></b></td>
                                                <td>
                                                    <?php
                                            $sql="SELECT SUM(jumlah) AS hasil FROM orders_detail WHERE product_id='".$rowProduct['product_id']."'";//);
                                            $result=mysqli_query($mysqli,$sql);
                                            while ($data_jumlah=mysqli_fetch_array($result)) {
                                                $hasil=$data_jumlah['hasil'];
                                            }
                                            echo $hasil;
                                            $subtotal = $rowProduct['product_price'] * $hasil                                          ?>
                                        </td>
                                        <td>Pcs</td>
                                        <td>
                                            Rp. <?php echo number_format($rowProduct['product_price'], 0, ',', '.'); ?>
                                        </td>

                                    </td>
                                    <td>Rp. <?php echo number_format($subtotal, 0, ',', '.'); ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
</div>
<script type="text/javascript">
    function PrintElem(elem) {
        Popup($(elem).html());
    }
    function Popup(data) {
        var mywindow = window.open('');
        mywindow.document.write('<html><head><title>CeStruk </title></head>');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');
        mywindow.document.close();
        mywindow.print();
    }
</script>