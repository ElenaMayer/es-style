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
 * @property integer $postcode
 * @property string $addressee
 * @property string $address
 * @property integer $subtotal
 * @property integer $sale
 * @property integer $shipping
 * @property integer $total
 * @property integer $total_with_commission
 * @property string $date_create
 * @property string $track_code
 * @property string $phone
 * @property string $email
 * @property integer $coupon_id
 * @property integer $coupon_sale
 * @property integer $coupon_mail_flag
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
			array('id, subtotal, sale, total', 'required'),
			array('user_id, is_paid, subtotal, sale, shipping, total, postcode, coupon_id, coupon_sale', 'numerical', 'integerOnly'=>true),
			array('id', 'length', 'max'=>13),
			array('status, shipping_method, payment_method, addressee, address, track_code, phone, email', 'length', 'max'=>255),
			array('date_create', 'safe'),
            array('date_create','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, status, is_paid, shipping_method, payment_method, addressee, address, subtotal, sale, shipping, total, date_create, track_code, phone, email, postcode, coupon_id', 'safe', 'on'=>'search'),
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
            'coupon' => array(self::BELONGS_TO, 'Coupon', 'coupon_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
            'user_id' => 'Пользователь',
            'status' => 'Статус',
            'is_paid' => 'Оплата заказа',
            'shipping_method' => 'Метод доставки',
            'payment_method' => 'Оплата',
            'postcode' => 'Индекс',
            'addressee' => 'Получатель',
            'address' => 'Адрес',
            'subtotal' => 'Подитог',
            'coupon_id' => 'Купон',
            'coupon_sale' => 'Скидка по купону',
            'sale' => 'Скидка',
            'shipping' => 'Доставка',
            'total' => 'Итого',
            'total_with_commission' => 'С комиссией',
            'date_create' => 'Дата создания',
            'track_code' => 'Почтовый идентификатор',
			'phone' => 'Телефон',
			'email' => 'Email',
            'coupon_mail_flag' => 'Получино письмо с просьбой написать отзыв за купон',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('is_paid',$this->is_paid);
        $criteria->compare('postcode',$this->postcode,true);
		$criteria->compare('addressee',$this->addressee,true);
		$criteria->compare('date_create',$this->date_create,true);
		$criteria->compare('track_code',$this->track_code,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'Pagination' => array (
                'PageSize' =>25
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
	 * @return OrderHistory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getColor(){
		$color = '';
		switch ($this->status) {
			case 'in_progress':
				$color = 'green';
				break;
			case 'confirmation':
				$color = 'red';
				break;
        	case 'collect':
				$color = 'green';
				break;
			case 'payment':
				$color = 'red';
				break;
			case 'shipping_by_rp':
				$color = 'yellow';
				break;
			case 'shipping_by_tc':
				$color = 'yellow';
				break;
			case 'waiting_delivery':
				$color = 'orange';
				break;
            case 'paid':
            case 'waiting_shipping':
                $color = 'cyan';
                break;
			case 'completed':
				$color = 'light_green';
				break;
			case 'not_redeemed':
				$color = 'light_red';
				break;
			case 'canceled':
				$color = 'gray';
				break;
			case 'lost':
				$color = 'purple';
				break;
		}
		return $color;
	}
	
	public static function getOrderNewSum(){
		$sum = (string)Yii::app()->request->cookies['orderNewSum'];
		if($sum == 0 || $sum == '') {
            $sum = OrderHistory::refreshOrderNewSum();
		}
		return $sum;
	}

	public static function refreshOrderNewSum(){
        $sum = 0;
        $orders = OrderHistory::model()->findAllByAttributes(['status' => ['in_progress', 'confirmation', 'collect', 'payment']]);
        foreach ($orders as $order) {
            $sum += $order->total;
        }
        Yii::app()->request->cookies['orderNewSum'] = new CHttpCookie('orderNewSum', $sum);
	}
	
	public static function getOrderSendSum(){
		$sum = (string)Yii::app()->request->cookies['orderSendSum'];
		if($sum == 0 || $sum == '') {
            $sum = OrderHistory::refreshOrderSendSum();
		}
		return $sum;
	}

	public static function refreshOrderSendSum(){
        $sum = 0;
        $orders = OrderHistory::model()->findAllByAttributes(['status' => ['shipping_by_rp', 'shipping_by_tc', 'waiting_delivery']]);
        foreach ($orders as $order) {
            $sum += $order->total;
        }
        Yii::app()->request->cookies['orderSendSum'] = new CHttpCookie('orderSendSum', $sum);
	}

    public static function refreshOrderSum(){
        OrderHistory::refreshOrderNewSum();
        OrderHistory::refreshOrderSendSum();
        OrderHistory::refreshOrderAvailableSum();
    }
		
	public static function getOrderAvailableSum(){
        $sum = (string)Yii::app()->request->cookies['orderAvailableSum'];
        if($sum == 0 || $sum == '') {
            $sum = OrderHistory::refreshOrderAvailableSum();
        }
        return $sum;
	}

    public static function refreshOrderAvailableSum(){
        $sum = 0;
        $orders = OrderHistory::model()->findAllByAttributes(['status' => 'paid']);
        foreach ($orders as $order) {
            $sum += $order->total;
        }
        Yii::app()->request->cookies['orderAvailableSum'] = new CHttpCookie('orderAvailableSum', $sum);
    }

    public function getOrderItemsCount(){
        $count = 0;
        foreach ($this->cartItems as $item) {
            $count += $item->count;
        }
        return $count;
    }

    public function recountOrderSum(){
        $subtotal = 0;
        $sale = 0;
        foreach($this->cartItems as $item){
            if(isset($item->new_price)){
                $sale += ($item->price - $item->new_price) * $item->count;
            }
            $subtotal += $item->price * $item->count;
        }
        $this->subtotal = $subtotal;
        $this->sale = $sale;
        $this->total = $subtotal - $sale;
        return $this->save();
    }

    public function reviewForCouponMailIsSent(){
        $this->coupon_mail_flag = 1;
        $this->save();
        $otherOrders = OrderHistory::model()->findAllByAttributes(['email' => $this->email], 'id <>'.$this->id);
        foreach ($otherOrders as $order){
            $order->coupon_mail_flag = 1;
            $order->save();
        }
    }

    public function isPaid(){
        $this->is_paid = 1;
        $this->status = 'waiting_shipping';
        $this->save();
    }
}
