<?php
require_once('config.php');

if($_REQUEST['action'] == 'updateCartItem' && !empty($_REQUEST['id'])){

   $queryInsert  = mysqli_query($mysqli,"UPDATE orders_temp SET 
												  jumlah ='".$_REQUEST['qty']."' WHERE id_orders_temp='".$_REQUEST['id']."'
												  "); 
 
 if($queryInsert){
 	echo "ok";
 }else{
 	echo "err";
 }
}


?>