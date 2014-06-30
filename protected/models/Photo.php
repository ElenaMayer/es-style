<?php

/**
 * This is the model class for table "photo".
 *
 * The followings are the available columns in table 'photo':
 * @property integer $id
 * @property string $img
 * @property string $category
 * @property integer $article
 * @property string $price
 * @property string $title
 * @property string $description
 * @property integer $is_show
 * @property integer $is_new
 * @property string $date_create
 */
class Photo extends CActiveRecord
{
    public $image;
    public $imageHeight = 600;
    public $imageWidth = 450;
    public $previewHeight = 300;
    public $previewWidth = 225;
    public $is_image_change = false;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'photo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('price, article, is_show, is_new', 'numerical', 'integerOnly'=>true),
			array('img, category, title', 'length', 'max'=>255),
			array('description, date_create', 'safe'),
			array('id, category, article, price, title, description, is_show, is_new, date_create', 'safe', 'on'=>'search'),
            array('date_create','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'),
            array('image', 'file', 'types'=>'jpg, gif, png', 'allowEmpty'=>true,'on'=>'insert,update'),
            array('category, article, price', 'required'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'img' => 'Фото',
            'image' => 'Фото',
			'category' => 'Категория',
			'article' => 'Артикул',
			'price' => 'Цена',
			'title' => 'Название',
			'description' => 'Описание',
            'is_show' => 'Отображать',
            'is_new' => 'Новинка',
			'date_create' => 'Дата добавления',
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
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('img',$this->img,true);
		$criteria->compare('category',$this->category);
		$criteria->compare('article',$this->article);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('title',$this->title,true);
        $criteria->compare('is_show',$this->is_show);
        $criteria->compare('is_new',$this->is_new);
		$criteria->compare('date_create',$this->date_create,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>'10',
            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Photo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    protected function beforeSave(){
        if(!parent::beforeSave())
            return false;
        if(($this->scenario=='insert' || $this->scenario=='update') && ($image=CUploadedFile::getInstance($this,'image'))){
            $this->deleteImage();
            $this->img=$image->name;
            $image->saveAs(Yii::getPathOfAlias('root.protected.data.photo').DIRECTORY_SEPARATOR.$image->name);
            $this->prepareImage();
        } elseif($this->is_image_change){
            $this->deletePreview();
            $this->createPreview();
        }
        return true;
    }

    protected function beforeDelete(){
        if(!parent::beforeDelete())
            return false;
        $this->deleteImage();
        return true;
    }

    public function deleteImage(){
        $imageOrigPath=Yii::getPathOfAlias('root.protected.data.photo').DIRECTORY_SEPARATOR.$this->img;
        if(is_file($imageOrigPath))
            unlink($imageOrigPath);
        $imagePath=Yii::getPathOfAlias('data.photo').DIRECTORY_SEPARATOR.$this->img;
        if(is_file($imagePath))
            unlink($imagePath);
        $this->deletePreview();
    }

    private function deletePreview(){
        $imagePreviewPath=Yii::getPathOfAlias('data.photo.preview').DIRECTORY_SEPARATOR.'p_'.$this->img;
        if(is_file($imagePreviewPath))
            unlink($imagePreviewPath);
    }

    public function prepareImage(){
        $this->createPreview();
        Yii::app()->image
            ->load(Yii::getPathOfAlias('root.protected.data.photo').DIRECTORY_SEPARATOR.$this->img)
            ->resize($this->imageWidth, $this->imageHeight)
            ->watermark($this->getWatermarkPath(), 0, 0)
            ->save(Yii::getPathOfAlias('data.photo').DIRECTORY_SEPARATOR.$this->img);
    }

    private function createPreview(){
        Yii::app()->image
            ->load(Yii::getPathOfAlias('root.protected.data.photo').DIRECTORY_SEPARATOR.$this->img)
            ->resize($this->previewWidth, $this->previewHeight);
        if ($this->is_new)
            Yii::app()->image->watermark($this->getWatermarkNewPath(), 0, 0);
        Yii::app()->image->save(Yii::getPathOfAlias('data.photo.preview').DIRECTORY_SEPARATOR.'p_'.$this->img);
    }

    public function getImageUrl()
    {
        return Yii::app()->getBaseUrl().'/data/photo/'.$this->img;
    }

    public function getPreviewUrl()
    {
        return Yii::app()->getBaseUrl().'/data/photo/preview/p_'.$this->img;
    }

    public static function getWatermarkPath()
    {
        return Yii::getPathOfAlias('root.protected.data').DIRECTORY_SEPARATOR.'watermark.png';
    }

    public static function getWatermarkNewPath()
    {
        return Yii::getPathOfAlias('root.protected.data').DIRECTORY_SEPARATOR.'watermark_new.png';
    }

    public function getPhotos($category, $order_str){
        switch($order_str){
            case 'по новинкам':
                $order = 'is_new  DESC, date_create  DESC';
                break;
            case 'по артиклю':
                $order = 'article';
                break;
            case 'по возрастанию цены':
                $order = 'price';
                break;
            case 'по убыванию цены':
                $order = 'price DESC';
                break;
            case 'по скидке':
//                @todo
                $order = 'date_create';
                break;
        }
        return $this->findAllByAttributes(
            array('is_show' => 1, 'category' => $category),
            array('order'=>$order)
        );
    }
}
