<!DOCTYPE html>
<html lang="en"><head>
    <title>OsCommerce</title>

    <link rel="search" type="application/opensearchdescription+xml" href="osd.xml" title="{if MerchantName}{MerchantName} {/if}Site Search"/>

<script>
document.cookie = "fred=fred;";
if(!/fred/i.test(document.cookie))
{
	window.location = "/cookies.php";
}
</script>

	<script src="mobile/js/jquery-1.6.2.min.js"></script>
	<script src="mobile/js/jquery.mobile-1.0b3.min.js"></script>
	<script type="text/javascript" src="mobile/js/ezi-mobile.js?3"></script>

	<link rel="stylesheet" href="mobile/css/jquery.mobile-1.0b3.min.css" />
	<link rel="stylesheet" type="text/css" href="mobile/css/style.css" />
	<link rel="stylesheet" type="text/css" href="mobile/css/cart.css" />
	<link rel="stylesheet" type="text/css" href="mobile/css/checkout.css" />

	<link rel="apple-touch-icon" href="../includes/templates/classic/images/logo.gif">
	<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1"> 
	<meta name="apple-mobile-web-app-capable" content="yes" />
		
</head>

<body class="{documentclass}" id="{documentid}">

<div id="mainpage" data-role="page" data-theme="b">

	<div data-role="header" data-theme="b" style="background:#fff; z-index: 1000;">
<a href="" data-role="none" data-inline="true"><img src="images/store_logo.png"
style="vertical-align: top; margin-top: -4px; margin-left: -2px; max-height: 45px; max-width: 200px;"/></a>
		<h1></h1>
		<a href="#" data-role="none"><img src="mobile/images/napaypal.png" style="width: 70px; margin-top: 2px;"/></a>
			
	    <div data-role="navbar">
	    	<ul>
	            <li><a id="home" href="<?php echo DIR_WS_CATALOG ?>">Home</a><span class="ui-icon ui-icon-custom"></span></li>
	            <li><a id="categories" rel="external">Categories</a><span class="ui-icon ui-icon-custom"></span></li>
	            <li><a id="search" href="search/" rel="external">Search</a><span class="ui-icon ui-icon-custom"></span></li>
	            <li><a id="cartlink" class="carticon" href="index.php?main_page=shopping_cart" rel="external" class="ui-icon ui-icon-custom">Cart <span class="MiniCartQty" style="text-align:center; font-size: 10px; font-weight: normal; width: 20px; height: 15px; z-index: 200; float: right; padding-left: 1px; padding-bottom: 3px; padding-top:2px;"><?php if(isset($_SESSION['cart'])) { echo $_SESSION['cart']->count_contents(); } else { echo 0; } ?></span></a></li>
	        </ul>
	    </div><!-- /navbar -->					
	</div><!-- /header -->	

	<div id="content" data-role="content">	
	
