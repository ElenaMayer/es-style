<?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $is_show
 * @property string $date_create
 * @property string $date_publish
 * @property integer $is_send_mail
 */
class News extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'news';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('is_show, is_send_mail', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('content, date_create, date_publish', 'safe'),
			array('id, title, content, is_show, is_send_mail, date_create, date_publish', 'safe', 'on'=>'search'),
            array('date_create','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'),
            array('title, content, date_publish', 'required'),
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
			'title' => 'Название',
			'content' => 'Контент',
			'is_show' => 'Отображать',
            'is_send_mail' => 'Рассылка',
			'date_create' => 'Дата создания',
            'date_publish' => 'Дата публикации',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('is_show',$this->is_show);
        $criteria->compare('is_send_mail',$this->is_send_mail);
		$criteria->compare('date_create',$this->date_create,true);
        $criteria->compare('date_publish',$this->date_publish,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>'10',
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
	 * @return News the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getNewsByNumber($number){
        return $this->findByAttributes(
            array('is_show' => 1),
            array('order'=>'date_publish DESC',  'offset' => $number-1)
        );
    }

}
