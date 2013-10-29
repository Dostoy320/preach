
tinymce.init
({
element_format: "html",
entity_encoding: "numeric",
setup:
function(ed)
{
	ed.on('init', function()
	{
		this.getDoc().body.style.fontSize = '14px'; // Editor default font size
	});
},
autosave_interval: "30s",
fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
height: 400,
resize: "both",
save_enablewhendirty: false,
selector:'textarea',
plugins: 'link image textcolor code',
toolbar1: 'undo redo | bold italic | fontsizeselect | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
});
