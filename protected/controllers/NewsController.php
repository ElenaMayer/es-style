<?php

class NewsController extends Controller
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
			'postOnly + delete', // we only allow deletion via POST request
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
                'actions'=>array('create','update','index','delete', 'setIsShow'),
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
		$model=new News;
		if(isset($_POST['News']))
		{
			$model->attributes=$_POST['News'];
			if($model->save()) {
                if($model->is_send_mail)
                    $this->sentMailWithNews($model);
                $this->redirect(array('index'));
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
		if(isset($_POST['News']))
		{
			$model->attributes=$_POST['News'];
			if($model->save()) {
                if (isset($_POST['News']['is_send_mail']) && $_POST['News']['is_send_mail'] == 1) {
                    $this->sentMailWithNews($model);
                }
                $this->redirect(array('index'));
            }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

    public function sentMailWithNews($model){
        $this->layout = '//layouts/mail_sub';
        $mail = new Mail();
        $mail->subject = $model->title;
        $users = User::model()->findAllByAttributes(['is_subscribed'=>1]);
        foreach($users as $user){
            if(!empty($user->email)){
                Yii::app()->userForMail->setUser($user);
                $mail->message = $this->render('/site/mail/news',array('content'=>$model->content),true);
                $mail->to = $user->email;
                $mail->send();
            }
        }
    }

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new News('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['News']))
			$model->attributes=$_GET['News'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return News the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=News::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param News $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='news-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    //ajax method
    public function actionSetIsShow($id){
        $news = News::model()->findByPk($id);
        if(empty($news->is_show))
            $news->is_show = 1;
        else
            $news->is_show = 0;
        $news->save();
        Yii::app()->end();
    }
}
