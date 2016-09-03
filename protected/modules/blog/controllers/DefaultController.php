<?php

class DefaultController extends Controller {

	public function actionIndex() {
        $this->pageTitle=Yii::app()->name .' - Статьи';

        $criteria = new CDbCriteria();
        $criteria->compare('is_show', 1);
        if (isset($_GET['tag'])) {
            $criteria->addSearchCondition('tags', $_GET['tag']);
        }
        $posts = BlogPost::model()->findAll($criteria);
		$this->render('index', ['posts' => $posts]);
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