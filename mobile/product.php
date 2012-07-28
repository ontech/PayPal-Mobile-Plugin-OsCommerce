<?php include 'header.php'; ?>

<?php
    $product_info_query = tep_db_query("select p.products_id, pd.products_name, pd.products_description, p.products_model, p.products_quantity, p.products_image, pd.products_url, p.products_price, p.products_tax_class_id, p.products_date_added, p.products_date_available, p.manufacturers_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");
    $product_info = tep_db_fetch_array($product_info_query);
?>

<div>
	<?php
		$theproductname = $product_info['products_name']; 
		for ($i=1;$i<((sizeof($breadcrumb->_trail))-1);$i++) { ?>
	<?php 
		$str = end(explode('_', $breadcrumb->_trail[$i]['link']));	
		$catid = preg_replace('[\D]', '', $str);
		$trailname = $breadcrumb->_trail[$i]['title'];
		$cpath = array();
		preg_match("/cPath=[^&]*/", $breadcrumb->_trail[$i]['link'], $cpath);
	?>
		<a href="
		<?php 
		if($i==0) {
			echo DIR_WS_CATALOG.'">';
		} else if($trailname == $theproductname) {
			echo '#">';
		} else {
			echo 'category' . $catid . '_1.htm?'.$cpath[0].'">';
		};
		echo htmlspecialchars($breadcrumb->_trail[$i]['title']); ?></a> &raquo;
	<?php } ?>
</div>

<form method="post" class="productform">
	<input type="hidden" name="products_id" value="<?php echo $product_info['products_id']; ?>" />
	
	<div style="border-radius:10px; border:1px solid #999; background:#fff; margin-top:4px; padding:5px;">
    <table style="margin-top:10px;">
	<tr>
	<td style="vertical-align: top;">
		<div style="position: relative; width: 126px; height: 126px;">
			<div style="z-index: 1; background-color: #fff; position: absolute; top: 0px; left: -3px; width: 124px; height: 125px; box-shadow: 1px 1px #777; border: 1px solid #ddd; -webkit-transform: rotate(-2deg);"></div>
			<div style="z-index: 2; background-color: #fff; position: absolute; top: -1px; left: -2px; width: 124px; height: 125px; box-shadow: 1px 1px #888; border: 1px solid #ddd; -webkit-transform: rotate(1deg);"></div>
			<div style="z-index: 3; background-color: #fff; position: absolute; top: 0px; left: -2px; width: 124px; height: 125px; box-shadow: 1px 1px #666; border: 1px solid #ddd; -webkit-transform: rotate(1.5deg);"></div>

			<a href="gallery<?php echo $product_info['products_id']; ?>.htm?products_id=<?php echo $product_info['products_id']; ?>" style="position: absolute; top: 0px; left: 0px; display: block; z-index: 4;"><img class="photo" style="margin-top:3px; margin-left:auto; margin-right:auto;" src="images/<?php echo htmlspecialchars($product_info['products_image']); ?>" width="100"/></a>
		</div>
	</td>
	<td  align="left" valign="top">
			<a href="#" class="url" style="font-size:18px"><?php echo htmlspecialchars($product_info['products_name']); ?></a>

		<table align="center" style="margin-left:auto; margin-right:auto; margin-top:20px;"><tr><td style="border:none; vertical-align:middle; text-align:center;">
		<span style="font-size:15px;">
					<?php $new_price = tep_get_products_special_price($product_info['products_id']) ?>
		
					<?php if($new_price) { ?>
					<del class="listprice">
							<?php echo $currencies->display_price($product_info['products_price'], tep_get_tax_rate($product_info['products_tax_class_id'])); ?>
					</del>					
					<br />
					<span class="price productSpecialPrice">
						<?php echo $currencies->display_price($new_price, tep_get_tax_rate($product_info['products_tax_class_id'])); ?>
					</span>
					<?php } else { ?>
					<span class="price">
						<?php echo $currencies->display_price($product_info['products_price'], tep_get_tax_rate($product_info['products_tax_class_id'])); ?>
					</span>					
					<?php } ?>

        </span>
        <br />
		<input type="submit" data-theme="e" id="addtocart" value="Add to Cart" />
		</td></tr></table>
		
	</td>
	</tr>
	</table>

	
<?php
    $products_attributes_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . (int)$HTTP_GET_VARS['products_id'] . "' and patrib.options_id = popt.products_options_id and popt.language_id = '" . (int)$languages_id . "'");
    $products_attributes = tep_db_fetch_array($products_attributes_query);
    if ($products_attributes['total'] > 0) {
?>

    <p>Product Options</p>

    <p>
<?php
      $products_options_name_query = tep_db_query("select distinct popt.products_options_id, popt.products_options_name from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . (int)$HTTP_GET_VARS['products_id'] . "' and patrib.options_id = popt.products_options_id and popt.language_id = '" . (int)$languages_id . "' order by popt.products_options_name");
      while ($products_options_name = tep_db_fetch_array($products_options_name_query)) {
        $products_options_array = array();
        $products_options_query = tep_db_query("select pov.products_options_values_id, pov.products_options_values_name, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov where pa.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and pa.options_id = '" . (int)$products_options_name['products_options_id'] . "' and pa.options_values_id = pov.products_options_values_id and pov.language_id = '" . (int)$languages_id . "'");
        while ($products_options = tep_db_fetch_array($products_options_query)) {
          $products_options_array[] = array('id' => $products_options['products_options_values_id'], 'text' => $products_options['products_options_values_name']);
          if ($products_options['options_values_price'] != '0') {
            $products_options_array[sizeof($products_options_array)-1]['text'] .= ' (' . $products_options['price_prefix'] . $currencies->display_price($products_options['options_values_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) .') ';
          }
        }

        if (is_string($HTTP_GET_VARS['products_id']) && isset($cart->contents[$HTTP_GET_VARS['products_id']]['attributes'][$products_options_name['products_options_id']])) {
          $selected_attribute = $cart->contents[$HTTP_GET_VARS['products_id']]['attributes'][$products_options_name['products_options_id']];
        } else {
          $selected_attribute = false;
        }
?>
      <strong><?php echo htmlspecialchars($products_options_name['products_options_name']) . ':'; ?></strong><br /><?php echo tep_draw_pull_down_menu('id[' . $products_options_name['products_options_id'] . ']', $products_options_array, $selected_attribute); ?><br />
<?php
      }
?>
    </p>
<?php
    }
?>
	
	
		<div style="padding: 0.5em; padding-top: 0.8em;">
		<?php 
		$description = $product_info['products_description'];
		if ($description) {
			echo $description;
		} else {
			echo 'There is no description for this product'; 
		};	
		?>
		</div>
</form>

<?php include 'footer.php'; ?>

