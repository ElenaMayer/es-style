<?php

class OrderHistoryController extends Controller
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id) {
		$model=$this->loadModel($id);

		if(isset($_POST['OrderHistory'])) {
            $oldStatus = $model->status;
			$model->attributes=$_POST['OrderHistory'];

			if($model->save()) {
                if($model->status != $oldStatus)
                    $this->statusChanged($model);
                $this->redirect(array('index'));
            }
		}
		$this->render('update',array(
			'model'=>$model,
		));
	}

    private function statusChanged($model){
        switch ($model->status){
            case 'collect':
            case 'shipping_by_rp':
            case 'waiting_delivery':
                $this->sendChangeStatusMail($model);
                break;
            case 'not_redeemed':
                if (!empty($model->user)){
                    $model->user->blockUser();
                }
                break;
        }
    }

    private function sendChangeStatusMail($model){
        $this->layout = '//layouts/mail';
        $mail = new Mail();
        $mail->to = $model->user->email;
        if($model->status == 'collect'){
            $mail->subject = "Заказ № ". $model->id ." передан на комплектацию. Интернет-магазин ".Yii::app()->params['domain'];
        } elseif($model->status == 'shipping_by_rp') {
            $mail->subject = "Заказ № ". $model->id ." передан в доставку. Интернет-магазин ".Yii::app()->params['domain'];
        } elseif($model->status == 'waiting_delivery') {
            $mail->subject = "Заказ № ". $model->id ." ожидает вручения". ($this->shipping_method == 'russian_post') ? " в почтовом отделении" : "" ."! Интернет-магазин ".Yii::app()->params['domain'];
        }
        $mail->message = $this->render('/site/mail/order',array('order'=>$model),true);
        $mail->send();
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
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $model=new OrderHistory('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['OrderHistory']))
            $model->attributes=$_GET['OrderHistory'];

        $this->render('index',array(
            'model'=>$model,
        ));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return OrderHistory the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=OrderHistory::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param OrderHistory $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='order-history-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
