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
    public function filters()
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
                'actions'=>array('order','price','logout','priceDelete', 'mailLog', 'utmLog', 'coupon', 'couponGenerate'),
                'users'=>array('admin'),
            ),
            array('allow',
                'actions'=>array('index','login'),
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
        if (!Yii::app()->user->isGuest){
            $this->render('index');
        } else {
            $this->redirect(array('login'));
        }

	}

    public function actionOrder()
    {
        $model=new Order('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Order']))
            $model->attributes=$_GET['Order'];

        $this->render('order',array(
            'model'=>$model,
        ));
    }

    public function actionOrderView($id)
    {
        $this->render('order_view',array(
            'model'=>Order::model()->findByPk($id),
        ));
    }

    public function actionOrderDelete($id)
    {
        Order::model()->findByPk($id)->delete();
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

    public function actionPriceDelete($id)
    {
        Price::model()->findByPk($id)->delete();
    }

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
        if($_SERVER["REMOTE_ADDR"] != Yii::app()->params['ipAddress'])
            throw new CHttpException(404,'Страница не найдена.');
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

    public function actionMailLog()
    {
        $model=new MailLog('search');
        $model->unsetAttributes();
        $this->render('mail_log',array(
            'model'=>$model,
        ));
    }

    public function actionCoupon()
    {
        $model=new Coupon('search');
        $model->unsetAttributes();
        $this->render('coupon',array(
            'model'=>$model,
        ));
    }

    public function actionCouponGenerate()
    {
        $model=new Coupon;
        if(isset($_POST['Coupon'])) {
            $model->attributes=$_POST['Coupon'];
            if($model->generate()) {
                $this->redirect(array('coupon'));
            }
        }
        $this->render('coupon_generate',array(
            'model'=>$model,
        ));
    }
    
    public function actionUtmLog()
    {
        $model=new Utm('search');
        $model->unsetAttributes();
        $this->render('utm',array(
            'model'=>$model,
        ));
    }
}