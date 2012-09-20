<?php include 'header.php'; ?>

<h1 id="checkoutSuccessHeading"><?php echo $_['Thank You! We Appreciate your Business!']; ?></h1>

<?php 
		require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_SUCCESS);
		$global_query = tep_db_query("select global_product_notifications from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = '" . (int)$customer_id . "'");
		$global = tep_db_fetch_array($global_query);
		$orders_query = tep_db_query("select orders_id from " . 'orders'. " where customers_id = '" . (int)$customer_id . "' order by date_purchased desc limit 1");
		$orders = tep_db_fetch_array($orders_query);
		$order = new order;
		if (!tep_session_is_registered('customer_id')) {
			tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
		}
?>

<div style="background:#fff; border:1px solid #ccc; padding:10px; text-align:center; font-weight:bold;">

<p><?php echo str_replace('{order}', $orders_id, $_['Your order number is x']); ?></p>

<p><?php echo $_['Your customer id:']; ?> </p>

</div>

<?php
  if ($global['global_product_notifications'] != '1') {
    echo TEXT_NOTIFY_PRODUCTS . '<br /><p class="productsNotifications">';

    $products_displayed = array();
    for ($i=0, $n=sizeof($products_array); $i<$n; $i++) {
      if (!in_array($products_array[$i]['id'], $products_displayed)) {
        echo tep_draw_checkbox_field('notify[]', $products_array[$i]['id']) . ' ' . $products_array[$i]['text'] . '<br />';
        $products_displayed[] = $products_array[$i]['id'];
      }
    }

    echo '</p>';
  }

  echo TEXT_SEE_ORDERS . '<br /><br />' . TEXT_CONTACT_STORE_OWNER;
?>


<?php
/**
 * require the html_defined text for checkout success
 */
  //require($define_page);
?>