<?php include 'header.php'; ?>

<h1 id="checkoutSuccessHeading">Thank You! We Appreciate your Business!</h1>

<p style="background:#fff; border:1px solid #ccc; padding:10px; text-align:center; font-weight:bold;">Your order number is <?php echo $orders_id; ?></p>

<?php
/**
 * require the html_defined text for checkout success
 */
  require($define_page);
?>