

CKEDITOR.editorConfig = function( config ) {


	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [

		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles'] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'align' ] },
		{ name: 'insert'},
		{ name: 'tools' }
	];

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Superscript,image';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';

	config.removePlugins = 'image,elementspath,HorizontalRule,SpecialChar';
	config.removeButtons = 'HorizontalRule,SpecialChar,Subscript,Superscript,Underline';

};
