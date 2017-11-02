<?php

/**
 * This is the model class for table "cart_item".
 *
 * The followings are the available columns in table 'cart_item':
 * @property integer $id
 * @property integer $cart_id
 * @property integer $item_id
 * @property string $size
 * @property integer $count
 * @property integer $price
 * @property integer $new_price
 * @property string $order_id
 * @property string $date_create
 *
 * The followings are the available model relations:
 * @property Cart $cart
 * @property Photo $item
 */
class CartItem extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cart_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cart_id, item_id, count, price, new_price', 'numerical', 'integerOnly'=>true),
			array('size', 'length', 'max'=>255),
			array('order_id', 'length', 'max'=>225),
			array('date_create', 'safe'),
            array('date_create','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cart_id, item_id, size, count, price, new_price, order_id, date_create', 'safe', 'on'=>'search'),
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
			'cart' => array(self::BELONGS_TO, 'Cart', 'cart_id'),
			'photo' => array(self::BELONGS_TO, 'Photo', 'item_id'),
            'order' => array(self::BELONGS_TO, 'OrderHistory', 'order_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'cart_id' => 'Cart',
			'item_id' => 'Item',
			'size' => 'Size',
			'count' => 'Count',
			'price' => 'Price',
			'new_price' => 'New Price',
			'order_id' => 'Order',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('cart_id',$this->cart_id);
		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('size',$this->size,true);
		$criteria->compare('count',$this->count);
		$criteria->compare('price',$this->price);
		$criteria->compare('new_price',$this->new_price);
		$criteria->compare('order_id',$this->order_id,true);
		$criteria->compare('date_create',$this->date_create,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CartItem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getSum(){
        if(Yii::app()->cart->isWholesale()) {
            return $this->photo->wholesale_price*$this->count;
        } elseif (!empty($this->new_price))
			return $this->new_price*$this->count;
		elseif(!empty($this->price))
			return $this->price*$this->count;
        elseif(!empty($this->cart->coupon_id))
            return $this->cart->coupon->getSumWithSaleInRub($this->photo->price, $this->photo->category)*$this->count;
		else
			return $this->photo->price*$this->count;

	}

}
