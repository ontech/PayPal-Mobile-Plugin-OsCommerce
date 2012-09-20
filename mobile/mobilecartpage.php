<div id="cartpanel" style="position: absolute; width: 100%; display: none; overflow: visible; min-height: 600px; z-index: 500; margin-top: 75px; background-image: -webkit-gradient(linear, left top, left bottom, from(rgba(204, 204, 204, 1.0)), to(rgba(204, 204, 204, 0.50))); background-color: transparent;" class="ui-page ui-body-b">

	<div data-role="content" class="ui-content">	
		
	</div><!-- /content -->

</div><!-- /page -->

<div id="addtocartmsg" style="display: none; position: absolute; top: 120px; left: 10px; height: 220px; width: 90%; text-align: center;" class="ui-selectmenu ui-overlay-shadow ui-corner-all ui-body-a">
	
	<span class="minicartdetails">
	</span>

	<div id="PayPalExpressCheckout">
	<a rel="external" href="<?php echo IPN_HANDLER ?>?type=ec">
				<img id="paypalbutton" src="<?php echo $_SESSION['PaypalLanguages']['checkoutWithPaypal'] ?>" />
				<img style="display:none;" src="<?php echo $_SESSION['PaypalLanguages']['checkoutWithPaypalDown'] ?>" />
    </a>
    </div>
	
	<?php echo $_['OR']; ?>

	<div style="padding: 10px;">	
	<a href="index.php?main_page=shopping_cart" rel="external" style="color: #fff; font-size: 110%;"><?php echo $_['Edit Cart']; ?></a>
	</div>

	<?php echo $_['OR']; ?>

	<div style="padding: 10px;">	
	<a href="#" style="color: #fff; font-size: 110%;"><?php echo $_['Continue Shopping'] ?></a>
	</div>
	
</div>