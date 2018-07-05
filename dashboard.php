<?php
error_reporting(0);
$thisMonth = date('Y-m');
$lastDay = date('t', strtotime($thisMonth));
//echo $lastDay; exit();

$arrDay1 =
$arrDayTot1 =
$arrTime1 =
$arrTimeTot1 =
array();

for ($i = 1; $i <= 24; $i++) {
    $arrTime1[$i] = "0";
    $arrTimeTot1[$i] = "0";

}


/******** GRAFI/k HARIAN START ************************************************************************************************************************/

//$sql=mysqli_query(
$asu = "SELECT COUNT(*) AS TOTAL, CEIL(DATE_FORMAT(tgl_order,'%H.%i')) DATE,SUM(product_price) AS TOTAL_PRICE FROM
`orders`
INNER JOIN `orders_detail` 
ON (`orders`.`id_orders` = `orders_detail`.`id_orders`)
INNER JOIN `product` 
        ON (`product`.`product_id` = `orders_detail`.`product_id`) WHERE DATE(orders.tgl_order)=CURDATE() GROUP BY DATE ORDER BY tgl_order ASC";//);
//  echo $asu; exit();

        $transOrderDay = mysqli_fetch_array($sql);

        if (!empty($transOrderDay)) {
            foreach ($transOrderDay as $val) {

        $arrTime1[$val['DATE']] = $val['TOTAL_PRICE'];//."<br>";

        $arrTimeTot1[$val['DATE']] = $val['TOTAL'];
    }
}

$transDayStat = "";


for ($i = 1; $i <= 24; $i++) {
    $transDayStat .= "{period: '" . $i . ".00', Rp: " . $arrTime1[$i] . ", Transaksi:'" . $arrTimeTot1[$i] . "'}";

    if ($i < 24) $transDayStat .= ",";

}



for ($i = 1; $i <= $lastDay; $i++) {

    $day = substr("0" . $i, -2);

    $arrDay1[date('Y-m-') . $day] = "0";

    $arrDayTot1[date('Y-m-') . $day] = "0";

}

$startDate = date('Y-m-01');
$endDate = date('Y-m-') . substr("0" . $lastDay, -2);


$sqlDay = mysqli_query($mysqli,"SELECT COUNT(*) AS TOTAL, DATE(tgl_order) AS DATE,SUM(product_price) AS TOTAL_PRICE FROM `kasir`.`orders`
    INNER JOIN `kasir`.`orders_detail` 
    ON (`orders`.`id_orders` = `orders_detail`.`id_orders`)
    INNER JOIN `kasir`.`product` 
    ON (`product`.`product_id` = `orders_detail`.`product_id`) 
    WHERE DATE(tgl_order) >= '" . $startDate . "' AND DATE(tgl_order) <='" . $endDate . "'
    GROUP BY DATE ");

//echo $sql; exit();


$transMonth = mysqli_fetch_array($sqlDay);

for ($i = 0; $i < count($transMonth); $i++) {
    if (isset($transMonth[$i])) {
        $arrDay1[$transMonth[$i]['DATE']] = $transMonth[$i]['TOTAL_PRICE'];
        $arrDayTot1[$transMonth[$i]['DATE']] = $transMonth[$i]['TOTAL'];
    }
}


$transMonthStat = "";


for ($i = 1; $i <= $lastDay; $i++) {
    $day = substr("0" . $i, -2);

    $transMonthStat .= "{period: '" . date('Y-m-') . $day . "', Rp: " . $arrDay1[date('Y-m-') . $day] . ", Transaksi:'" . $arrDayTot1[date('Y-m-') . $day] . "'}";

    if ($i < $lastDay) $transMonthStat .= ",";

}




?>


<div class="wrapper">
    <div class="row states-info">


         <?php if($_SESSION['level'] =='Admin'){ ?>
      

        <a href="?hal=pos" style="color: #fff;">
            <div class="col-md-3">
                <div class="panel red-bg">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-money"></i>
                            </div>
                            <div class="col-xs-8">
                                <span class="state-title"> Point of Sale</span>
                                <h4>POS</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        <a href="?hal=master/category/list" style="color: #fff;">
            <div class="col-md-3">
                <div class="panel blue-bg">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-tag"></i>
                            </div>
                            <div class="col-xs-8">
                                <span class="state-title"> Kategori Product </span>
                                <h4>Kategori</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        <a href="?hal=master/product/list" style="color: #fff;">
            <div class="col-md-3">
                <div class="panel green-bg">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-briefcase"></i>
                            </div>
                            <div class="col-xs-8">
                                <span class="state-title">Data  Product  </span>
                                <h4>Product</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        <a href="?hal=master/user/list" style="color: #fff;">
            <div class="col-md-3">
                <div class="panel yellow-bg">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-users"></i>
                            </div>
                            <div class="col-xs-8">
                                <span class="state-title">Data User  </span>
                                <h4>User</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      
    </a>

        <?php
       }elseif($_SESSION['level'] == 'Kasir'){
        ?>

        <a href="?hal=pos" style="color: #fff;">
            <div class="col-md-3">
                <div class="panel red-bg">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-money"></i>
                            </div>
                            <div class="col-xs-8">
                                <span class="state-title"> Point of Sale</span>
                                <h4>POS</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <?php
        }
        ?>
        </div>


    