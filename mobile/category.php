<?php include 'header.php'; ?>

<h2>
	<?php   for ($i=1;$i<sizeof($breadcrumb->_trail);$i++) { ?>
	<?php 
	$str = end(explode('_', $breadcrumb->_trail[$i]['link']));	
	$catid = preg_replace('[\D]', '', $str);
	?>
	<a href="
		<?php 
		if($i<=1) {
			echo '/">';
		} else {
			echo '/category' . $catid . '_1.htm?cPath='. $catid . '">';
		};
		echo $breadcrumb->_trail[$i]['title']; ?></a> >
	<?php } ?>
</h2>

<ul data-role="listview" data-inset="true" class="ui-listview ui-listview-inset ui-corner-all ui-shadow">
	<?php
			if (isset($cPath) && strpos('_', $cPath)) {
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
				<li class="ui-li ui-li-static ui-body-c"><a href="category<?php echo $categories['categories_id'] ?>_1.htm?cPath=<?php echo $current_category_id ?>_<?php echo $categories['categories_id'] ?>"><?php echo $categories['categories_name']; ?></a></li>
		
			<?php
			} 
			?>
</ul>


<?php
$listing_split = new splitPageResults($listing_sql, MAX_DISPLAY_SEARCH_RESULTS, 'p.products_id', 'page');
$listing_query = tep_db_query($listing_split->sql_query);
?>
<ul data-role="listview" data-inset="true" id="products" class="products" style="margin-top: 8px;">
	<li data-role="list-divider">Products</li>

	<?php
    while ($listing = tep_db_fetch_array($listing_query)) {
	$rows++;
	?>
		
	<li style="text-align:center; padding:5px;">
	
<div class="hproduct brief" style="text-align:center;">

<table width="100%">
<tr>
	<td colspan="2" align="left">
		<a href="/prod<?php echo $listing['products_id']; ?>.htm?products_id=<?php echo $listing['products_id']; ?>"><?php echo $listing['products_name']; ?></a>
	</td>
</tr>
<tr>
<td width="0" style="vertical-align: top;">
	<a href="/prod<?php echo $listing['products_id']; ?>.htm?products_id=<?php echo $listing['products_id']; ?>"><img class="photo" style="margin-top:3px; margin-left:auto; margin-right:auto;" src="/images/<?php echo $listing['products_image']; ?>" width="100"/></a>
</td>
<td align="left">
		<form method="post" action="/cart/index.php?action=add_product" class="productform">
			<input type="hidden" name="products_id" value="<?php echo $listing['products_id']; ?>"/>
			<input type="hidden" name="cart_quantity" value="1" maxlength="6" size="4">

			<table align="center" style="margin-left:auto; margin-right:auto;" width="100"><tr><td style="border:none; vertical-align:middle">					
					<span class="listprice">
						<?php
						if(specials_new_products_price)
							echo $listing['was $' . number_format(specials_new_products_price , 2)]; ?>
					</span>
					<br />
					<span class="price">
						<?php if(!specials_new_products_price) echo 'now'; ?> $<?php echo number_format($listing['final_price'] , 2); ?>
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
	}
?>

</ul>

<?php include 'footer.php'; ?>

