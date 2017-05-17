<?php

/**
 * This is the model class for table "coupon".
 *
 * The followings are the available columns in table 'coupon':
 * @property integer $id
 * @property string $coupon
 * @property integer $sale
 * @property integer $is_active
 * @property integer $is_reusable
 * @property integer $is_used
 * @property string $until_date
 * @property string $date_create
 * @property string $type
 * @property string $category
 *
 * The followings are the available model relations:
 * @property Cart[] $carts
 * @property User[] $users
 */

/*
 * is_active: для одноразового купона 1 - может быть отправлено пользователю, 0 - отправлен пользователю
 * is_reusable: 1 - может быть использован много раз, 0 - одноразовый
 * is_used: 1 - использован, 0 - не использован
 */
class Coupon extends CActiveRecord
{

    public $count;
    public $is_active = 1;
    public $is_used = 0;
    public $is_reusable = 0;
    public $type = 'percent';

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'coupon';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sale, is_active, is_reusable, is_used, count', 'numerical', 'integerOnly'=>true),
			array('coupon, type, category', 'length', 'max'=>255),
			array('until_date, date_create', 'safe'),
            array('date_create','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'),
			array('id, coupon, sale, is_active, is_reusable, is_used, until_date, date_create', 'safe', 'on'=>'search'),
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
			'carts' => array(self::HAS_MANY, 'Cart', 'coupon_id'),
			'users' => array(self::HAS_MANY, 'User', 'coupon_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'coupon' => 'Купон',
			'sale' => 'Скидка',
			'is_active' => 'Активен',
			'is_reusable' => 'Многоразовый',
			'is_used' => 'Использован',
            'type' => 'Тип',
            'category' => 'Категория',
			'until_date' => 'Использовать до',
			'date_create' => 'Дата создания',
            'count' => 'Количество, шт.',
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
		$criteria->compare('coupon',$this->coupon,true);
        $criteria->compare('type',$this->type,true);
        $criteria->compare('category',$this->category,true);
		$criteria->compare('sale',$this->sale);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('is_reusable',$this->is_reusable);
		$criteria->compare('is_used',$this->is_used);
		$criteria->compare('until_date',$this->until_date,true);
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
	 * @return Coupon the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function generate(){
        if (!$this->is_reusable) {
            for ($i = 0; $i < $this->count; $i++){
                $coupon = new Coupon();
                $coupon->attributes = $this->attributes;
                $coupon->coupon = uniqid();
                $coupon->save();
            }
            return true;
        } else {
            return $this->save();
        }
    }

    public function isUsed(){
        $this->is_used = 1;
        $this->save();
    }

    public function getOneOffCouponBySale($sale){
        $coupon = $this->findByAttributes(['is_active'=>1, 'is_reusable'=>0, 'is_used'=>0, 'sale'=>$sale], "until_date >= '".date("Y-m-d")."'");
        if ($coupon) {
            $coupon->is_active = 0;
            $coupon->save();
            return $coupon;
        } else
            return false;
    }

    public static function types(){
        return ['percent' => 'Процент', 'sum' => 'Сумма'];
    }

    public function getSumWithSaleInRub($sum, $category = null){
        if($this->type == 'percent') {
            if($this->category){
                if($category && $this->category == $category)
                    return $sum * (100 - $this->sale) / 100;
                else
                    return $sum;
            } else
                return $sum * (100 - $this->sale) / 100;
        } else {
            if(!$category){
                return $sum - $this->sale;
            } else
                return $sum;
        }
    }

    public function getSaleInRub($sum, $category = null){
        if($this->type == 'percent') {
            if($this->category){
                if($category && $this->category == $category)
                    return $sum * $this->sale / 100;
                else
                    return 0;
            } else
                return $sum * $this->sale / 100;
        } else {
            if(!$category){
                return $this->sale;
            } else
                return 0;
        }
    }

    public function getTotalSaleInRub($items) {
        if($this->type != 'percent') {
            if($this->checkCategory($items))
                return $this->sale;
            else
                return 0;
        }
    }

    public function checkCategory($items){
        $has_category = 1;
        if($this->category){
            $has_category = 0;
            foreach ($items as $item) {
                if($item->photo->category === $this->category)
                    $has_category = 1;
            }
        }
        return $has_category;
    }
}
