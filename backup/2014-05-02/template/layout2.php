<?php include(dirname(__FILE__)."/header.php") ?>
<!-- START LAYOUT -->
<div class="container" id="layout">
	<div class="row">
		<div class="col-md-3">
		<?php echo $_LAYOUT['left'] ?>
		</div>
		
		<div class="col-md-9">
		<?php echo $_LAYOUT['right'] ?>
		</div>
	</div>
</div>
<!-- END LAYOUT -->
<?php include(dirname(__FILE__)."/footer.php") ?>