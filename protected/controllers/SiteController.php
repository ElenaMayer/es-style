<?php

include(Yii::getPathOfAlias('root.protected/modules.blog.models').'/BlogPost.php');

class SiteController extends Controller {

    public function init(){
        parent::init();
//        self::saveUTM();
    }

    public function actions() {
        return array(
            'captcha'=>array(
                'class'=>'CCaptchaAction',
            ),
        );
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
                'actions'=>array('customer', 'history', 'historyItem'),
                'users'=>array('?'),
            ),
            array('allow',
                'users'=>array('*'),
            ),
        );
    }

    private static function saveUTM(){
        if($_GET && isset($_GET['utm_source'])){
            $utm = new Utm();
            $utm->utm_source = $_GET['utm_source'];
            if ($_GET['utm_medium']) $utm->utm_medium = $_GET['utm_medium'];
            if ($_GET['utm_campaign']) $utm->utm_campaign = $_GET['utm_campaign'];
            if ($_GET['utm_term']) $utm->utm_term = $_GET['utm_term'];
            if ($_GET['utm_content']) $utm->utm_content = $_GET['utm_content'];
            $utm->save();
        }
    }

    public function actionRegistration(){
        $user = new User;
        $user->scenario = 'registration';
        $user->attributes = Yii::app()->request->getPost('User');
        $current_cart = Yii::app()->cart->currentCart;
        if ($user->validate()) {
            $user->password = $user->password1;
            if($user->save()) {
                if($current_cart) {
                    Yii::app()->cart->currentCart = $current_cart;
                    Yii::app()->cart->currentCart->user_id = $user->id;
                    Yii::app()->cart->currentCart->save();
                }
                echo true;
                Yii::app()->end();
            }
        } else {
            $this->renderPartial('auth/_register',array('modelAuth'=>$user),false,true);
        }
    }

    public function actionLogin(){
        $user=new User;
        $user->scenario = 'login';
        $user->attributes = Yii::app()->request->getPost('User');
        $current_cart = Yii::app()->cart->currentCart;
        if ($user->validate() && $user->login()) {
            if ($current_cart) {
                $cart = Cart::model()->findByAttributes(array('user_id' => Yii::app()->user->id));
                if($cart) {
                    $cart->addItemsToCart($current_cart->cartItems);
                    if(Yii::app()->controller->action->id == 'order'){
                        Yii::app()->cart->currentCart->user_id = $user->id;
                        Yii::app()->cart->currentCart->is_active = false;
                        Yii::app()->cart->currentCart->save();
                    } else {
                        Yii::app()->cart->currentCart->delete();
                    }
                } else {
                    Yii::app()->cart->currentCart->user_id = $user->id;
                }
            }
            echo true;
            Yii::app()->end();
        } else {
            $this->renderPartial('auth/_login', array('modelAuth' => $user),false,true);
        }
    }

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(array('site/index'));
    }

    public function actionIndex() {

        $newPhotos = Photo::model()->findAllByAttributes(['is_available'=>1, 'is_show' => 1, 'is_new'=>1], ['limit' => 10]);
        $hitPhotos = Photo::model()->findAllByAttributes(['is_available'=>1, 'is_show' => 1, 'is_hit'=>1], ['limit' => 10]);
        $salePhotos = Photo::model()->findAllByAttributes(['is_available'=>1, 'is_show' => 1, 'is_sale'=>1], ['limit' => 10]);
        $posts = BlogPost::model()->findAllByAttributes(['is_show' => 1], ['limit' => 1, 'order' => 'date_create DESC']);
        $this->render('index', [
            'newPhotos' => $newPhotos,
            'hitPhotos' => $hitPhotos,
            'salePhotos' => $salePhotos,
            'posts' => $posts
        ]);
    }

    public function actionCatalog($type){
        $this->catalog($type);
    }

    public function actionCatalogWithPage($type, $page){
        $this->catalog($type, $page);
    }

    public function catalog($type, $page = 1){
        $this->pageTitle=Yii::app()->name .' - '. Yii::app()->params["categories"][$type];

        if(!empty($_POST)) {
            $this->actionAddToCart();

            if(isset($_POST['page']))
                $this->redirect($_POST['page']);
        }
        if(isset($_GET['order']))
            $this->setOrder($_GET['order']);
        $params = $_GET;
        $params['category'] = $type;
        $params['order'] = $this->getOrder();
        $params['page'] = $page;

        if (isset($_GET['subcategory']) && !isset(Yii::app()->params['subcategories'][$type][$_GET['subcategory']]))
            unset($params['subcategory']);
        $model = Photo::model()->getPhotos($params);
        $modelHits = Photo::model()->findAllByAttributes(['is_available'=>1, 'is_show' => 1, 'is_hit'=>1], ['limit' => 4]);
        $criteria = Photo::model()->getPhotosCriteria($params);
        $count = Photo::model()->count($criteria);
        $pagination = new CPagination($count);
        $pagination->pageSize = Yii::app()->params['photoPerPage'];
        $pagination->applyLimit($criteria);
        $pagination->currentPage = $page - 1;
        $pagination->route = "/$type";
        $pagination->params = array('page'=>$page);

        if(isset($_GET['order']))
            $this->renderPartial('catalog',array(
                'model'=>$model,
                'type'=>$type,
                'pagination' => $pagination,
                'modelHits' => $modelHits
            ));
        else
            $this->render('catalog',array(
                'model'=>$model,
                'type'=>$type,
                'pagination' => $pagination,
                'modelHits' => $modelHits
            ));
    }

    public function actionAddToCart(){
        $cart = null;
        if(Yii::app()->user->isGuest && !empty(Yii::app()->session['cartId']))
            $cart = Cart::model()->findByPk(Yii::app()->session['cartId']);
        elseif (!Yii::app()->user->isGuest)
            $cart = Cart::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
        $cartItem = '';
        if($cart) {
            $cartItem = $cart->findAndAddCartItem($_POST);
        } else {
            $cart = new Cart;
            if(!Yii::app()->user->isGuest)
                $cart->user_id = Yii::app()->user->id;
            if($cart->save()) {
                if(Yii::app()->user->isGuest)
                    Yii::app()->session['cartId'] = $cart->id;
                $cartItem = $cart->addCartItem($_POST);
            }
        }
        return $cartItem;
    }

    public function actionModel($type, $id){

        if(!empty($_POST)) {
            $cartItem = $this->actionAddToCart();
            if($_POST['product_action'] == 'buy' && $cartItem)
                $this->redirect('/order');
        }
        $model = Photo::model()->findByAttributes(array('category'=>$type, 'article'=>$id));
        $this->pageTitle=$model->title.' арт. '.$model->article.' - '.Yii::app()->name;

        $newPhotos = Photo::model()->findAllByAttributes(['is_available'=>1, 'is_show' => 1, 'is_new'=>1], ['limit' => 10]);
        $this->render('model',array(
            'model'=>$model,
            'type'=>$type,
            'newPhotos' => $newPhotos,
        ));
    }

    public function actionError() {
        if($error=Yii::app()->errorHandler->error) {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    public function getOrder(){
        if(!isset(Yii::app()->session['catalog_order'])) {
            if(Cart::isWholesale())
                Yii::app()->session['catalog_order'] = 'по артиклю';
            else
                Yii::app()->session['catalog_order'] = 'по популярности';
        }
        return Yii::app()->session['catalog_order'];
    }

    public function setOrder($order){
        Yii::app()->session['catalog_order'] = $order;
    }

    public function setSessionMultiParam($sessionName, $param){
        if ($param == 'все') {
            Yii::app()->session[$sessionName] = 'все';
        } else {
            if(empty(Yii::app()->session[$sessionName]) || Yii::app()->session[$sessionName] == 'все') {
                Yii::app()->session[$sessionName] = $param;
            } else {
                if (strpos(Yii::app()->session[$sessionName], $param) !== false) {
                    if (strpos(Yii::app()->session[$sessionName], ',') !== false) {
                        Yii::app()->session[$sessionName] = trim(str_replace(',,', ',', str_replace($param, '', Yii::app()->session[$sessionName])), ',');
                    } else {
                        Yii::app()->session[$sessionName] = 'все';
                    }
                } else {
                    Yii::app()->session[$sessionName] .= ','.$param;
                }
            }
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
        $this->pageTitle = Yii::app()->name.' - '.'Личный кабинет';
        $model = User::model()->getUser();
        if (isset($_POST["data_type"])) {
            $model->scenario = $_POST["data_type"];
        } else {
            $model->scenario = 'customer';
        }
        if(isset($_POST['User'])) {
            $model->attributes=$_POST['User'];
            if($model->validate() && $model->save()) {
                Yii::app()->user->setFlash( 'success', "Данные сохранены.");
            }
        }
        $this->render('user/customer', array(
            'model' => $model,
        ));
    }

    public function actionCart(){
        if(!empty(Yii::app()->cart->currentCart->cartItems)) {
            $this->pageTitle = Yii::app()->name . ' - ' . 'Корзина';
            $this->render('cart/cart', array(
                'model' => Yii::app()->cart->currentCart,
                'path' => ''
            ));
        } else {
            $this->redirect("/");
        }
    }

    public function actionOrder(){
        $this->pageTitle = Yii::app()->name.' - '.'Заказ';
        if(!empty(Yii::app()->cart->currentCart->cartItems) && Yii::app()->cart->currentCart->isReadyToOrder()) {
            if(Yii::app()->params['debugMode']){
                Yii::log('Переход к оформлению заказа, IP:', 'warning');
                Yii::log($_SERVER['REMOTE_ADDR'], 'warning');
            }
            if (!Yii::app()->user->isGuest) {
                $user = User::model()->getUser();
                $user->scenario = 'userOrder';
                if ($user->blocked)
                    $user->payment = 'online';
            } else {
                $user = new User();
                $user->scenario = 'orderWithRegistration';
            }
            if (isset($_POST['User'])) {
                if(Yii::app()->params['debugMode']){
                    Yii::log('Отправить заказ, IP:', 'warning');
                    Yii::log($_SERVER['REMOTE_ADDR'], 'warning');
                    Yii::log(CVarDumper::dumpAsString($_POST), 'warning');
                }
                $user->saveUserData($_POST['User']);
                $errors = $user->getErrors();
                if(empty($errors)) {
                    echo json_encode($this->processingOrder($user));
                    Yii::app()->end();
                } else {
                    if(Yii::app()->params['debugMode']){
                        Yii::log('Ошибки при оформлении, IP:', 'warning');
                        Yii::log($_SERVER['REMOTE_ADDR'], 'warning');
                        Yii::log(CVarDumper::dumpAsString($errors), 'warning');
                    }
                    $this->renderPartial('order/_order_form', array('user' => $user, 'model' => Yii::app()->cart->currentCart));
                    Yii::app()->end();
                }
            } else {
                $user->tc = 'pec';
            }
            $this->render('order/order', array(
                'user' => $user,
                'cart' => Yii::app()->cart->currentCart
            ));
        }  else
            $this->redirect('/cart');
    }

    public function processingOrder($orderData){
        $order = $this->createOrder($orderData);
        $res['status'] = $order->status;
        if($res['status'] == 'payment'){
            $robokassa = new Robokassa();
            $res['robokassaUrl'] = $robokassa->getPaymentFormUrlWithOrderIdAndSum($order->id, $order->total_with_commission?$order->total_with_commission:$order->total);
        }
        $res['orderId'] = $order->id;
        if(Yii::app()->params['debugMode']) {
            Yii::log('Заказ успешно создан, IP:', 'warning');
            Yii::log($_SERVER['REMOTE_ADDR'], 'warning');
            Yii::log('Id корзины:', 'warning');
            Yii::log(Yii::app()->cart->currentCart->id, 'warning');
        }
        $this->sentOrderMail($order);
        $this->sentOrderMailToAdmin($order);
        OrderHistory::refreshOrderNewSum();

        return $res;
    }

    public function sentOrderMail($order){
        $this->layout = '//layouts/mail';
        $mail = new Mail();
        $mail->from = Yii::app()->params['emailOrder'];
        $mail->to = $order->email;
        $mail->subject = "Заказ № ". $order->id ." оформлен в интернет-магазине ".Yii::app()->params['domain'];
        $mail->message = $this->render('/site/mail/order',array('order'=>$order),true);
        $mail->send();
    }

    public function sentOrderMailToAdmin($order){
        $this->layout = '//layouts/mail';
        $mail = new Mail();
        $mail->to = Yii::app()->params['emailTo'];
        if(Cart::isWholesale())
            $mail->subject = "Новый заказ ОПТ № ". $order->id;
        else
            $mail->subject = "Новый заказ розница № ". $order->id;
        $mail->message = $this->render('/site/mail/order_to_admin',array('order'=>$order),true);
        $mail->send();
    }

    public function  createOrder($user){
        $order = new OrderHistory();
        $order->id = floatval(Yii::app()->dateFormatter->format('yyMMddHHmmss', time()));
        $order->user_id = $user->id;
        $cart = Yii::app()->cart->currentCart;
        if(!Cart::isWholesale()){
            $order->shipping_method = $_POST['User']['shipping_method'];
            $order->payment_method = $_POST['User']['payment'];
        }
        $order->phone = $user->phone;
        $order->email = $user->email;

        $order->shipping = ($order->shipping_method == 'russian_post') ? $cart->shipping : 0;
        $order->subtotal = $cart->subtotal;
        $order->sale = $cart->sale;
        $order->coupon_id = $cart->coupon_id;
        $order->coupon_sale = $cart->coupon_sale;
        $order->total = $cart->subtotal - $cart->sale - $cart->coupon_sale + $order->shipping;
        $order->addressee = trim($user->surname) . " " .trim($user->name) . " " . trim($user->middlename) ;
        $order->postcode = $user->postcode;
        $order->address = $user->address;
        $order->comment = $user->comment;
        if(!Cart::isWholesale()) {
            if ($_POST['User']['payment'] == 'cod')
                $order->status = 'in_progress';
            elseif ($_POST['User']['payment'] == 'online') {
                $order->status = 'payment';
                $rk = new Robokassa();
                $order->total_with_commission = $rk->getSumWithCommission($order->total);
            }
        } else {
            $order->is_wholesale = 1;
            $order->status = 'in_progress';
        }
        if ($order->save()){
            if($order->coupon_id && !$order->coupon->is_reusable)
                $order->coupon->isUsed();
            $cart->deleteCoupon();
            foreach ($cart->cartItems as $item) {
                $item->order_id = $order->id;
                $item->cart_id = null;
                $item->wholesale_price = $item->photo->wholesale_price;
                if($item->photo->is_sale) {
                    $item->new_price = $item->photo->price;
                    $item->price = $item->photo->old_price;
                } elseif($order->coupon_id) {
                    $item->new_price = $order->coupon->getSumWithSaleInRub($item->photo->price, $item->photo->category);
                    $item->price = $item->photo->price;
                } else {
                    $item->price = $item->photo->price;
                }
                $item->save();
            }
            if(!$cart->is_active) $cart->delete();
        }
        return $order;
    }

    public function actionHistory(){
        $this->pageTitle = Yii::app()->name.' - '.'Мои заказы';
        $history = OrderHistory::model()->findAllByAttributes(['user_id'=>Yii::app()->user->id], ['order'=>'id DESC']);
        $this->render('user/history',array(
            'history'=>$history,
        ));
    }

    public function actionHistoryItem($id){
        $this->pageTitle = Yii::app()->name.' - '.'Заказ №'.$id;
        $order = OrderHistory::model()->findByPk($id);
        if($order->user_id == Yii::app()->user->id) {
            $this->render('user/history_item', array(
                'order' => $order,
            ));
        } else {
            throw new CHttpException(404,'К сожалению, страница не найдена.');
        }
    }

    public function actionUnsubscribe(){
        $this->pageTitle = Yii::app()->name.' - '.'Отписаться от новостей';
        if(!empty($_GET) && isset($_GET['id']) && isset($_GET['email']) && isset($_GET['hash'])){
            $user = User::model()->findByPk($_GET['id']);
            $hash = crypt($user->id, $user->name);
            if($user->email == $_GET['email'] && $hash == $_GET['hash']) {
                if ($user->unsubscribe())
                    $this->render('unsubscribe');
                else
                    throw new CHttpException(404,'Попробуйте повторить запрос через какое-то время.');
            } else {
                throw new CHttpException(404,'К сожалению, страница не найдена.');
            }
        } else {
            throw new CHttpException(404,'К сожалению, страница не найдена.');
        }
    }

    public function actionReviews(){
        $this->reviews();
    }

    public function actionReviewsWithPage($page){
        $this->reviews($page);
    }

    public function reviews($page = 1){
        $this->pageTitle = Yii::app()->name.' - '.'Отзывы';
        if(isset($_POST['Comment'])) {
            $comment = new Comment;
            $comment->attributes=$_POST['Comment'];
            $comment->type='reviews';
            if(!Yii::app()->user->isGuest)
                $comment->user_id=Yii::app()->user->id;
            if ($comment->save()) {
                Yii::app()->userForMail->setUserByUsername('admin');
                $this->sendReviewMailToAdmin($comment);
                $this->layout='//layouts/column1';
            }
        }
        $this->render('reviews/reviews', [
            'userPostcode' => User::getPostcode(),
            'reviews' => $this->getActiveReviewsOnPage($page),
            'newReview' => new Comment('create'),
            'pagination' => $this->getPagerOnPage($page)
        ]);
    }

    private function getActiveReviewsOnPage($page){

        $comments = Comment::model()->findAll($this->getReviewsCriteriaOnPage($page));
        return $comments;
    }

    private function getPagerOnPage($page){

        $criteria = $this->getReviewsCriteriaOnPage($page);
        $count = Comment::model()->count($criteria);
        $pagination = new CPagination($count);
        $pagination->pageSize = Yii::app()->params['reviewsPerPage'];
        $pagination->applyLimit($criteria);
        $pagination->currentPage = $page - 1;
        $pagination->route = '/reviews';
        return $pagination;
    }

    private function getReviewsCriteriaOnPage($page){
        $criteria = new CDbCriteria();
        $criteria->compare('is_show', 1);
        $criteria->compare('type', 'reviews');
        $criteria->limit = Yii::app()->params['reviewsPerPage'];
        $criteria->offset = $criteria->limit * ($page - 1);
        $criteria->order = "date_create DESC";
        return $criteria;
    }

    public function sendReviewMailToAdmin($comment){
        $this->layout = '//layouts/mail';
        $mail = new Mail();
        $mail->to = Yii::app()->params['emailTo'];
        $mail->subject = "Новый отзыв на ".Yii::app()->params['domain'];
        $mail->message = $this->render('mail/review',array('comment'=>$comment),true);
        $mail->send();
    }

    public function actionAbout($action){
        if ($action == 'offer'){
            $this->pageTitle = Yii::app()->name.' - '.'Публичная оферта';
        } elseif ($action == 'shipping'){
            $this->pageTitle = Yii::app()->name.' - '.'Доставка';
        } elseif ($action == 'contact'){
            $this->pageTitle = Yii::app()->name.' - '.'Контакты';
        } elseif ($action == 'wholesale'){
            $this->pageTitle = Yii::app()->name.' - '.'Оптом';
        } elseif ($action == 'order'){
            $this->pageTitle = Yii::app()->name.' - '.'Как сделать заказ';
        } elseif ($action == 'payment'){
            $this->pageTitle = Yii::app()->name.' - '.'Оплата';
        } elseif ($action == 'refund'){
            $this->pageTitle = Yii::app()->name.' - '.'Возврат товара';
        } elseif ($action == 'sizes'){
            $this->pageTitle = Yii::app()->name.' - '.'Как выбрать размер';
        } else {
            $this->redirect(array('site/index'));
        }
        $this->render("about/$action");
    }

}