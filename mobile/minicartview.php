<ul data-role="listview" data-inset="true" class="products ui-listview ui-listview-inset ui-corner-all ui-shadow" style="margin: 4px; width: auto;">

<?php 
$products = $_SESSION['cart']->get_products();
?>


<?php 
if (($_SESSION['cart']->count_contents()) == 0) {
?>
<li data-role="list-divider" role="heading" class="ui-li ui-li-divider ui-btn ui-bar-b ui-corner-top ui-btn-up-undefined ui-corner-bottom">Your cart is empty</li>
<?php
} else {
?>

<li data-role="list-divider" role="heading" class="ui-li ui-li-divider ui-btn ui-bar-b ui-btn-up-undefined ui-corner-top">Shopping Cart
<div style="float: right;"><a href="index.php?main_page=shopping_cart" class="buy" rel="external" style="color: #fff;"> Edit...</a></div>
</li>

<li style="text-align:center; padding:5px;" class="ui-li ui-li-static ui-body-c">
	<table>
		<tr>
			<th><div style="width:30px;">Qty</div></th>
			<th><div style="width:180px; padding-top:5px; white-space:nowrap; overflow:hidden;">Product</div></th>
			<th><div style="width:60px;"> </div></th>
		</tr>
	</table>
</li>

<?php
for ($i=0;$i<sizeof($products);$i++) {
?>
	<li style="text-align:center; padding:5px;" class="ui-li ui-li-static ui-body-c">
		<div class="ui-btn-text">
		<table>	
			<tr>
				<td><div style="width:30px;"><?php echo $products[$i]['quantity'];?></div></td>
				<td align="left"><div style="width:180px; padding-top:5px; height:20px; white-space:nowrap; overflow: hidden; text-overflow:ellipsis;"><?php echo htmlspecialchars($products[$i]['name']); ?></div></td>
				<td align="left"><div style="width:60px;"> <?php echo $currencies->display_price($products[$i]['final_price'], $products[$i]['tax_class_id'], $products[$i]['quantity']); ?></div></td>
			</tr>
		</table>
		</div>
	</li>	
<?php
}
?>

<li style="text-align:center; padding:5px;" class="ui-li ui-li-static ui-body-c">
<table>
<tfoot>
    <tr>
        <td><div style="width: 214px; padding-top: 5px; text-align: left;">Total (<?php echo $currency; ?>)</div></td>
        <td align="left">
            <div style="width:60px;"> <?php echo $currencies->format($_SESSION['cart']->show_total());?></div>
        </td>
    </tr>
</tfoot>
</table>
</li>

<li class="ui-li ui-li-static ui-body-c" style="text-align: center; padding: 0; padding-top: 5px; padding-bottom: 5px;">
	<div class="ui-footer-fixed">

	<a rel="external" href="ext/modules/payment/paypal/express.php">
		    <input type="image" width="260" src="mobile/images/btn_checkout_278x43.png"/>
    </a>
	</div>
</li>
<?php 
}
?>

</ul>
