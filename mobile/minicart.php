<div style="padding: 10px;">
	<?php if(isset($_SESSION['cart'])) { ?>
	You have <span class="itemcount"><?php echo $_SESSION['cart']->count_contents(); ?></span> items in your cart<br/>the total is <span class="total"> <?php echo $currencies->format($_SESSION['cart']->show_total());?> </span>
	<?php } else { ?>
	You have <span class="itemcount">0</span> items in your cart<br/>the total is <span class="total">$<?php echo $currencies->format(0); ?></span>		
	<?php } ?>
</div>