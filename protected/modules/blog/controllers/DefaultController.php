<?php

class DefaultController extends Controller {

	public function actionIndex() {
        $this->index();
	}

    public function actionIndexWithPage($page) {
        $this->index($page);
    }

    private function index($page = 1) {
        $this->pageTitle=Yii::app()->name .' - Статьи';

        $criteria = new CDbCriteria();
        $criteria->compare('is_show', 1);

        if (isset($_GET['tag'])) {
            $criteria->addSearchCondition('tags', $_GET['tag']);
        }
        $count = BlogPost::model()->count($criteria);
        $criteria->limit = Yii::app()->controller->module->pageSize;
        $criteria->offset = $criteria->limit * ($page - 1);
        $criteria->order = "date_create DESC";
        $posts = BlogPost::model()->findAll($criteria);

        $pagination = new CPagination($count);
        $pagination->pageSize = Yii::app()->controller->module->pageSize;
        $pagination->applyLimit($criteria);
        $pagination->currentPage = $page - 1;
        $pagination->route = '/blog';
        $this->render('index', [
            'posts' => $posts,
            'pagination' => $pagination
        ]);
    }

    public function actionPost($url) {
        $post = BlogPost::model()->findByAttributes(['is_show' => true, 'url' => $url]);

        $this->pageTitle=Yii::app()->name .' - '. $post->title;
        $this->render('post', ['post' => $post]);
    }

    public function actionLike($id) {
        $post = BlogPost::model()->findByPk($id);
        $post->likeCount ++;
        echo $post->save();
        Yii::app()->end();
    }

    public function actionUnlike($id) {
        $post = BlogPost::model()->findByPk($id);
        $post->likeCount --;
        echo $post->save();
        Yii::app()->end();
    }
}