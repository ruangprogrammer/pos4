<?php
error_reporting(0);

if (isset($_POST['simpan'])) {

    $queryInsert = mysqli_query($mysqli,"INSERT INTO forecasting 
                            SET fc_tahun='".$_POST['tahun']."',
                                fc_penjualan='".$_POST['penjualan']."',
                                fc_status='mv'");
    if ($queryInsert) {
        echo "<script> alert('Data Berhasil Disimpan'); location.href='index.php?hal=master/movingaverage/list' </script>";
        exit;
    }
}


$sql = "SELECT *,SUM(fc_penjualan) AS penjualan FROM forecasting WHERE fc_status='mv' GROUP BY fc_tahun";
$resultProduct = mysqli_query($mysqli,$sql);
?>
<div class="wrapper">
    <!-- start moving average -->
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <div class="panel-body">
                    <div class=" form">
                        <form class="cmxform form-horizontal adminex-form" id="commentForm" method="POST" action="">
                            <div class="form-group ">
                                <label for="cname" class="control-label col-lg-2" style="text-align: left;">
                                Tahun</label>
                                <div class="col-lg-6">
                                  
                                        <select name="tahun" class="form-control">
                                              <?php for($i=2000;$i<=date('Y');$i++){ ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php } ?>
                                        </select>
                                    <!-- <input class=" form-control" id="cname" name="tahun" minlength="2" type="text" required=""> -->
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="cname" class="control-label col-lg-2" style="text-align: left;">
                                Panjualan (unit)</label>
                                <div class="col-lg-6">
                                    <input class=" form-control" id="cname" name="penjualan" minlength="2" type="text" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-primary" type="submit" name="simpan">SIMPAN</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- end movingaverage -->

    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                  Moving Average
                  <span class="tools pull-right">
                    <a href="javascript:;" class="fa fa-chevron-down"></a>
                    <a href="javascript:;" class="fa fa-times"></a>
                </span>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="btn-group pull-right">
                        </div>
                    </div>
                    <div class="space15"></div>
                    <div id="laporan_pengeluaran">
                        <table class="table table-striped table-hover table-bordered" id="editable-sample">
                            <thead>
                                <tr>
                                    <!--     <th>No</th> -->
                                    <th>Tahun</th>
                                    <th>Penjualan (unit)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $subtotal = 0;
                                while ($rowProduct = mysqli_fetch_array($resultProduct)) {
                                    ?>
                                    <tr class="">
                                        <td><?php echo $rowProduct['fc_tahun']; ?></td>
                                        <td><?php echo number_format($rowProduct['penjualan'], 0, ',', '.'); ?></td>
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

    <!-- start hitung -->
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <div class="panel-body">
                    <div class=" form">
                        <form class="cmxform form-horizontal adminex-form" id="commentForm" method="POST" action="">
                            <div class="form-group ">
                                <div class="col-lg-6">
                                    <input class=" form-control" id="cname" name="category_name" minlength="2" type="text" required="">
                                </div>
                                <div class="col-lg-6">
                                    <button class="btn btn-primary" type="submit" name="hitung">HITUNG</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!--  end hitung -->
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