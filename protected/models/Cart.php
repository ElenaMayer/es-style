<?php

/**
 * This is the model class for table "cart".
 *
 * The followings are the available columns in table 'cart':
 * @property integer $id
 * @property integer $user_id
 * @property integer $is_active
 *
 * The followings are the available model relations:
 * @property User $user
 * @property CartItem[] $cartItems
 */
class Cart extends CActiveRecord
{
    public $subtotal;
    public $shipping;
    public $sale;
    public $total;
    public $count;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cart';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, is_active', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, is_active', 'safe', 'on'=>'search'),
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
			'cartItems' => array(self::HAS_MANY, 'CartItem', 'cart_id'),
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
			'is_active' => 'Is Active',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('is_active',$this->is_active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cart the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function afterFind(){
        $subtotal = 0;
        $sale = 0;
        $count = 0;
        foreach($this->cartItems as $item){
            if($item->photo->is_available) {
                $subtotal += $item->photo->price * $item->count;
                $count += $item->count;
                if ($item->photo->is_sale) {
                    $sale += ($item->photo->price - $item->photo->new_price) * $item->count;
                }
            }
        }
        $this->subtotal = $subtotal;
        $this->sale = $sale;
        $this->count = $count;
        if($count >= Yii::app()->params['shippingFreeCount'])
            $this->shipping = 0;
        else
            $this->shipping = Yii::app()->params['shippingCost'];
        $this->total = $subtotal - $sale + $this->shipping;
    }

    public function findAndAddCartItem($attributes){
        $neededItem = null;
        foreach($this->cartItems as $item){
            if($item->item_id == $attributes["item_id"]) {
                if (isset($attributes["size"])) {
                    if ($item->size == $attributes["size"]) {
                        $neededItem = $item;
                        break;
                    }
                } else {
                    $neededItem = $item;
                    break;
                }
            }
        }
        if($neededItem) {
            $neededItem->count++;
            if ($neededItem->save()) return $neededItem;
            else return false;
        } else {
            return $this->addCartItem($attributes);
        }
    }

    public  function addCartItem($attributes){
        $cartItem = new CartItem;
        $cartItem->cart_id = $this->id;
        $cartItem->item_id = $attributes['item_id'];
        if(isset($attributes['size']))
            $cartItem->size = $attributes['size'];
        if($cartItem->save()) return $cartItem;
        else return false;
    }

    public function addItemsToCart($items){
        foreach($items as $item){
            $item->cart_id = $this->id;
            $item->save();
        }
    }
}
