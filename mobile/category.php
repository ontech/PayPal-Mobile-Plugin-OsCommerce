<?php include 'header.php'; ?>

<div>
	<?php   for ($i=1;$i<sizeof($breadcrumb->_trail);$i++) { ?>

        <?php
                $str = end(explode('_', $breadcrumb->_trail[$i]['link']));
                $catid = preg_replace('[\D]', '', $str);
                $trailname = $breadcrumb->_trail[$i]['title'];
                $cpath = array();
                preg_match("/cPath=[^&]*/", $breadcrumb->_trail[$i]['link'], $cpath);
        ?>
            <a href="<?php
            if($i<=1) {
                    echo DIR_WS_CATALOG;
            } else if($trailname == $theproductname) {
                    echo '#';
            } else {
                    echo 'category' . $catid . '_1.htm?'.$cpath[0];
            };?>"><?php echo $breadcrumb->_trail[$i]['title'];?></a> &raquo;
    <?php } ?>
</div>

<ul data-role="listview" data-inset="true" style="margin-top:15px;">
	<?php
			if (isset($cPath) && strpos( $cPath, '_')) {
		// check to see if there are deeper categories within the current category
			  $category_links = array_reverse($cPath_array);
			  for($i=0, $n=sizeof($category_links); $i<$n; $i++) {
				$categories_query = tep_db_query("select count(*) as total from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$category_links[$i] . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "'");
				$categories = tep_db_fetch_array($categories_query);
				if ($categories['total'] < 1) {
				  // do nothing, go through the loop
				} else {
				  $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$category_links[$i] . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' order by sort_order, cd.categories_name");
				  break; // we've found the deepest category the customer is in
				}
			  }
			} else {
			  $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$current_category_id . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' order by sort_order, cd.categories_name");
			}

			$number_of_categories = tep_db_num_rows($categories_query);

			$rows = 0;
			
			while ($categories = tep_db_fetch_array($categories_query)) {
			  $rows++;
			  $cPath_new = tep_get_path($categories['categories_id']);
		?>
				<li><a href="category<?php echo $categories['categories_id'] ?>_1.htm?cPath=<?php echo $current_category_id ?>_<?php echo $categories['categories_id'] ?>"><?php echo $categories['categories_name']; ?></a></li>
		
			<?php
			} 
			?>
</ul>


<?php
$listing_split = new splitPageResults($listing_sql, MAX_DISPLAY_SEARCH_RESULTS, 'p.products_id', 'page');
$listing_query = tep_db_query($listing_split->sql_query);
$listings = 0;
?>
<ul data-role="listview" data-inset="true" id="products" class="products" style="margin-top: 8px;">
	<?php $listing = tep_db_fetch_array($listing_query); ?>

	<?php if($listing) { $listings = 1; ?>
	<li data-role="list-divider">Products</li>
	<?php } ?>

	<?php
	
    while ($listing) {
	$rows++;
	?>
		
	<li style="text-align:center; padding:5px;">
	
<div class="hproduct brief" style="text-align:center;">

<table width="100%">
<tr>
	<td colspan="2" align="left">
		<a href="prod<?php echo $listing['products_id']; ?>.htm?products_id=<?php echo $listing['products_id']; ?>"><?php echo $listing['products_name']; ?></a>
	</td>
</tr>
<tr>
<td width="0" style="vertical-align: top;">
	<a href="prod<?php echo $listing['products_id']; ?>.htm?products_id=<?php echo $listing['products_id']; ?>"><img class="photo" style="margin-top:3px; margin-left:auto; margin-right:auto;" src="images/<?php echo $listing['products_image']; ?>" width="100"/></a>
</td>
<td align="left">
		<form method="post" action="cart/index.php?action=add_product" class="productform">
			<input type="hidden" name="products_id" value="<?php echo $listing['products_id']; ?>"/>
			<input type="hidden" name="cart_quantity" value="1" maxlength="6" size="4">

			<table align="center" style="margin-left:auto; margin-right:auto;" width="100"><tr><td style="border:none; vertical-align:middle">					
					<?php if($listing['products_price'] != $listing['final_price']) { ?>
					<del class="listprice">
							<?php echo $currencies->display_price($listing['products_price'], tep_get_tax_rate($listing['products_tax_class_id'])); ?>
					</del>					
					<br />
					<?php } ?>
					<span class="price <?php if($listing['products_price'] != $listing['final_price']) { ?>productSpecialPrice<?php } ?>">
						<?php echo $currencies->display_price($listing['final_price'], tep_get_tax_rate($listing['products_tax_class_id'])); ?>
					</span>
				
			</td></tr><tr><td style="border:none; vertical-align:middle;">
			<?php if (!(tep_has_product_attributes($listing['products_id']))) {?>
			<input type="submit" class="buy" data-theme="e" value="Add to Cart" /><br/>
			<?php } ?>	
			<a href="prod<?php echo $listing['products_id']; ?>.htm?products_id=<?php echo $listing['products_id']; ?>" class="ui-link" style="color: #2489CE !important; text-shadow: none;">More info...</a>
			</td></tr></table>
		</form>
</td>
</tr>
</table>		
</div>
	
	</li>
	
	<?php
		$listing = tep_db_fetch_array($listing_query);
	}
?>

</ul>

<?php
if($number_of_categories == 0 && $listings == 0)
{
	echo "No Products in this category";
}
?>

<?php include 'footer.php'; ?>

