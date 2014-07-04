<?php

class AdminController extends Controller
{

    public $layout='//layouts/admin_column';

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
	}

    /**
     * @return array action filters
     */
    /*public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
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
                'actions'=>array('index','order','price','logout'),
                'users'=>array('admin'),
            ),
            array('allow',
                'actions'=>array('login'),
                'users'=>array('*'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
    {
        if (Yii::app()->user->isGuest)
            Yii::app()->request->redirect('/admin/login');
        else
		    $this->render('index');
	}

    public function actionOrder()
    {
        $this->render('order');
    }

    public function actionPrice()
    {
        $model=new Price('search');
        $model->unsetAttributes();
        $model_new=new Price;
        if(isset($_POST['Price']))
        {
            if($model_new->save()){
                $this->redirect(array('price'));
            }
        }
        $this->render('price',array(
            'model'=>$model,
            'model_new'=>$model_new,
        ));
    }

    public function actionDeletePrice($id)
    {
        Price::model()->findByPk($id)->delete();
    }

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect('/admin/index');
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect('/');
	}
}