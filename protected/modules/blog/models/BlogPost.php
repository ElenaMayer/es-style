<?php

/**
 * This is the model class for table "blog_post".
 *
 * The followings are the available columns in table 'blog_post':
 * @property integer $id
 * @property string $url
 * @property string $title
 * @property string $img
 * @property string $description
 * @property string $content
 * @property string $tags
 * @property integer $likeCount
 * @property integer $is_show
 * @property string $date_create
 */
class BlogPost extends CActiveRecord {

    public $image;
    public $imageRatio;
    public $imageWidth = 840;
    public $imageMediumWidth = 730;
    public $imageSmallWidth = 310;
    public $tagsArr;
    public $comments;
	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'blog_post';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('likeCount, is_show', 'numerical', 'integerOnly'=>true),
			array('url, title, img, tags', 'length', 'max'=>255),
			array('description, content, date_create', 'safe'),
			array('id, url, title, description, content, tags, likeCount, is_show, date_create', 'safe', 'on'=>'search'),
            array('image', 'file', 'types'=>'jpg, gif, png', 'allowEmpty'=>true,'on'=>'insert,update'),
            array('date_create','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
        return array(
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'id' => 'ID',
			'url' => 'URL',
			'title' => 'Заголовок',
            'img' => 'Картинка',
            'image' => 'Картинка',
			'description' => 'Описание',
			'content' => 'Контент',
			'tags' => 'Тэги',
			'likeCount' => 'Количество лайков',
			'is_show' => 'Отображать',
			'date_create' => 'Дата создания',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search() {
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('tags',$this->tags,true);
		$criteria->compare('likeCount',$this->likeCount);
		$criteria->compare('is_show',$this->is_show);
		$criteria->compare('date_create',$this->date_create,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'date_create DESC',
            )
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BlogPost the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

    protected function beforeSave(){
        if(!parent::beforeSave())
            return false;
        $image=CUploadedFile::getInstance($this,'image');
        if(($this->scenario=='insert' || $this->scenario=='update') && $image){
            $this->deleteImage();
            $this->img=$image->name;
            $image->saveAs($this->getOriginImagePath().DIRECTORY_SEPARATOR.$image->name);
            $this->prepareImage();
        }
        return true;
    }

    protected function beforeDelete(){
        if(!parent::beforeDelete())
            return false;
        $this->deleteImage();
        return true;
    }

    protected function afterFind(){
        parent::afterFind();
        $this->tagsArr = explode(",", $this->tags);
        $this->comments = Comment::model()->findAllByAttributes(['type' => 'blog_post', 'item_id' => $this->id]);
    }

    private function getOriginImagePath(){
        return Yii::getPathOfAlias('data.blog.main.origin');
    }

    private function getMediumImagePath(){
        return Yii::getPathOfAlias('data.blog.main.medium');
    }

    private function getSmallImagePath(){
        return Yii::getPathOfAlias('data.blog.main.small');
    }

    public function deleteImage(){
        $imagePath=$this->getOriginImagePath().DIRECTORY_SEPARATOR.$this->img;
        if(is_file($imagePath))
            unlink($imagePath);
        $imageMediumPath=$this->getMediumImagePath().DIRECTORY_SEPARATOR.$this->img;
        if(is_file($imageMediumPath))
            unlink($imageMediumPath);
        $imageSmallPath=$this->getSmallImagePath().DIRECTORY_SEPARATOR.$this->img;
        if(is_file($imageSmallPath))
            unlink($imageSmallPath);
    }

    public function prepareImage(){
        Yii::app()->image
            ->load($this->getOriginImagePath().DIRECTORY_SEPARATOR.$this->img)
            ->resize($this->imageWidth, false, true)
            ->save($this->getOriginImagePath().DIRECTORY_SEPARATOR.$this->img)
            ->resize($this->imageMediumWidth, false, true)
            ->save($this->getMediumImagePath().DIRECTORY_SEPARATOR.$this->img)
            ->resize($this->imageSmallWidth, false, true)
            ->save($this->getSmallImagePath().DIRECTORY_SEPARATOR.$this->img);
    }

    public function getImageUrl(){
        return Yii::app()->assetManager->publish($this->getOriginImagePath().DIRECTORY_SEPARATOR.$this->img);
    }

    public function getPreviousPostUrl(){
        return false;
    }

    public function getNextPostUrl(){
        return false;
    }

    public function getActiveCommentCount(){
        $criteria = new CDbCriteria();
        $criteria->compare('type', 'blog_post');
        $criteria->compare('is_show', 1);
        $criteria->compare('item_id', $this->id);
        return Comment::model()->count($criteria);
    }
}
