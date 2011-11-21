<!DOCTYPE html>
<html>
<head>
<title><?php echo $listing->fields['products_name']; ?> Gallery</title>
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

<div data-role="page" data-theme="b" data-fullscreen="true">

	<div data-role="header" data-position="fixed" data-theme="b" style="text-align: right;">
		<a href="#" data-rel="back" data-role="button" data-icon="back" data-inline="true">Done</a>		
		<h1></h1>
	</div><!-- /header -->

	<div id="gallery" data-role="content" style="min-height: 600px; background-color: #000; background-image: none;">
	<div style="height:350px;">
		<div style="position: relative;">
			<img style="display: none; z-index: 1; position: absolute;" id="loading" src="/images/ajax-loader.gif" />
			<img id="hero" src="/productimage_{ID}.jpg?width=470" width="100%" style="max-height:350px; max-width:370px; display:block; margin-left:auto; margin-right:auto;" />
		</div>
	</div>
	</div>

	<div data-role="footer" data-position="fixed" data-theme="a">
	<ul class="gallery-icon-list" style="overflow: auto; clear: both;">
		<li><a rel="external" href="/productimage_{ID}.jpg?width=470"><img src="/productimage_{ID}.jpg?width=64&height=64" /></a></li>
		{for gallery}
			<li><a rel="external" href="{src}?width=470"><img src="{src}?width=64&height=64" /></a></li>
		{/for}
	</ul>
	</div>
	

<div style="display: none;">
<img id="galleryimg0" src="{src}?width=470"/>
{for gallery}
<img id="galleryimg{position}" src="{src}?width=470"/>
{/for}
</div>

</div>

<?php include 'footer.php'; ?>
