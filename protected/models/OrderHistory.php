<?php

/**
 * This is the model class for table "order_history".
 *
 * The followings are the available columns in table 'order_history':
 * @property string $id
 * @property integer $user_id
 * @property string $status
 * @property integer $is_paid
 * @property string $shipping_method
 * @property string $payment_method
 * @property string $addressee
 * @property string $address
 * @property integer $subtotal
 * @property integer $sale
 * @property integer $shipping
 * @property integer $total
 * @property string $date_create
 *
 * The followings are the available model relations:
 * @property User $user
 */
class OrderHistory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'order_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, address, subtotal, sale, shipping, total', 'required'),
			array('user_id, is_paid, subtotal, sale, shipping, total', 'numerical', 'integerOnly'=>true),
			array('id', 'length', 'max'=>13),
			array('status, shipping_method, payment_method, addressee, address', 'length', 'max'=>255),
			array('date_create', 'safe'),
            array('date_create','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, status, is_paid, shipping_method, payment_method, addressee, address, subtotal, sale, shipping, total, date_create', 'safe', 'on'=>'search'),
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
            'cartItems' => array(self::HAS_MANY, 'CartItem', 'order_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'status' => 'Status',
			'is_paid' => 'Is Paid',
			'shipping_method' => 'Shipping Method',
			'payment_method' => 'Payment Method',
			'addressee' => 'Addressee',
			'address' => 'Address',
			'subtotal' => 'Subtotal',
			'sale' => 'Sale',
			'shipping' => 'Shipping',
			'total' => 'Total',
			'date_create' => 'Date Create',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('is_paid',$this->is_paid);
		$criteria->compare('shipping_method',$this->shipping_method,true);
		$criteria->compare('payment_method',$this->payment_method,true);
		$criteria->compare('addressee',$this->addressee,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('subtotal',$this->subtotal);
		$criteria->compare('sale',$this->sale);
		$criteria->compare('shipping',$this->shipping);
		$criteria->compare('total',$this->total);
		$criteria->compare('date_create',$this->date_create,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OrderHistory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
