<?php

/**
 * This is the model class for table "order".
 *
 * The followings are the available columns in table 'order':
 * @property integer $id
 * @property string $type
 * @property string $name
 * @property integer $postcode
 * @property string $address
 * @property string $email
 * @property string $phone
 * @property string $size
 * @property string $company
 * @property string $city
 * @property string $order
 * @property string $date_create
 */
class Order extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('postcode', 'numerical', 'integerOnly'=>true),
			array('type, name, address, email, phone, size, company, city', 'length', 'max'=>255),
			array('order, date_create', 'safe'),
			array('id, type, email, phone, date_create', 'safe', 'on'=>'search'),
            array('date_create','default', 'value'=>new CDbExpression('NOW()')),
            array('name, email, phone, order', 'required', 'message'=>'Это поле необходимо заполнить.'),
            array('postcode, address', 'required', 'on'=>'shipping', 'message'=>'Это поле необходимо заполнить.'),
            array('city', 'required', 'on'=>'wholesale', 'message'=>'Это поле необходимо заполнить.'),
            array('email', 'email', 'message'=>'Пожалуйста, введите корректный адрес. Например, name@domain.ru'),
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
			'type' => 'Тип',
			'name' => 'ФИО',
			'postcode' => 'Почтовый индекс',
			'address' => 'Почтовый адрес',
			'email' => 'E-mail',
			'phone' => 'Телефон',
			'size' => 'Мерки',
			'company' => 'Ваша компания',
			'city' => 'Город',
			'order' => 'Заказ',
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
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('postcode',$this->postcode);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('size',$this->size,true);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('order',$this->order,true);
		$criteria->compare('date_create',$this->date_create,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Order the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
