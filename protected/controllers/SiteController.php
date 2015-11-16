<?php

class SiteController extends Controller
{

	public function actions() {
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
            array('deny',
                'actions'=>array('login', 'register'),
                'users'=>array('@'),
            ),
            array('deny',
                'actions'=>array('customer', 'history'),
                'users'=>array('?'),
            ),
            array('allow',
                'users'=>array('*'),
            ),
        );
    }

    public function actionRegistration(){
        $user = new User;
        $user->attributes = Yii::app()->request->getPost('User');
        if ($user->validate()) {
            if($user->save()) {
                echo true;
                Yii::app()->end();
            }
        } else {
            $this->renderPartial('_register',array('modelAuth'=>$user));
        }
    }

    /**
     * Displays the login page
     */
    public function actionLogin(){
        $user=new User;
        $user->attributes = Yii::app()->request->getPost('User');
        // validate user input and redirect to the previous page if valid
        if ($user->validate() && $user->login()) {
            echo true;
            Yii::app()->end();
        } else {
            $this->renderPartial('_login', array('modelAuth' => $user));
        }
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
    }

	public function actionIndex() {
//        $this->sendOneMail();
		$this->render('index');
	}

//    protected function sendOneMail(){
//        $to = 'linner86@mail.ru';
//        $subject = 'Восточный стиль - новинки!';
//        include_once Yii::getPathOfAlias('root.protected.views.site').'\mail.php';
//        $headers = 'From: esstyle54@gmail.com' . "\r\n" .
//            'Reply-To: esstyle54@gmail.com' . "\r\n" .
//            'Content-type: text/html' . "\r\n" .
//            'X-Mailer: PHP/' . phpversion();
//        mail($to, $subject ,$message, $headers);
//    }

    public function actionCatalog($type){
        $this->pageTitle=Yii::app()->name .' - '. Yii::app()->params["categories"][$type];
        if(isset($_GET['order']))
            $this->setOrder($_GET['order']);
        if(isset($_GET['size']))
            $this->setSize($_GET['size']);
        $model = Photo::model()->getPhotos($type, $this->getOrder(), $this->getSize());
        if(isset($_GET['order']) || isset($_GET['size']))
            $this->renderPartial('catalog',array('model'=>$model, 'type'=>$type));
        else
            $this->render('catalog',array('model'=>$model, 'type'=>$type));
    }

    public function actionModel($type, $id){
        $model = Photo::model()->findByAttributes(array('category'=>$type, 'article'=>$id));
        if(!isset($model->is_show) || !$model->is_show)
            throw new CHttpException(404,'К сожалению, модель не найдена.');
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

    public function getOrder(){
        if(!isset(Yii::app()->session['catalog_order'])) {
            Yii::app()->session['catalog_order'] = 'по артиклю';
        }
        return Yii::app()->session['catalog_order'];
    }

    public function setOrder($order){
        Yii::app()->session['catalog_order'] = $order;
    }

    public function getSize(){
        if(isset(Yii::app()->session['catalog_size']))
            $order = Yii::app()->session['catalog_size'];
        else {
            $order = Yii::app()->session['catalog_size'] = 'все';
        }
        return $order;
    }

    public function setSize($size){
        Yii::app()->session['catalog_size'] = $size;
    }

    public function actionContact() {
        $this->pageTitle=Yii::app()->name .' - Адреса';
        $this->render('contact');
    }

    public function actionOrderOld($type) {
        $type_str = $type=='shipping'?'В розницу':'Оптом';
        $this->pageTitle=Yii::app()->name.' - '.$type_str;
        $model=new Order($type);
        if(isset($_POST['Order'])) {
            $model->attributes=$_POST['Order'];
            $model->type=$type;
            if($model->save()){
                $user = Yii::app()->getComponent('user');
                $user->setFlash( 'warning', "Спасибо за заявку! Мы свяжемся с вами в ближайшее время!");
                $model->sendMail();
            }
            $this->renderPartial('_order_form',array(
                'model'=>$model, 'type'=>$type
            ));
        } else {
            $this->render('order_old',array(
                'model'=>$model, 'type'=>$type
            ));
        }
    }

    public function actionPrice(){
        $price = Price::model()->find(array('order'=>'date_create DESC'));
        $name = Yii::getPathOfAlias('data').'/price/'.$price->file;
        $file=file_get_contents($name);
        header("Content-Type: text/plain");
        header("Content-disposition: attachment; filename=$price->file");
        header("Pragma: no-cache");
        echo $file;
        exit;
    }

    public function actionCustomer(){
        $model = User::model()->getUser();
        $model->scenario = 'customer';
        $modelPass = new User('changePassword');
        if(isset($_POST['User'])) {
            $model->attributes=$_POST['User'];
            if($model->validate() && $model->save()) {
                Yii::app()->user->setFlash( 'success', "Данные сохранены.");
                if (isset($_POST["data_type"])) {
                    $this->renderPartial('user/_'.$_POST["data_type"], array('model' => $model, 'modelPass' => $modelPass));
                }
            }
        } else {
            $this->render('user/customer', array(
                'model' => $model,
                'modelPass' => $modelPass,
            ));
        }
    }

    public function actionHistory(){

        $model = User::model()->getUser();
        $this->render('user/history',array(
            'model'=>$model,
        ));
    }

    public function actionCart(){
        $model = [];
        if(Yii::app()->user->isGuest) {
            if (!empty(Yii::app()->session['cartId']))
                $model = Cart::model()->findByPk(Yii::app()->session['cartId']);
        } else {
            $model = Cart::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
        }
        $this->render('cart',array(
            'model'=>$model,
        ));
    }

    public function actionDeleteItemFromCart(){
        $cartItem = CartItem::model()->findByPk($_POST['item_id']);
        if($cartItem){
            $cartItem->delete();
            $this->renderPartial('cart/_cart_total',array('model'=>$cartItem->cart));
        } else {
            echo false;
            Yii::app()->end();
        }
    }

    public function actionOrder($id){
        $cart = Cart::model()->findByPk($id);
        if(!Yii::app()->user->isGuest) {
            $user = User::model()->getUser();
        }
        if($cart) {
            if((Yii::app()->user->isGuest && !$cart->user_id) || Yii::app()->user->id == $cart->user_id) {
                if (isset($_POST['User'])) {
                    $user->attributes = $_POST['User'];
                    if ($user->validate() && $user->save()) {

                    }
                }
                $this->render('order', array(
                    'user' => $user,
                    'cart' => $cart
                ));
            } else throw new CHttpException(404,'К сожалению, страница не найдена.');
        } else throw new CHttpException(404,'К сожалению, страница не найдена.');
    }
}