<div style="padding: 10px;"><?php 
	
	if(isset($_SESSION['cart'])) { 
		$arr = array(
			"{count}" => $_SESSION['cart']->count_contents(),
			"{total}" => $currencies->format($_SESSION['cart']->show_total())
		);
	 } else {
		$arr = array(
			"{count}" => 0,
			"{total}" => 0
		);
	 }
	 echo str_replace(array_keys($arr),array_values($arr), $_['You have x items in your cart the total is y']); 
?></div>
