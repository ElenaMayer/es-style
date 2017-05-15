<?php

/**
 * This is the model class for table "horoscope_sign_by_year".
 *
 * The followings are the available columns in table 'horoscope_sign_by_year':
 * @property integer $id
 * @property string $sign
 * @property string $desc
 * @property string $sex_female_desc
 * @property string $sex_male_desc
 * @property string $color_white_desc
 * @property string $color_red_desc
 * @property string $color_black_desc
 * @property string $color_green_desc
 * @property string $color_yellow_desc
 */
class HoroscopeSignByYear extends CActiveRecord
{

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'horoscope_sign_by_year';
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
			array('desc, sex_female_desc, sex_male_desc, color_white_desc, color_red_desc, color_black_desc, color_green_desc, color_yellow_desc', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sign, desc, sex_female_desc, sex_male_desc, color_white_desc, color_red_desc, color_black_desc, color_green_desc, color_yellow_desc', 'safe', 'on'=>'search'),
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
			'color_white_desc' => 'Color White Desc',
			'color_red_desc' => 'Color Red Desc',
			'color_black_desc' => 'Color Black Desc',
			'color_green_desc' => 'Color Green Desc',
			'color_yellow_desc' => 'Color Yellow Desc',
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
		$criteria->compare('color_white_desc',$this->color_white_desc,true);
		$criteria->compare('color_red_desc',$this->color_red_desc,true);
		$criteria->compare('color_black_desc',$this->color_black_desc,true);
		$criteria->compare('color_green_desc',$this->color_green_desc,true);
		$criteria->compare('color_yellow_desc',$this->color_yellow_desc,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HoroscopeSignByYear the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


    public static function getSignString($sign){
        $signs = [
            'tiger' => 'Тигр (Барс)',
            'rabbit' => 'Кролик (Заяц, Кот)',
            'ox' => 'Бык (Корова, Буйвол)',
            'rat' => 'Крыса (Мышь)',
            'dragon' => 'Дракон',
            'snake' => 'Змея',
            'horse' => 'Лошадь',
            'goat' => 'Коза (Овца, Баран)',
            'monkey' => 'Обезьяна',
            'rooster' => 'Петух (Курица)',
            'dog' => 'Собака (Пес)',
            'pig' => 'Свинья (Кабан)',
        ];
        return $signs[$sign];
    }

    public static function getSignStringRP($sign){
        $signs = [
            'tiger' => 'Тигра',
            'rabbit' => 'Кролика',
            'ox' => 'Быка',
            'rat' => 'Крысы',
            'dragon' => 'Дракона',
            'snake' => 'Змеи',
            'horse' => 'Лошади',
            'goat' => 'Козы',
            'monkey' => 'Обезьяны',
            'rooster' => 'Петуха',
            'dog' => 'Собаки',
            'pig' => 'Свиньи',
        ];
        return $signs[$sign];
    }

    public static function getFemaleColorString($color){
        $colors = [
            'white' => 'Металлическая',
            'black' => 'Водная',
            'red' => 'Огненная',
            'green' => 'Деревянная',
            'yellow' => 'Земляная',
        ];
        return $colors[$color];
    }

    public static function getMaleColorString($color){
        $colors = [
            'white' => 'Металлический',
            'black' => 'Водный',
            'red' => 'Огненный',
            'green' => 'Деревянный',
            'yellow' => 'Земляной',
        ];
        return $colors[$color];
    }

    public static function getFemaleColorStringRP($color){
        $colors = [
            'white' => 'Металлической',
            'black' => 'Водной',
            'red' => 'Огненной',
            'green' => 'Деревянной',
            'yellow' => 'Земляной',
        ];
        return $colors[$color];
    }

    public static function getMaleColorStringRP($color){
        $colors = [
            'white' => 'Металлического',
            'black' => 'Водного',
            'red' => 'Огненного',
            'green' => 'Деревянного',
            'yellow' => 'Земляного',
        ];
        return $colors[$color];
    }

    public static function getColorString($color, $sign, $is_rp = false){
        $maleSigns = ['tiger','rabbit','ox','dragon','rooster'];
        if(in_array($sign, $maleSigns)){
            if(!$is_rp){
                return HoroscopeSignByYear::getMaleColorString($color);
            } else {
                return HoroscopeSignByYear::getMaleColorStringRP($color);
            }
        } else {
            if(!$is_rp){
                return HoroscopeSignByYear::getFemaleColorString($color);
            } else {
                return HoroscopeSignByYear::getFemaleColorStringRP($color);
            }
        }
    }
}
