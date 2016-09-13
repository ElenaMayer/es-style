<div class="form admin">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'blog-post-form',
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<div class="row">
        <div class="label"><?php echo $form->labelEx($model,'title'); ?></div>
        <div><?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?></div>
	</div>

	<div class="row">
		<div class="label"><?php echo $form->labelEx($model,'url'); ?></div>
		<div><?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255)); ?></div>
	</div>

	<div class="row">
		<div class="label"><?php echo $form->labelEx($model,'image'); ?></div>
		<div><?php echo $form->fileField($model,'image'); ?></div>
	</div>
	<p><img id="post_image" class="post_image<?php if(!$model->img): ?> hidden<?php endif; ?>" src="<?php echo $model->getImageUrl()?>"/></p>

	<div class="row">
        <div class="label"><?php echo $form->labelEx($model,'description'); ?></div>
        <div><?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?></div>
	</div>

	<div class="row">
        <div class="label"><?php echo $form->labelEx($model,'content'); ?></div>
		<div>
			<?php $this->widget('application.extensions.tiny_mce.TinyMCE', [
				'model'=>$model,
				'attribute'=>'content',
				'editorOptions'=>[
					'language'=>'ru',
					'width'=>'100%',
					'height'=>'600px'
				],
				'htmlOptions'=>['class'=>'editor',
					'width'=>'100%',
					'height'=>'600px']
			]); ?>
		</div>
	</div>

	<div class="row">
        <div class="label"><?php echo $form->labelEx($model,'tags'); ?></div>
        <div><?php echo $form->textField($model,'tags',array('size'=>60,'maxlength'=>255)); ?></div>
	</div>

	<div class="row like_count">
        <div class="label"><?php echo $form->labelEx($model,'likeCount'); ?></div>
        <div><?php echo $form->textField($model,'likeCount'); ?></div>
	</div>

	<div class="row">
        <div class="label"><?php echo $form->labelEx($model,'is_show'); ?></div>
		<div><?php echo $form->checkBox($model,'is_show'); ?></div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script>
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#post_image').attr('src', e.target.result);
				$('#post_image').removeClass('hidden');
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#BlogPost_image").change(function(){
		readURL(this);
	});

	function translit(ru_str) {
		var translitJson = '{"Я":"Ya","я":"ya","Ю":"Yu","ю":"yu","Ч":"Ch","ч":"ch","Ш":"Sh","ш":"sh","Щ":"Sh","щ":"sh","Ж":"Zh","ж":"zh","А":"A","а":"a","Б":"B","б":"b","В":"V","в":"v","Г":"G","г":"g","Д":"D","д":"d","Е":"E","е":"e","Ё":"E","ё":"e","З":"Z","з":"z","И":"I","и":"i","Й":"J","й":"j","К":"K","к":"k","Л":"L","л":"l","М":"M","м":"m","Н":"N","н":"n","О":"O","о":"o","П":"P","п":"p","Р":"R","р":"r","С":"S","с":"s","Т":"T","т":"t","У":"U","у":"u","Ф":"F","ф":"f","Х":"H","х":"h","Ц":"C","ц":"c","Ы":"Y","ы":"y","Ь":"","ь":"","Ъ":"","ъ":"","Э":"E","э":"e"," ":"_",".":"","!":"","?":""}';
		var translitArr = jQuery.parseJSON(translitJson);
		var en_str = '';
		for (var i = 0, len = ru_str.length; i < len; i++) {
			if (translitArr[ru_str[i]] && translitArr[ru_str[i]].length > 0)
				en_str += translitArr[ru_str[i]];
			else
				en_str += ru_str[i];
		}
		return en_str;
	}
	$( "#BlogPost_title" ).keyup(function(e) {
		ru_str = $(this).val();
		$('#BlogPost_url').val(translit(ru_str));
	});

	$( function() {
		function split( val ) {
			return val.split( /,\s*/ );
		}
		function extractLast( term ) {
			return split( term ).pop();
		}

		$( "#BlogPost_tags" )
		// don't navigate away from the field on tab when selecting an item
			.on( "keydown", function( event ) {
				if ( event.keyCode === $.ui.keyCode.TAB &&
					$( this ).autocomplete( "instance" ).menu.active ) {
					event.preventDefault();
				}
			})
			.autocomplete({
				source: function( request, response ) {
					$.getJSON( "/blog/blogPost/getTagList", {
						term: extractLast( request.term )
					}, response );
				},
				focus: function() {
					// prevent value inserted on focus
					return false;
				},
				select: function( event, ui ) {
					var terms = split( this.value );
					// remove the current input
					terms.pop();
					// add the selected item
					terms.push( ui.item.value );
					// add placeholder to get the comma-and-space at the end
					terms.push( "" );
					this.value = terms.join( ", " );
					return false;
				}
			});
	} );
</script>