<?php
// backend/Skins.php: Template placeholder for missing template coverage.
namespace demo;

use Exception;

/**//**----= Skins =------------------------------------------------------------------------------------------------------**//**
*
*	Skins controller for design prototypes.
*	Contains UI experiments and admin interface design mockups.
*
*	@package	morweb
*	@subpackage	demo
*	@category	controller
*
**/// **-----------------------------------------------------------------------------= by Mr.V!T @ Morad Media Inc. =----**// **
class Skins extends \mwController {

	function index( $subsection = '' ) {

		if ( !empty($subsection) and !isAlnum($subsection) )
			throw( new Exception('Invalid subsection name') );

		$indexName	= $subsection ? $subsection.'Index' : 'demoIndex';

		$data		= [];
		$this->loadContent($indexName, $subsection.'/index', $data);

	// ==== Non AJAX ====

		if ( $this->isAjax ) return;

		$this->load()
			->resource('datePicker', 'tinyMCE', 'mw.cells')
			->resource('sortable', 'nested', 'draggable', 'droppable')
		; //$load


		return $this->loadIndex($subsection.'/desktop');

	} //FUNC index

} //CLASS Skins

?>