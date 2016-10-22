<?php

class PhotoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/admin_column';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
//			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('create','update','index','delete', 'setIsShow', 'setIsAvailable', 'setIsNew', 'sendMailWithNews'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Creates a new model.
	 */
	public function actionCreate()
	{
		$model=new Photo;
		if(isset($_POST['Photo']))
		{
			$model->attributes=$_POST['Photo'];
            if (!empty($_POST['Photo']['subcategoryArr']))
                $model->subcategory = implode(",", $_POST['Photo']['subcategoryArr']);
            if (!empty($_POST['Photo']['sizesArr']) && $_POST['Photo']['size'] == 1)
                $model->sizes = implode(",", $_POST['Photo']['sizesArr']);
            if (!empty($_POST['Photo']['colorArr']))
                $model->color = implode(",", $_POST['Photo']['colorArr']);
			if($model->save()){
				$this->redirect('/admin/photo/create');
            }
		}
		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['Photo']))
		{
			$model->attributes=$_POST['Photo'];
            $model->subcategory = implode(",", $_POST['Photo']['subcategoryArr']);
            if ($_POST['Photo']['size'] == 1)
                $model->sizes = implode(",", $_POST['Photo']['sizesArr']);
            $model->color = implode(",", $_POST['Photo']['colorArr']);
			if($model->save()){
				$this->redirect(array('index'));
            }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $model=new Photo('search');
        $model->unsetAttributes();  // clear any default values
        $mailComplete = false;
        if(isset($_GET['Photo']))
            $model->attributes=$_GET['Photo'];
        if(isset($_GET['mailComplete']))
            $mailComplete = true;

        $this->render('index',array(
            'model'=>$model,
            'mailComplete'=>$mailComplete
        ));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Photo the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Photo::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Photo $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='photo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    //ajax method
    public function actionSetIsShow($id){
        $photo = Photo::model()->findByPk($id);
        if(empty($photo->is_show))
            $photo->is_show = 1;
        else
            $photo->is_show = 0;
        echo $photo->save();
        Yii::app()->end();
    }

    //ajax method
    public function actionSetIsAvailable($id){
        $photo = Photo::model()->findByPk($id);
        if(empty($photo->is_available))
            $photo->is_available = 1;
        else
            $photo->is_available = 0;
        echo $photo->save();
        Yii::app()->end();
    }

    //ajax method
    public function actionSetIsNew($id){
        $photo = Photo::model()->findByPk($id);
        if(empty($photo->is_new))
            $photo->is_new = 1;
        else
            $photo->is_new = 0;
        echo $photo->save();
        Yii::app()->end();
    }

    public function actionSendMailWithNews() {
        $this->layout = '//layouts/mail_sub';
        $mail = new Mail();
        $mail->subject = "Новинки ".Yii::app()->params['domain'];
        $users = User::model()->findAllByAttributes(['is_subscribed'=>1]);
        foreach($users as $user){
            if(!empty($user->email)){
                Yii::app()->userForMail->setUser($user);
                $mail->message = $this->render('/site/mail/newPhotos', [
                    'photos'=>Photo::model()->getNewPhotos()
                ], true);
                $mail->to = $user->email;
                $mail->send();
            }
        }
        $this->redirect('/admin/photo/index?mailComplete');
    }
}
