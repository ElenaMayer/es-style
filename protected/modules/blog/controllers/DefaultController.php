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
        $comments = Comment::model()->findAllByAttributes(['is_show' => true, 'type' => 'blog_post', 'item_id' => $post->id]);
        $comment = new Comment;
        if (!Yii::app()->user->isGuest)
            $comment->name = Yii::app()->user->name;
        $this->pageTitle=Yii::app()->name .' - '. $post->title;
        if(isset($_POST['Comment'])) {
            $comment = new Comment;
            $comment->attributes=$_POST['Comment'];
            $comment->type='blog_post';
            $comment->name = ucfirst($comment->name);
            $comment->item_id=$post->id;
            if (!Yii::app()->user->isGuest)
                $comment->user_id=Yii::app()->user->id;
            if ($comment->save())
                $this->sendCommentMailToAdmin($post, $comment);
            $comments = Comment::model()->findAllByAttributes(['is_show' => true, 'type' => 'blog_post', 'item_id' => $post->id]);
            $this->renderPartial('comments', [
                'post' => $post,
                'comments' => $comments,
                'newComment' => $comment
            ]);
        } else {
            $this->render('post', [
                'post' => $post,
                'comments' => $comments,
                'newComment' => $comment
            ]);
        }
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

    public function sendCommentMailToAdmin($post, $comment){
        $this->layout = '//layouts/mail';
        $mail = new Mail();
        $mail->to = Yii::app()->params['emailTo'];
        $mail->subject = "Новый комментарий к статье '". $post->title . "'";
        $mail->message = $this->render('mail_comment',array('post'=>$post, 'comment'=>$comment),true);
        $mail->send();
    }
}