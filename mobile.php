<?php
	require('includes/application_top.php');
	require('includes/modules/boxes/bm_categories.php');
	global $bm_categories, $tree;
	$bm_categories = new bm_categories();
	$bm_categories->getData();
	global $products;
?>

<?php
function matchhome() {
	global $bm_categories, $tree;
	$subject = $_SERVER['REQUEST_URI'];
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
	global $bm_categories, $tree, $cart, $cartShowTotal;
	$subject = $_SERVER['REQUEST_URI'];
	$pattern = '/(index.php\?main_page=shopping_cart|shopping_cart.php)/';
	preg_match($pattern, $subject, $matches);
	if ($matches) {	
		include 'mobile/cart.php';
		die();	
	}
}
matchcart();

function matchcheckoutsuccess(){
	global $zv_orders_id, $orders_id, $orders, $define_page;
	$subject = $_SERVER['REQUEST_URI'];
	$pattern = '/index.php\?main_page=checkout_success/';
	preg_match($pattern, $subject, $matches);
	if ($matches) {
		include 'mobile/checkoutsuccess.php';
		die();
	}
}
matchcheckoutsuccess();

function matchminicart() {
	global $cart, $cartShowTotal;
	$subject = $_SERVER['REQUEST_URI'];
	$pattern = '/minicart.php/';
	preg_match($pattern, $subject, $matches);
	if ($matches) {
		include 'mobile/minicart.php';
		die();
	}
}
matchminicart();

function matchminicartview() {
	global $cart, $cartShowTotal;
	$subject = $_SERVER['REQUEST_URI'];
	$pattern = '/minicartview.php/';
	preg_match($pattern, $subject, $matches);
	if ($matches) {
		include 'mobile/minicartview.php';
		die();
	}
}
matchminicartview();

function matchcategory(){
	$subject = $_SERVER['REQUEST_URI'];
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
	global $sql;
	$subject = $_SERVER['REQUEST_URI'];
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
	$subject = $_SERVER['REQUEST_URI'];
	$pattern = '/^\/gallery\d+\.htm(?:$|\?)/';
	preg_match($pattern, $subject, $matches);
	if ($matches) {
		return true;
	}
	
	return false;
}

if(matchgallery()) {
	$select_column_list = 'pd.products_name, p.products_image, ';
	require('includes/index_filters/default_filter.php');
	include 'mobile/gallery.php';
	die();
}

function matchsearch() {
	$subject = $_SERVER['REQUEST_URI'];
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