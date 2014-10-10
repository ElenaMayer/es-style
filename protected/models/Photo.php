<?php

/**
 * This is the model class for table "photo".
 *
 * The followings are the available columns in table 'photo':
 * @property integer $id
 * @property string $img
 * @property integer $article
 * @property string $title
 * @property string $description
 * @property integer $is_show
 * @property string $date_create
 * @property integer $is_new
 * @property integer $price
 * @property string $category
 * @property integer $is_sale
 * @property string $sale
 * @property integer $old_price
 * @property integer $new_price
 * @property integer $size
 * @property string $uni_size
 * @property integer $size_42
 * @property integer $size_44
 * @property integer $size_46
 * @property integer $size_48
 * @property integer $size_50
 * @property integer $size_52
 * @property integer $size_54
 */
class Photo extends CActiveRecord
{
    public $image;
    public $imageHeight = 480;
    public $imageWidth = 360;
    public $originalHeight = 1600;
    public $originalWidth = 1200;
    public $previewHeight = 300;
    public $previewWidth = 225;
    public $is_show = true;
    public $is_new = true;
    public $size = true;

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
            array('article, is_show, is_new, price, is_sale, old_price, new_price, size, size_40, size_42, size_44, size_46, size_48, size_50, size_52, size_54', 'numerical', 'integerOnly'=>true),
            array('img, title, category, sale, uni_size', 'length', 'max'=>255),
            array('description, date_create', 'safe'),
            array('article, is_show, is_new, price, category, is_sale', 'safe', 'on'=>'search'),
            array('date_create','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'),
            array('image', 'file', 'types'=>'jpg, gif, png', 'allowEmpty'=>true,'on'=>'insert,update'),
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
            'is_sale' => 'Скидка',
            'sale' => 'Процент',
            'old_price' => 'Старая цена',
            'new_price' => 'Новая цена',
            'size' => 'Размер',
            'uni_size' => 'Размеры с/по',
            'size_40' => '40',
            'size_42' => '42',
            'size_44' => '44',
            'size_46' => '46',
            'size_48' => '48',
            'size_50' => '50',
            'size_52' => '52',
            'size_54' => '54',
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
		$criteria->compare('category',$this->category);
		$criteria->compare('article',$this->article);
		$criteria->compare('price',$this->price,true);
        $criteria->compare('is_show',$this->is_show);
        $criteria->compare('is_new',$this->is_new);
        $criteria->compare('is_sale',$this->is_sale);

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
        if($this->is_sale)
            $this->sale = $this->getSale();
        if(($this->scenario=='insert' || $this->scenario=='update') && ($image=CUploadedFile::getInstance($this,'image'))){
            $this->deleteImage();
            $this->img=$image->name;
            $image->saveAs(Yii::getPathOfAlias('data.photo.original').DIRECTORY_SEPARATOR.$image->name);
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

    public function deleteImage(){
        $imageOrigPath=Yii::getPathOfAlias('data.photo.original').DIRECTORY_SEPARATOR.$this->img;
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
            ->load(Yii::getPathOfAlias('data.photo.original').DIRECTORY_SEPARATOR.$this->img)
            ->resize($this->originalWidth, $this->originalHeight)
            ->save(Yii::getPathOfAlias('data.photo.original').DIRECTORY_SEPARATOR.$this->img)
            ->resize($this->imageWidth, $this->imageHeight)
            //->watermark($this->getWatermarkPath(), 0, 0)
            ->save(Yii::getPathOfAlias('data.photo').DIRECTORY_SEPARATOR.$this->img);
    }

    private function createPreview(){
        Yii::app()->image
            ->load(Yii::getPathOfAlias('data.photo.original').DIRECTORY_SEPARATOR.$this->img)
            ->resize($this->previewWidth, $this->previewHeight);
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

    public function getOriginalUrl()
    {
        return Yii::app()->getBaseUrl().'/data/photo/original/'.$this->img;
    }

    public static function getWatermarkPath()
    {
        return Yii::getPathOfAlias('root.protected.data').DIRECTORY_SEPARATOR.'watermark.png';
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
            case 'по скидкам':
                $order = 'sale DESC';
                break;
        }
        return $this->findAllByAttributes(
            array('is_show' => 1, 'category' => $category),
            array('order'=>$order)
        );
    }

    public function getSale(){
        return 100-$this->new_price*100/$this->old_price;
    }

    public function getOrderList($type){
        $res = array(
            array('label'=>'по артиклю'),
            array('label'=>'по возрастанию цены'),
            array('label'=>'по убыванию цены'),
        );
        $new = $this->findAllByAttributes(
            array('is_show' => 1, 'category' => $type, 'is_new' => 1)
        );
        if(!empty($new))
            array_push($res, array('label'=>'по новинкам'));
        $sale = $this->findAllByAttributes(
            array('is_show' => 1, 'category' => $type, 'is_sale' => 1)
        );
        if(!empty($sale))
            array_push($res, array('label'=>'по скидкам'));
        return $res;
    }

}
