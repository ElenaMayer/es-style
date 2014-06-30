<?php

class SiteController extends Controller
{

	public function actions()
	{
	}

	public function actionIndex()
	{
		$this->render('index');
	}

    public function actionDress()
    {
        $this->layout='//layouts/catalog';
        if(isset($_GET['order']))
            $this->setOrder($_GET['order']);
        $model = Photo::model()->getPhotos(1, $this->getOrder());
        if(isset($_GET['order']))
            $this->renderPartial('_catalog',array('model'=>$model));
        else
            $this->render('dress',array('model'=>$model));
    }

    private function catalog($type_id){

    }

	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

    public function actionLogin()
    {
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