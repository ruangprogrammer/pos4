<?php
error_reporting(0);
$sql = "SELECT *, YEAR(orders.tgl_order) as tahun
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
                 Trend Projection
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
                               <a href="<?php //echo SITE_HOST;?>master/laporan/print.php">
           <button class="btn btn-primary" type="submit" name="hapus"><i class="fa fa-print"></i> Print</button></a> 
        <!-- end -->
    </div>
    <div class="space15"></div>
    <div id="laporan_pengeluaran">
        <!--         <table  class="display table table-bordered table-striped" id="dynamic-table"> -->
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <!--     <th>No</th> -->
                        <th>Tahun</th>
                        <th>Penjualan (unit)</th>

                    </tr>
                </thead>
                <tbody>                    

            <?php 
                if (isset($_POST['hitung'])) {     
                 $no = 1;
                    $subtotal = 0;
                    while ($rowProduct = mysqli_fetch_array($resultProduct)) {

                        ?>
                        <tr class="">
                            <td><?php echo $rowProduct['tahun']; ?></td>
                            <td><?php 
                            $hasil = $rowProduct['product_price']/$_POST['jumlah'];
                            echo number_format($hasil, 0, ',', '.'); 
                            ?></td>
                        </tr>
                        <?php 

                        }                  
               
                     ?>
                    <!-- <tr>
                        <td colspan="2">--data empty--</td>
                    </tr> -->
                    <?php 
                }else{
                     echo "<tr><td colspan=2>-- data empty --</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
</div>
</div>
<!-- start  -->
<div class="row">
    <div class="col-sm-12">

    </form>
    <section class="panel">
        <form class="cmxform form-horizontal adminex-form" id="commentForm" method="POST" action="">
            <div class="form-group ">

                <div class="col-lg-6">
                    <input class="form-control" id="cname" name="jumlah"
                    type="text" required/>
                </div>
                <div class="col-lg-6">
                     <button class="btn btn-primary" type="submit" name="hitung">HITUNG</button>
                </div>
            </div>
        </form>
        

            </section>
        </div>
    </div>
    <!-- end  -->
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