<?php

/**
 * This is the model class for table "comment".
 *
 * The followings are the available columns in table 'comment':
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $comment
 * @property string $type
 * @property integer $item_id
 * @property integer $is_show
 * @property string $img
 * @property integer $rating
 * @property string $city
 * @property string $email
 * @property string $date_create
 */
class Comment extends CActiveRecord
{
    /*
     * $type:
     * reviews - Отзыв
     * review_answer - Ответ на отзыв
     * blog_post - Коментарии к статье
     */

    public $is_show = 1;
    public $image;
    public $imageHeight = 300;
    public $imageWidth = 600;
    public $answer;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, item_id, is_show, rating', 'numerical', 'integerOnly'=>true),
			array('img, name, type, city, email', 'length', 'max'=>255),
			array('date_create', 'safe'),
            array('date_create','default', 'value'=>new CDbExpression('NOW()')),
			array('id, user_id, item_id, name, comment, type, is_show, date_create', 'safe', 'on'=>'search'),
            array('comment', 'required', 'message'=>'Это поле необходимо заполнить.'),
            array('name', 'required', 'on'=>'blogPost', 'message'=>'Это поле необходимо заполнить.'),
            array('image', 'file', 'types'=>'jpg, gif, png', 'allowEmpty'=>true),
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
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'user_id' => 'Пользователь',
			'name' => 'Имя',
            'rating' => 'Рейтинг',
            'city' => 'Город',
            'email' => 'Email',
			'comment' => 'Комментарий',
			'type' => 'Тип',
            'item_id' => 'Id элемента',
			'is_show' => 'Показывать',
            'img' => 'Фото',
            'image' => 'Загрузить фото',
			'date_create' => 'Дата создания',
		);
	}

    public function init()
    {
        if ($this->scenario == 'create' && !Yii::app()->user->isGuest) {
            $this->name = Yii::app()->user->name;
            $this->email = Yii::app()->user->email;
        } elseif (!empty($_GET) && isset($_GET['user_id']) && isset($_GET['email']) && isset($_GET['hash'])){
            $user = User::model()->findByPk($_GET['user_id']);
            $hash = crypt($user->id, $user->name);
            if ($user->email == $_GET['email'] && $hash == $_GET['hash']) {
                $this->name = $user->name;
                $this->email = $user->email;
            }
        }
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('is_show',$this->is_show);
        $criteria->compare('email',$this->email);
		$criteria->compare('date_create',$this->date_create,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>'20',
            ),
            'sort'=>array(
                'defaultOrder'=>'date_create DESC',
            )
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Comment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    protected function beforeSave(){
        if(!parent::beforeSave())
            return false;
        if($image=CUploadedFile::getInstance($this,'image')){
            $img_name = $this->user_id.'_'.Yii::app()->dateFormatter->format('yyMMddHms', time()).'.'.$image->extensionName;
            $this->img=$img_name;
            $image->saveAs(Yii::getPathOfAlias('data.comment').DIRECTORY_SEPARATOR.$img_name);
            $this->prepareImage();
        }
        return true;
    }

    public function prepareImage(){
        Yii::app()->image
            ->load(Yii::getPathOfAlias('data.comment').DIRECTORY_SEPARATOR.$this->img)
            ->resize($this->imageWidth, $this->imageHeight)
            ->save(Yii::getPathOfAlias('data.comment').DIRECTORY_SEPARATOR.$this->img);
    }

    public function getImageUrl() {
        return Yii::app()->getBaseUrl().'/data/comment/'.$this->img;
    }

    protected function afterFind(){
        parent::afterFind();

        $this->answer = Comment::model()->findByAttributes(['item_id' => $this->id, 'type' => 'review_answer']);
    }

}
