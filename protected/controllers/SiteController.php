<?php

class SiteController extends Controller
{

	public function actions() {
	}

	public function actionIndex() {
		$this->render('index');
	}

    public function actionCatalog($type){
        $this->pageTitle=Yii::app()->params["categories"][$type].' - '.Yii::app()->name;
        if(isset($_GET['order']))
            $this->setOrder($_GET['order']);
        $model = Photo::model()->getPhotos($type, $this->getOrder());
        if(isset($_GET['order']))
            $this->renderPartial('_content',array('model'=>$model, 'type'=>$type));
        else
            $this->render('catalog',array('model'=>$model, 'type'=>$type));
    }

    public function actionModel($type, $id){
        $model = Photo::model()->findByAttributes(array('category'=>$type, 'article'=>$id));
        $this->pageTitle=$model->title.' арт. '.$model->article.' - '.Yii::app()->name;
        $this->render('model',array('model'=>$model, 'type'=>$type));
    }

	public function actionError() {
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

    public function actionLogin() {
        Yii::app()->request->redirect('/admin/login');
    }

    public function getOrder(){
        if(isset(Yii::app()->session['catalog_order']))
            $order = Yii::app()->session['catalog_order'];
        else {
            $order = Yii::app()->session['catalog_order'] = 'по артиклю';
        }
        return $order;
    }

    public function setOrder($order){
        Yii::app()->session['catalog_order'] = $order;
    }

    public function actionContact() {
        $this->render('contact');
    }

    public function actionShipping() {
        $model=new Order('shipping');
        if(isset($_POST['Order']))
        {
            $model->attributes=$_POST['Order'];
            $model->type='shipping';
            if($model->save()){
//                $this->redirect(array('index'));
            }
        }
        $this->render('shipping',array(
            'model'=>$model,
        ));
    }

    public function actionWholesale() {
        Price::model()->getPrice();
        $model=new Order('wholesale');
        if(isset($_POST['Order']))
        {
            $model->attributes=$_POST['Order'];
            $model->type='wholesale';
            if($model->save()){
//                $this->redirect(array('index'));
            }
        }
        $this->render('wholesale',array(
            'model'=>$model,
        ));
    }
}