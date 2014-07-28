	tinyMCE.init({
		// General options
		mode : "specific_textareas",
        editor_selector: 'editor',
		theme : "advanced",
		plugins : "autolink,lists,advimage,advlink,iespell,inlinepopups,contextmenu,paste,noneditable,gisimage,typograf",

        language : "ru",

		// Theme options
		theme_advanced_buttons1 : "typograf,cut,paste,pasteword,copy,|,undo,redo,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,outdent,indent,|,link,unlink,gisimage,charmap,|,code",
		theme_advanced_buttons2 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
        theme_advanced_resize_horizontal : false,
        forced_root_block : '',
        force_br_newlines : true,
        force_p_newlines : false,
        extended_valid_elements : "script[async|defer|class|data-id|data-ratio|src|charset|language|type|onclick],a[accesskey|charset|class|coords|dir<ltr?rtl|href|hreflang|id|lang|name"
          +"|onblur|onclick|ondblclick|onfocus|onkeydown|onkeypress|onkeyup"
          +"|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|rel|rev"
          +"|shape<circle?default?poly?rect|style|tabindex|title|target|type|data-title|data-text],"
          +"img[align<bottom?left?middle?right?top|alt|border|class|dir<ltr?rtl|height"
              +"|hspace|id|ismap<ismap|lang|longdesc|name|onclick|ondblclick|onkeydown"
              +"|onkeypress|onkeyup|onmousedown|onmousemove|onmouseout|onmouseover"
              +"|onmouseup|src|style|title|usemap|vspace|width|data-arrow],"
          +"form[accept|accept-charset|action|class|dir<ltr?rtl|enctype|id|lang"
              +"|method<get?post|name|onclick|ondblclick|onkeydown|onkeypress|onkeyup"
              +"|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup|onreset|onsubmit"
              +"|style|title|target|yandex-id|data-city],"
          +"a[*],div[*],p[*],span[*],*[*]",
        convert_urls : false,
        remove_linebreaks : false,
        setup : function(ed) {
            ed.onChange.add(function(ed, l) {
                var parentId = '#' + ed.id;
                $(parentId).text(l.content);
                $(parentId).val(l.content);
                $(parentId).change().blur();
            });

        }

		// Example content CSS (should be your site CSS)
		//content_css : "/assets/frontend/css/styles.css"
	});