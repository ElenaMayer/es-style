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
			array('allow',
				'actions'=>array('create','update','index','delete', 'setIsShow', 'setIsAvailable', 'setIsNew', 'sendMailWithNews'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionCreate() {
		$model=new OrderHistory();
		$modelCartItem=new CartItem();
		if(isset($_POST['OrderHistory'])) {
			$model->attributes = $_POST['OrderHistory'];
			$model->id = floatval(Yii::app()->dateFormatter->format('yyMMdd', $model->date_create)) . floatval(Yii::app()->dateFormatter->format('HHmmss', time()));
			if($model->save()) {
				$this->saveModelsToOrder($model->id);
				OrderHistory::refreshOrderNewSum();
				$this->redirect(array('index'));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'modelCartItem' => $modelCartItem
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id) {
		$model=$this->loadModel($id);
		$modelCartItem=new CartItem();

		if(isset($_POST['OrderHistory'])) {
            $oldStatus = $model->status;
			$model->attributes=$_POST['OrderHistory'];

			if($model->save()) {
				$this->saveModelsToOrder($model->id);
                if($model->status != $oldStatus)
                    $this->statusChanged($model);
                OrderHistory::refreshOrderSum();
                $this->redirect(array('index'));
            }
		}
		$this->render('update',array(
			'model'=>$model,
			'modelCartItem' => $modelCartItem
		));
	}

	private function saveModelsToOrder($order_id){
		if(isset($_POST['CartItemNew'])){
			foreach ($_POST['CartItemNew'] as $cartItem){
				$newItem = new CartItem();
				$newItem->attributes = $cartItem;
				$newItem->order_id = $order_id;
				if ($newItem->photo->is_sale){
					$newItem->price = $newItem->photo->old_price;
					$newItem->new_price = $newItem->photo->new_price;
				} else {
					$newItem->price = $newItem->photo->price;
				}
				$newItem->save();
			}
		}
	}

    private function statusChanged($model){
        switch ($model->status){
            case 'collect':
            case 'waiting_delivery':
			case 'confirmation':
				if(!empty($model->email))
					$this->sendChangeStatusMail($model);
                break;
			case 'shipping_by_rp':
				if(!empty($model->email))
					$this->sendChangeStatusMail($model);
				break;
            case 'not_redeemed':
                if (!empty($model->user)){
                    $model->user->blockUser();
                }
                break;
			case 'canceled':
				break;
        }
    }

    private function sendChangeStatusMail($model){
		$this->layout = '//layouts/mail';
		$mail = new Mail();
		$mail->to = $model->email;
		if($model->status == 'collect'){
			$mail->subject = "Заказ № ". $model->id ." передан на комплектацию. Интернет-магазин ".Yii::app()->params['domain'];
		} elseif($model->status == 'shipping_by_rp') {
			$mail->subject = "Заказ № ". $model->id ." передан в доставку. Интернет-магазин ".Yii::app()->params['domain'];
		} elseif($model->status == 'waiting_delivery') {
			$mail->subject = "Заказ № ". $model->id ." ожидает вручения". ($model->shipping_method == 'russian_post' ? " в почтовом отделении" : "") ."! Интернет-магазин ".Yii::app()->params['domain'];
		} elseif($model->status == 'confirmation') {
			$mail->subject = "Заказ № ". $model->id ." ожидает подтверждения. Интернет-магазин ".Yii::app()->params['domain'];
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
		$model = $this->loadModel($id);
		OrderHistory::refreshOrderNewSum();
		$model->delete();

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
