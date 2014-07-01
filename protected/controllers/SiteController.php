<?php

class SiteController extends Controller
{

	public function actions() {
	}

	public function actionIndex() {
		$this->render('index');
	}

    public function actionCatalog($type){
        $this->layout='//layouts/catalog';
        $this->pageTitle=Yii::app()->params["categories"][$type].' - '.Yii::app()->name;
        if(isset($_GET['order']))
            $this->setOrder($_GET['order']);
        $model = Photo::model()->getPhotos($type, $this->getOrder());
        if(isset($_GET['order']))
            $this->renderPartial('_catalog',array('model'=>$model));
        else
            $this->render('catalog',array('model'=>$model));
    }

    public function actionModel($type, $id){
        $this->layout='//layouts/catalog';
        $this->pageTitle=Yii::app()->params["categories"][$type].' - '.Yii::app()->name;
        if(isset($_GET['order']))
            $this->setOrder($_GET['order']);
        $model = Photo::model()->getPhotos($type, $this->getOrder());
        if(isset($_GET['order']))
            $this->renderPartial('_catalog',array('model'=>$model));
        else
            $this->render('catalog',array('model'=>$model));
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
        Yii::app()->request->redirect(Yii::app()->createUrl('/admin/login'));
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

}