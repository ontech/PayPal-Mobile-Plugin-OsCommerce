<!DOCTYPE html>
<html>
<head>
<title><?php echo $listing->fields['products_name']; ?><?php echo $_['Gallery']; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<script src="mobile/js/jquery-1.6.2.min.js"></script>
	<script src="mobile/js/jquery.mobile-1.0b3.min.js"></script>


	<link rel="stylesheet" href="mobile/css/jquery.mobile-1.0b3.min.css" />
	<link rel="stylesheet" type="text/css" href="mobile/css/style.css" />
	<link rel="stylesheet" type="text/css" href="mobile/css/cart.css" />
	<link rel="stylesheet" type="text/css" href="mobile/css/checkout.css" />

	<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1"> 
	<meta name="apple-mobile-web-app-capable" content="yes" />
	
</head>
<body>

<?php
    $product_info_query = tep_db_query("select p.products_id, pd.products_name, pd.products_description, p.products_model, p.products_quantity, p.products_image, pd.products_url, p.products_price, p.products_tax_class_id, p.products_date_added, p.products_date_available, p.manufacturers_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");
    $product_info = tep_db_fetch_array($product_info_query);
?>

<div data-role="page" data-theme="b" data-fullscreen="true">

	<div data-role="header" data-position="fixed" data-theme="b" style="text-align: right;">
		<a href="#" data-rel="back" data-role="button" data-icon="back" data-inline="true"><?php echo $_['Done']; ?></a>		
		<h1></h1>
	</div><!-- /header -->

	<div id="gallery" data-role="content" style="min-height: 600px; background-color: #000; background-image: none;">
	<div style="height:350px;">
		<div style="position: relative;">
			<img style="display: none; z-index: 1; position: absolute;" id="loading" src="images/ajax-loader.gif" />
			<img id="hero" src="images/<?php echo htmlspecialchars($product_info['products_image']); ?>" width="100%" style="max-height:350px; max-width:370px; display:block; margin-left:auto; margin-right:auto;" />
		</div>
	</div>
	</div>

</div>

<?php include 'footer.php'; ?>
