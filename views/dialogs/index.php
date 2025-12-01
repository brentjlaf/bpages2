<?php
// views/dialogs/index.php: Template placeholder for missing template coverage. VDEMO

// ---- List ----

// Listing available windows
// Searching through both global and local installs in mod
// Collecting found files in unified pool. System will handle where's which.
$files	= [];
foreach ( [$mwLoad->GlobalPath, $mwLoad->LocalPath] as $path ) {

	// Skipping unused path
	if ( !$path )
		continue;

	// Expanding to views path
	$path	= compilePath($path, MOD_VIEWS, 'dialogs');

	// Looking for views starting with 'w', that's windows
	$files	+= listFiles($path, 'w*.php');

} //FOR each install path

// ---- Views ----

// Converting found files into views, cleaning file names into usable strings
$views	= [];
foreach ( $files as $file ) {

	// Removing extension for window name
	$name	= FileName($file);

	// Trimming starting 'w' for clean title
	$title	= substr($name, 1);

	// Also humanizing
	$title	= strConvertCase($title, STRCASE_TITLE);

	// Collecting into a pool
	$views[]	= [
		'file'		=> $file,
		'name'		=> $name,
		'title'		=> $title,
	]; //$views

} //FOR each file

// ---- Windows ----

// Loading window/dialog from each view found
foreach ( $views as $view )
	$mwLoad->Window($view['name'], 'dialogs/'.$view['name'] );

?>

<style type="text/css">

.mwIndexTable .handler.sortable {
	display	: none;
}

.mwIndexTable li.head .handler.nestable {
	display	: none;
}

.mwIndexTable dl:hover>.handler.sortable {
	display	: block;
}

.mwIndexTable dl:hover>.handler.nestable {
	display	: none;
}

</style>

<ul id="mwDemoIndex" class="mwIndexTable">

	<li class="head">
		<dl>
			<dt data-sort="title">Dialog</dt>

			<dd class="small">Status</dd>

		</dl>
	</li>

<?php	foreach ( $views as $view ) { ?>

	<li data-id="item-1" class="no-children collapsed">
		<dl>
			<dt>
				<a href="#" onclick="mwWindow('<?=$view['name']?>').show(); return false;">
					<?=$view['title']?>
				</a>
			</dt>

			<dd><a class="button ok" href="#" onclick="return false;"></a></dd>
		</dl>
	</li>

<?php	} //FOR each view ?>

</ul>
