<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
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
        $model = Photo::model()->findAllByAttributes(
            array('is_show' => 1, 'category_id' => 1),
            array('order'=>'article DESC')
        );
        $this->render('dress',array(
            'model'=>$model,
        ));
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

    }