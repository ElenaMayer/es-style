<?php

class BlogPostController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/admin_column';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
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
                'actions'=>array('create','update','index','delete','setIsShow','getTagList'),
                'users'=>array('admin'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new BlogPost;
        $model->likeCount = rand(2, 12);

		if(isset($_POST['BlogPost']))
		{
			$model->attributes=$_POST['BlogPost'];
            $this->addTagsFromString($_POST['BlogPost']['tags']);
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['BlogPost']))
		{
            $this->updateTagsFromString($model->tags, $_POST['BlogPost']['tags']);
			$model->attributes=$_POST['BlogPost'];
            $model->image = $_POST['BlogPost']['image'];
			if($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
        $this->removeTags(explode(',',$model->tags));

        $model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        $model=new BlogPost('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['BlogPost']))
            $model->attributes=$_GET['BlogPost'];

        $this->render('index',array(
            'model'=>$model,
        ));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return BlogPost the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=BlogPost::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param BlogPost $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='blog-post-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    //ajax method
    public function actionSetIsShow($id){
        $post = BlogPost::model()->findByPk($id);
        if(empty($post->is_show))
            $post->is_show = 1;
        else
            $post->is_show = 0;
        echo $post->save();
        Yii::app()->end();
    }

    //ajax method
    public function actionGetTagList(){
        $tags = [];
        $criteria = new CDbCriteria();
        $criteria->select = 'name';
        $criteria->order = 'frequency  DESC';
        if (isset($_GET['term']))
            $criteria->addSearchCondition('name', $_GET['term']);
        $model = BlogTag::model()->findAll($criteria);
        foreach ($model as $item) {
            array_push($tags, $item->name);
        }
        echo CJSON::encode($tags);
        Yii::app()->end();
    }

    public function addTagsFromString($tagsString) {
        $tags = explode(',',$tagsString);
        $this->addTags($tags);
    }

    public function addTags($tags){
        foreach ($tags as $tag){
            $tagModel = BlogTag::model()->findByAttributes(['name'=>trim($tag)]);
            if(empty($tagModel)) {
                $tagModel = new BlogTag;
                $tagModel->name = trim($tag);
                $tagModel->frequency = 1;
            } else {
                $tagModel->frequency ++;
            }
            $tagModel->save();
        }
    }

    public function updateTagsFromString($oldTagsString, $newTagsString) {
        $oldTags = explode(',',$oldTagsString);
        $newTags = explode(',',$newTagsString);
        $tagsToAdd = array_diff($newTags, $oldTags);
        $tagsToRemove = array_diff($oldTags, $newTags);
        $this->addTags($tagsToAdd);
        $this->removeTags($tagsToRemove);
    }

    public function removeTags($tags){
        foreach ($tags as $tag){
            $tagModel = BlogTag::model()->findByAttributes(['name'=>trim($tag)]);
            $tagModel->frequency --;
            $tagModel->save();
        }
    }
}
