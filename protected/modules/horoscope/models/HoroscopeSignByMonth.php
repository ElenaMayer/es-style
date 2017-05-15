<?php

/**
 * This is the model class for table "horoscope_sign_by_month".
 *
 * The followings are the available columns in table 'horoscope_sign_by_month':
 * @property integer $id
 * @property string $sign
 * @property string $desc
 * @property string $sex_female_desc
 * @property string $sex_male_desc
 */
class HoroscopeSignByMonth extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'horoscope_sign_by_month';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sign', 'length', 'max'=>255),
			array('desc, sex_female_desc, sex_male_desc', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sign, desc, sex_female_desc, sex_male_desc', 'safe', 'on'=>'search'),
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
			'sign' => 'Sign',
			'desc' => 'Desc',
			'sex_female_desc' => 'Sex Female Desc',
			'sex_male_desc' => 'Sex Male Desc',
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
		$criteria->compare('sign',$this->sign,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('sex_female_desc',$this->sex_female_desc,true);
		$criteria->compare('sex_male_desc',$this->sex_male_desc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HoroscopeSignByMonth the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getSignString($sign){
        $signs = [
            'aries' => 'Овен',
            'taurus' => 'Телец',
            'gemini' => 'Близнецы',
            'cancer' => 'Рак',
            'leo' => 'Лев',
            'virgo' => 'Дева',
            'libra' => 'Весы',
            'scorpio' => 'Скорпион',
            'sagittarius' => 'Стрелец',
            'capricorn' => 'Козерог',
            'aquarius' => 'Водолей',
            'pisces' => 'Рыбы',
        ];
        return $signs[$sign];
    }

    public static function getSignStringRP($sign){
        $signs = [
            'aries' => 'Овена',
            'taurus' => 'Телеца',
            'gemini' => 'Близнецов',
            'cancer' => 'Рака',
            'leo' => 'Льва',
            'virgo' => 'Девы',
            'libra' => 'Весов',
            'scorpio' => 'Скорпиона',
            'sagittarius' => 'Стрельца',
            'capricorn' => 'Козерога',
            'aquarius' => 'Водолея',
            'pisces' => 'Рыб',
        ];
        return $signs[$sign];
    }
}
