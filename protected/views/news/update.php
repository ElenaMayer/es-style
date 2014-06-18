<h1>Редактировать новость "<?php echo $model->title; ?>" <a href='<?php echo $this->createUrl('admin/news/index'); ?>' class="admin_title_link">Список</a></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>