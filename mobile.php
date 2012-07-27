<?php
	ini_set('display_errors', 'off');

	if(isset($_GET["main_page"]) && $_GET["main_page"] == "login")
	{
		unset($_SESSION['paypal_ec_token']);
		header("HTTP/1.1 303 See Other");
		header("Location: http://".$_SERVER[HTTP_HOST]."/ipn_main_handler.php?type=ec");
	}

	define('SKIP_SINGLE_PRODUCT_CATEGORIES', 'False');
	$catalog_path = "";
	$includes = array('includes/application_top.php', 'includes/database_tables.php', 'includes/modules/boxes/bm_categories.php');
	if(file_exists(reset($includes)))
	    foreach($includes as $file) require($file);
	
	global $bm_categories, $tree;
	$bm_categories = new bm_categories();
	$bm_categories->getData();
	global $products;
?>

<?php
function requestURI(){
   
  $requestURI = $_SERVER['REQUEST_URI']; 
  
  $catalogFolder = DIR_WS_CATALOG;
  $catalogFolder = preg_replace("/\\/$/", "", $catalogFolder);
  $subject = preg_replace("/".preg_quote($catalogFolder, "/")."/", "", $requestURI);
  return array(
      $requestURI,
      $catalogFolder,
      $subject
  );
}

function matchhome() {
	global $bm_categories, $tree, $currency;
	
	list($requestURI, $catalogFolder, $subject) = requestURI();
	$pattern = '/^\/(?:$|\?)/';
	preg_match($pattern, $subject, $matches);
	if ($matches) {
		return true;
	}
	return false;
}
if(matchhome()) {
  	$select_column_list = 'pd.products_name, p.products_image, ';
        $listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on p.manufacturers_id = m.manufacturers_id left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_status = '1' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$languages_id . "'";
        
        $categories_query = tep_db_query("select count(*) as total from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$category_links[$i] . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "'");
        $categories = tep_db_fetch_array($categories_query);
        
        
	global $listing_sql, $db, $listing_query, $categories;
	include 'mobile/index.php';
	die();
}

function matchcart() {
	global $bm_categories, $tree, $cart, $cartShowTotal, $currency;
	list($requestURI, $catalogFolder, $subject) = requestURI();
	$pattern = '/(index.php\?main_page=shopping_cart|shopping_cart.php)/';
	preg_match($pattern, $subject, $matches);
	if ($matches) {	
		include 'mobile/cart.php';
		die();	
	}
}
matchcart();

function matchcheckoutsuccess(){
	global $zv_orders_id, $orders_id, $orders, $define_page, $currency;
	list($requestURI, $catalogFolder, $subject) = requestURI();
	$pattern = '/checkout_success.php/';
	preg_match($pattern, $subject, $matches);
	if ($matches) {
		global $zv_orders_id, $orders_id, $orders, $customer_id, $order, $define_page, $language, $cart;
		require(DIR_WS_CLASSES . 'order.php');
		include 'mobile/checkoutsuccess.php';
		die();
	}
}
matchcheckoutsuccess();

function matchminicart() {
	global $cart, $cartShowTotal, $currency;
	list($requestURI, $catalogFolder, $subject) = requestURI();
	$pattern = '/minicart.php/';
	preg_match($pattern, $subject, $matches);
	if ($matches) {
		include 'mobile/minicart.php';
		die();
	}
}
matchminicart();

function matchcookies() {
	global $cart, $cartShowTotal, $currency;
	list($requestURI, $catalogFolder, $subject) = requestURI();
	$pattern = '/cookies.php/';
	preg_match($pattern, $subject, $matches);
	if ($matches) {
		include 'mobile/cookies.php';
		die();
	}
}
matchcookies();

function matchminicartview() {
	global $cart, $cartShowTotal, $currency;
	list($requestURI, $catalogFolder, $subject) = requestURI();
	$pattern = '/minicartview.php/';
	preg_match($pattern, $subject, $matches);
	if ($matches) {
		include 'mobile/minicartview.php';
		die();
	}
}
matchminicartview();

function matchcategory(){
	global $currency;

	list($requestURI, $catalogFolder, $subject) = requestURI();
	$pattern = '/category/';
	preg_match($pattern, $subject, $matches);
	if ($matches) {
		return true;
	}
	
	return false;
}
if(matchcategory())
{
  	$select_column_list = 'pd.products_name, p.products_image, ';
    $listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on p.manufacturers_id = m.manufacturers_id left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_status = '1' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$languages_id . "' and p2c.categories_id = '" . (int)$current_category_id . "'";
    $categories_query = tep_db_query("select count(*) as total from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$category_links[$i] . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "'");
    $categories = tep_db_fetch_array($categories_query);
	global $listing_sql, $db, $listing_query, $categories;
	include 'mobile/category.php';
	die();
}

function matchproduct() {
	global $sql, $currency;
	list($requestURI, $catalogFolder, $subject) = requestURI();
	$pattern = '/^\/prod\d+\.htm(?:$|\?)/';
	preg_match($pattern, $subject, $matches);
	if ($matches) {
		return true;
	}
	
	return false;
}
if(matchproduct()) {
	include 'mobile/product.php';
	die();
}

function matchgallery() {
	global $currency;

	list($requestURI, $catalogFolder, $subject) = requestURI();
	$pattern = '/gallery/';
	preg_match($pattern, $subject, $matches);
	if ($matches) {
		return true;
	}
	
	return false;
}

if(matchgallery()) {
	$select_column_list = 'pd.products_name, p.products_image, ';
	//require('includes/index_filters/default_filter.php');
	include 'mobile/gallery.php';
	die();
}

function matchsearch() {
	global $currency;

	list($requestURI, $catalogFolder, $subject) = requestURI();
	$pattern = '/(^\/search\/?(?:$|\?)|^\/advanced_search_result.php)/';
	preg_match($pattern, $subject, $matches);
	if ($matches) {
    $select_column_list = 'pd.products_name, p.products_image, ';
	$listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on p.manufacturers_id = m.manufacturers_id left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_status = '1' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . 1 . "' and pd.products_name like '%" . $_GET['keywords'] ."%'";
	include 'mobile/search.php';
		die();
	}
}
matchsearch();
?>
