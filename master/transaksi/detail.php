<?php 
error_reporting(0);
$id=$_GET['id']; 
$queryRowOrder = mysqli_query($mysqli,"SELECT *
    FROM
    `product`
    INNER JOIN `orders_detail` 
    ON (`product`.`product_id` = `orders_detail`.`product_id`)
    INNER JOIN `orders` 
    ON (`orders`.`id_orders` = `orders_detail`.`id_orders`) WHERE orders.id_orders= '".$id."'"); 
    ?>
    <!--body wrapper start-->
    <div class="wrapper">
        <div class="row">
            <div class="col-lg-12 text-left">
                <section class="panel">
                    <header class="panel-heading">
                        Detail Transaksi Order 
                    </header>

                 <div class="panel-body">
                    <?php 
                    $qOrder=mysqli_query($mysqli,"SELECT * FROM orders WHERE id_orders ='".$id."'");
                    $dataOrder=mysqli_fetch_array($qOrder);
                    ?>
                    Nama Petugas : <b><?php echo $dataOrder['nama_petugas']; ?></b><br>
                    Tanggal : 
                    <b>
                        <?php
                        
                        echo $dataOrder['tgl_order']."";  
                        ?>
                    </b>
                    <table class="table">
                        <thead>
                            <tr><td>No</td>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no=1;
                            $total=0;

                            while($data=mysqli_fetch_array($queryRowOrder)){
                                $sub_total=+$data['product_price'] * $data['jumlah'];
                                $total+=$sub_total;
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $no++; ?>
                                    </td>
                                    <td>
                                       <?php echo $data['product_name'] ?></td>
                                       <td>Rp. <?php echo number_format($data['product_price'],0,',','.'); ?></td>
                                       <td><?php echo $data['jumlah'];  ?></td>
                                       <td>Rp. <?php echo number_format($sub_total,0,',','.'); ?></td>
                                   </tr>
                                   <?php } ?>
                                   <tr>
                                    <td colspan="4">Diskon</td>
                                    <td>Rp. 
                                        <?php 
                                        if($dataOrder['diskon'] == 0){
                                            echo "0";
                                        }else{
                                            echo  number_format($dataOrder['diskon'],0,',','.');
                                        }
                                        ?>    
                                        </td>
                                   </tr
                                   >
                                   <tr>
                                    <td colspan="4">
                                        Total
                                    </td>
                                    <td>Rp. 
                                        <?php 
                                        $jumlah_total = $total - $dataOrder['diskon'];
                                        echo number_format($jumlah_total,0,',','.'); 
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                </tr>
                            </tbody>
                        </table>
                    </div>  
                </section>
            </div>
        </div>
    </div>
