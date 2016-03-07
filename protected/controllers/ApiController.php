<?php
/**
 * Created by PhpStorm.
 * User: EZcool
 * Date: 07.03.2016
 * Time: 18:48
 */

class ApiController extends Controller
{

    public function actionGetCatalogForType(){
        if(isset($_GET['type']) && !empty($_GET['type'])){
            $type = $_GET['type'];
            $order = isset($_GET['order']) ? $_GET['order'] : 'по артиклю';
            $size = isset($_GET['size']) ? $_GET['size'] : 'все';
            $catalog = Photo::model()->getPhotos($type, $order, $size);
            $arrayCatalog = [];
            foreach ($catalog as $item) {
                array_push($arrayCatalog, $item->getAttributes());
            }
            echo json_encode($arrayCatalog);
        } else
            echo null;
    }

    public function actionGetImagePreviewURLByModelId(){
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $model = Photo::model()->findByPk($_GET['id']);
            $imagePreviewURL = $model->getFullPreviewUrl();
            echo json_encode($imagePreviewURL);
        } else
            echo null;
    }

    public function actionGetModelByModelId(){
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $model = Photo::model()->findByPk($_GET['id']);
            echo json_encode($model->getAttributes());
        } else
            echo null;
    }

    public function actionGetImageURLByModelId(){
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $model = Photo::model()->findByPk($_GET['id']);
            $imageURL = $model->getFullImageUrl();
            echo json_encode($imageURL);
        } else
            echo null;
    }

    public function actionGetImageOriginalURLByModelId(){
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $model = Photo::model()->findByPk($_GET['id']);
            $imageOriginalURL = $model->getFullOriginalUrl();
            echo json_encode($imageOriginalURL);
        } else
            echo null;
    }

//    public function actionAuthorization(){
//        if(isset($_GET['email']) && !empty($_GET['email']) && isset($_GET['password']) && !empty($_GET['password'])){
//            $user = User::model()->findByAttributes(['email' => $_GET['email']]);
//            $user->scenario = 'login';
//            $user->email = $_GET['email'];
//            $user->password = $_GET['password'];
//            if ($user->validate()) {
//                if (($_GET['cart']) && !empty($_GET['cart'])) {
//
//                    $cart = Cart::model()->findByAttributes(['user_id' => $_GET['id']]);
//                }
//            } else {
//                return json_encode($user->getErrors());
//            }
//
//
//
//            $user = User::model()->findByAttributes(['email' => $_GET['email']]);
//            print_r( $user->getAttributes());
//            return json_encode($user->getAttributes());
//        } else
//            return null;
//    }
}