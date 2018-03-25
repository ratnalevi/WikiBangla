/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

	
	config.allowedContent = true;


    // Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';

    var roxyFileman = base_url+'ckeditor/plugins/imageuploader/imgbrowser.php';
 	config.filebrowserBrowseUrl = roxyFileman;
	config.filebrowserImageBrowseUrl = roxyFileman+'?type=image';
 	config.removeDialogTabs = 'link:upload;image:upload';
 
	config.extraPlugins = 'imageuploader';
	
};
