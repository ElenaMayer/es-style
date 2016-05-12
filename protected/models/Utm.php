<?php

/**
 * This is the model class for table "utm".
 *
 * The followings are the available columns in table 'utm':
 * @property integer $id
 * @property string $utm_source
 * @property string $utm_medium
 * @property string $utm_campaign
 * @property string $utm_term
 * @property string $utm_content
 * @property string $date_create
 */
class Utm extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'utm';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('utm_source, utm_medium, utm_campaign, utm_term, utm_content', 'length', 'max'=>255),
			array('date_create', 'safe'),
			array('date_create','default', 'value'=>new CDbExpression('NOW()')),
			array('id, utm_source, utm_medium, utm_campaign, utm_term, utm_content, date_create', 'safe', 'on'=>'search'),
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
			'utm_source' => 'Источник рекламной компании',
			'utm_medium' => 'Тип рекламной компании',
			'utm_campaign' => 'Название рекламной кампании',
			'utm_term' => 'Ключевое слово в кампании',
			'utm_content' => 'Идентификатор объявления',
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
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('utm_source',$this->utm_source,true);
		$criteria->compare('utm_medium',$this->utm_medium,true);
		$criteria->compare('utm_campaign',$this->utm_campaign,true);
		$criteria->compare('utm_term',$this->utm_term,true);
		$criteria->compare('utm_content',$this->utm_content,true);
		$criteria->compare('date_create',$this->date_create,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Utm the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
