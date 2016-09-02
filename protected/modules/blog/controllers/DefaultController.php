<?php

class DefaultController extends Controller {

	public function actionIndex() {
        $posts = BlogPost::model()->findAllByAttributes(['is_show' => true]);
		$this->render('index', ['posts' => $posts]);
	}

    public function actionPost($url) {
        $post = BlogPost::model()->findByAttributes(['is_show' => true, 'url' => $url]);
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