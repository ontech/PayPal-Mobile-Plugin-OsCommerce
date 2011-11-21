<?php
$mobile_category_tree = $tree;
$m = 1;
?>
<div id="cat" style="position: absolute; width: 100%; display: none; overflow: visible; min-height: 600px; z-index: 500; margin-top: 75px; background-image: -webkit-gradient(linear, left top, left bottom, from(rgba(204, 204, 204, 1.0)), to(rgba(204, 204, 204, 0.50))); background-color: transparent;" class="ui-page ui-body-b">

	<div data-role="content" class="ui-content">	
		<ul data-role="listview" data-inset="true" class="ui-listview ui-listview-inset ui-corner-all ui-shadow">
		<?php   while ($m) { ?>
		<li class="ui-li ui-li-static ui-body-c"><?php if($mobile_category_tree[$m]['parent']){echo "---- ";} ?><a href="category<?php echo htmlspecialchars(preg_replace('/^cPath=/', '', $mobile_category_tree[$m]['path'])); ?>_1.htm?cPath=<?php echo htmlspecialchars(preg_replace('/^cPath=/', '', $mobile_category_tree[$m]['path'])); ?>" class="ui-link"><?php echo $mobile_category_tree[$m]['name'] ?> </a></li>
		<?php 	$m = $mobile_category_tree[$m]['next_id']; } ?>
		</ul>
	</div><!-- /content -->
	
</div><!-- /page -->