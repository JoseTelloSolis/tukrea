/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */


CKEDITOR.editorConfig = function(config) {
	config.filebrowserBrowseUrl = 'core/libs/kcfinder/browse.php?opener=ckeditor&type=files';
	config.filebrowserImageBrowseUrl = 'core/libs/kcfinder/browse.php?opener=ckeditor&type=images';
	config.filebrowserFlashBrowseUrl = 'core/libs/kcfinder/browse.php?opener=ckeditor&type=flash';
	config.filebrowserUploadUrl = 'core/libs/kcfinder/upload.php?opener=ckeditor&type=files';
	config.filebrowserImageUploadUrl = 'core/libs/kcfinder/upload.php?opener=ckeditor&type=images';
	config.filebrowserFlashUploadUrl = 'core/libs/kcfinder/upload.php?opener=ckeditor&type=flash';
};