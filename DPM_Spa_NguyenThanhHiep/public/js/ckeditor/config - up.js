/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	config.language = 'vi';
	config.uiColor = '#AADC6E';
	config.skin = 'office2013';
	config.height = 500;
	config.removePlugins = 'elementspath';
	config.resize_enabled = false;
	
	config.toolbarGroups = [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'editing' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		'/',
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'others', groups: [ 'others' ] }
	];
	config.removeButtons = 'Save,Print,Paste,PasteFromWord,Subscript,Superscript,Language,Anchor,Flash,SpecialChar,PageBreak';
	
	config.filebrowserBrowseUrl			= 'http://fit.agu.edu.vn/public/js/ckfinder/ckfinder.html?type=Files';
	config.filebrowserImageBrowseUrl	= 'http://fit.agu.edu.vn/public/js/ckfinder/ckfinder.html?type=Images';
	config.filebrowserUploadUrl			= 'http://fit.agu.edu.vn/public/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	config.filebrowserImageUploadUrl	= 'http://fit.agu.edu.vn/public/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
};