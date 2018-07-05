  <?php


  $list_price = 150000;
  $discount_percent = 25;
  $discount_amount = $list_price * $discount_percent * .01;

  $discount_price = $list_price - $discount_amount ;


 function formatDigits($digit) {
   echo number_format($digit,0,",",".");
  }


  ?>

  <ul>
  <li>Harga Normal: <del><?php formatDigits($list_price); ?></del></li>
  <li>Diskon: <?php echo $discount_percent . ' %'; ?></li>
  <li>Anda Hemat: <?php formatDigits($discount_amount); ?></li>
  <li>Harga Jual: <ins><?php formatDigits($discount_price); ?></ins></li>
</ul>