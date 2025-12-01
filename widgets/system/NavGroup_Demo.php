<?php
// widgets/system/NavGroup_Demo.php: Template placeholder for missing template coverage. VDEMO
/**//**----= mwNavGroup_Demo =---------------------------------------------------------------------------------------------**//**
*
*	Demo nav group.
*	Navigation widget for design prototypes and UI experiments.
*
*	@package	morweb
*	@subpackage	demo
*	@category	widget
*
**/// **-----------------------------------------------------------------------------= by Mr.V!T @ Morad Media Inc. =----**// **
class mwNavGroup_Demo extends mwNavGroup {

	public	$ParentGroup	= 'Mods';
//	public	$Caption	= 'Demo - Skins';
//	public	$Url		= 'section:/skins';
//	public 	$Description	= 'Design prototypes and UI experiments';

	public	$IconClass	= 'Content';

	public	$Items		= [
		'skins'		=> ['Demo - Skins', 'section:/skins', 'Design prototypes and UI experiments'],
		'dialogs'	=> ['Demo - Dialogs', 'section:/skins/dialogs', 'Dialog windows examples'],
	]; //$Items

	function __construct () {

		parent::__construct();

	} //FUNC __construct

} //CLASS mwNavGroup_Demo

?>