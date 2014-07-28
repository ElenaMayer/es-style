tinyMCEPopup.requireLangPack();

var ExampleDialog = {
	init : function() {
		/*var f = document.forms[0];

		// Get the selected contents as text and place it in the input
		f.someval.value = tinyMCEPopup.editor.selection.getContent({format : 'text'});
		f.somearg.value = tinyMCEPopup.getWindowArg('some_custom_arg');*/
	},

	insert : function(text) {
		// Insert the contents from the input into the document
		tinyMCEPopup.editor.execCommand('mceInsertContent', false, text);
		tinyMCEPopup.close();
	}
};

tinyMCEPopup.onInit.add(ExampleDialog.init, ExampleDialog);

function insertAction(type, filename1, filename2, p_width) {
    var html = '';

    if(type == 'preview'){
        html += '<div style="width:'+p_width+'px; text-align:center;" class="img-preview"><a href="'+filename2+'" title="" class="colorbox">';
    }

    html += '<img src="' + filename1 +'"';

    if(type == 'preview'){
        html += ' style="border: 1px solid #808080" ';
        html += " /></a>";
    }
    else{
        html += " />";
    }

    if(type == 'preview'){
        html += '<br /><a href="'+filename2+'" title="" class="colorbox zoom"><span>увеличить</span></a></div><br /><br />';
    }

    ExampleDialog.insert(html);
}