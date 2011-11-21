<div style="padding: 10px;">
	You have <span class="itemcount"><?php echo $_SESSION['cart']->count_contents(); ?></span> items in your cart<br/>the total is <span class="total">$<?php echo number_format($_SESSION['cart']->show_total(), 2);?> </span>
</div>
