<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $date_of_birth
 * @property string $sex
 * @property integer $is_subscribed
 */
class User extends CActiveRecord
{
    public $date;
    public $month;
    public $year;
    public $password2;
    public $is_subscribed = true;
    private $_identity;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('username, password, name, phone, email, sex', 'length', 'max'=>255),
            array('password, password2', 'length', 'min'=>6, 'tooShort'=>'Минимальная длина пароля 6 символов'),
            array('email', 'email'),
			array('date_of_birth, date, month, year', 'safe'),
            array('email, password', 'required', 'message'=>'Это поле необходимо заполнить.'),
            array('name, password2', 'required', 'on' => 'registration', 'message'=>'Это поле необходимо заполнить.'),
			array('id, username, name, phone, email, date_of_birth, sex, is_subscribed', 'safe', 'on'=>'search'),
            array('password2', 'passwordMatch', 'on' => 'registration'),
            array('email', 'emailCheck'),
		);
	}

    public function passwordMatch ( $attribute ) {
        if ( $this->password !== $this->password2 )
            $this->addError ( $attribute, "Пожалуйста, убедитесь, что Ваши пароли совпадают" );
    }

    public function emailCheck ( $attribute ) {
        $email=$this->findByAttributes(array('email'=>$this->email));
        if (Yii::app()->controller->action->id == 'registration' && !empty($email))
            $this->addError ( $attribute, "Другая учетная запись зарегистрирована на указанный адрес." );
        elseif (Yii::app()->controller->action->id == 'login' && empty($email)) {
            $this->addError('password', "Неверный логин или пароль.");
        }
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
			'username' => 'Username',
			'password' => 'Пароль',
            'password2' => 'Повторите пароль',
			'name' => 'Имя',
			'phone' => 'Моб. телефон',
			'email' => 'Эл. почта',
			'date_of_birth' => 'Дата рождения',
			'sex' => 'Пол',
			'is_subscribed' => 'Подписаться на новости и скидки',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('date_of_birth',$this->date_of_birth,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('is_subscribed',$this->is_subscribed);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function getMonthsArray()
    {
        $months = [
            1 => 'Январь',
            2 => 'Февраль',
            3 => 'Март',
            4 => 'Апрель',
            5 => 'Май',
            6 => 'Июнь',
            7 => 'Июль',
            8 => 'Август',
            9 => 'Сентябрь',
            10 => 'Октябрь',
            11 => 'Ноябрь',
            12 => 'Декабрь',
        ];
        return array(0 => 'Месяц') + $months;
    }

    public function getDatesArray()
    {
        for($dateNum = 1; $dateNum <= 31; $dateNum++){
            $dates[$dateNum] = $dateNum;
        }
        return array(0 => 'День') + $dates;
    }

    public function getYearsArray()
    {
        $thisYear = date('Y', time());

        for($yearNum = $thisYear; $yearNum >= 1920; $yearNum--){
            $years[$yearNum] = $yearNum;
        }
        return array(0 => 'Год') + $years;
    }

    protected function beforeSave()
    {
        if(parent::beforeSave())
        {
            if($this->isNewRecord)
            {
                $salt = CPasswordHelper::generateSalt(7);
                $this->password = crypt($this->password, $salt);
                if (!empty($this->date) && !empty($this->month) && !empty($this->year))
                    $this->date_of_birth = $this->date . '.' .$this->month . '.' . $this->year;
            }
            return true;
        }
        else
            return false;
    }

    public function login()
    {
        if($this->_identity===null)
        {
            $this->_identity=new UserIdentity($this->email, $this->password);
            $this->_identity->authenticate();
        }
        if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
        {
            Yii::app()->user->login($this->_identity);
            return true;
        }
        else
            return false;
    }
}
