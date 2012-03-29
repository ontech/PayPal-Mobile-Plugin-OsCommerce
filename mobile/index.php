<?php include 'header.php'; ?>

<?php
$listing_split = new splitPageResults($listing_sql, MAX_DISPLAY_SEARCH_RESULTS, 'p.products_id', 'page');
$listing_query = tep_db_query($listing_split->sql_query);
?>
<ul data-role="listview" data-inset="true" id="products" class="products" style="margin-top: 8px;">
	<li data-role="list-divider">Featured Products</li>

	<?php
    while ($listing = tep_db_fetch_array($listing_query)) {
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
		<!--div class="unavailable">{include field="UnavailableMessageHTML"}</div-->
		<!--{if BuyButtonID}-->	
		<form method="post" action="cart/index.php?action=add_product" class="productform">
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
		<!--{/if}-->
</td>
</tr>
</table>		
</div>
	
	</li>
	
	<?php
	}
?>

</ul>


<?php
	//print_r($listing);
	//echo "<br /><br />";
	//print_r($subcategories);
	//print_r($breadcrumb->_trail);
?>

<?php include 'footer.php'; ?>

