<?php
// views/desktop.php: Template placeholder for missing template coverage. VDEMO
	$mwLoad->Window('wDialog', 'dialogs/wCombo'); 

	$mwLoad
		->js('sample.js')
		->css('sample.css')
	; //$mwLoad

?>

<style>

</style>

<div class="mwDskTools">

	<h1><span>Index</span> Demo</h1>

	<a class="Add" onclick="mwWindow('wDialog').show();">Dialog</a>

</div>

<div class="mwDesktop">

	<?=$demoIndex?>

</div>

<script type="text/javascript">

	jQuery( function () {
	}); //jQuery

</script>