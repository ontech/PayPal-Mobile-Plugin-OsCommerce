<div style="padding: 10px;">
	<?php if(isset($_SESSION['cart'])) { ?>
	You have <span class="itemcount"><?php echo $_SESSION['cart']->count_contents(); ?></span> items in your cart<br/>the total is <span class="total">$<?php echo number_format($_SESSION['cart']->show_total(), 2);?> </span>
	<?php } else { ?>
	You have <span class="itemcount">0</span> items in your cart<br/>the total is <span class="total">$<?php echo number_format(0, 2); ?></span>		
	<?php } ?>
</div>