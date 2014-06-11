<h1>Редактировать фото арт. <?php echo $model->article; ?> <a href='<?php echo $this->createUrl('admin/photo/index'); ?>' class="admin_title_link">Галерея</a></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>