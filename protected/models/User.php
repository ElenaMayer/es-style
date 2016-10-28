<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $name
 * @property string $surname
 * @property string $middlename
 * @property string $phone
 * @property string $email
 * @property string $address
 * @property string $date_of_birth
 * @property string $sex
 * @property integer $postcode
 * @property integer $is_subscribed
 * @property string $date_create
 * @property integer $blocked
 * @property integer $coupon_id
 */
class User extends CActiveRecord
{
    public $date;
    public $month;
    public $year;
    public $password1;
    public $password2;
    public $password_old;
    public $password_new;
    public $is_subscribed = true;
    private $_identity;
    public $payment = 'cod';
    public $create_profile;
    public $postcode_error;
    public $shipping;
    public $titleName;

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
            array('username, password, name, surname, middlename, address, phone, email, sex', 'length', 'max'=>255),
            array('password, password1, password2', 'length', 'min'=>6, 'tooShort'=>'Минимальная длина пароля 6 символов'),
            array('postcode', 'length', 'min'=>6, 'max'=>6, 'tooShort'=>'Длина индекса должна быть 6 символов'),
            array('postcode_error', 'checkPostcode', 'on'=> 'userOrder, orderWithRegistration, guestOrder'),
            array('email', 'email', 'message'=>'Значение не является правильным e-mail адресом.'),
            array('postcode', 'numerical', 'integerOnly'=>true),
            array('date_of_birth, date, month, year, is_subscribed, blocked', 'safe'),
            array('email, password', 'required', 'on' => 'login', 'message'=>'Это поле необходимо заполнить.'),
            array('email, name, password1, password2', 'required', 'on' => 'registration', 'message'=>'Это поле необходимо заполнить.'),
            array('name, surname, middlename, address, phone, postcode', 'required', 'on' => 'userOrder', 'message'=>'Это поле необходимо заполнить.'),
            array('name, surname, middlename, address, phone, postcode, email', 'required', 'on' => 'guestOrder', 'message'=>'Это поле необходимо заполнить.'),
            array('password1, password2, name, surname, middlename, address, phone, email, postcode', 'required', 'on' => 'orderWithRegistration', 'message'=>'Это поле необходимо заполнить.'),
            array('name, password2, password_old, password_new', 'required', 'on' => 'customer', 'message'=>'Это поле необходимо заполнить.'),
            array('name', 'required', 'on' => 'customer_person_data', 'message'=>'Это поле необходимо заполнить.'),
            array('password2, password_old, password_new', 'required', 'on' => 'customer_password_data', 'message'=>'Это поле необходимо заполнить.'),
            array('email', 'required', 'on' => 'remindPassword', 'message'=>'Это поле необходимо заполнить.'),
            array('id, name, surname, phone, email, date_of_birth, sex, is_subscribed', 'safe', 'on'=>'search'),
            array('password1', 'passwordMatch', 'on' => 'registration, orderWithRegistration'),
            array('password_new', 'passwordMatch', 'on' => 'customer_password_data'),
            array('password_old', 'passwordCheck', 'on' => 'customer_password_data'),
            array('email', 'emailCheckForReg', 'on'=> 'registration, orderWithRegistration'),
            array('email', 'emailCheckForRemind', 'on'=> 'remindPassword'),
            array('email', 'unsafe', 'on'=>'customer, userOrder'),
            array('date_create', 'safe'),
            array('date_create', 'default', 'value'=>new CDbExpression('NOW()')),
        );
    }

    public function passwordMatch ( $attribute ) {
        if ( $this->$attribute !== $this->password2 )
            $this->addError ( 'password2', "Пожалуйста, убедитесь, что Ваши пароли совпадают." );
    }

    public function passwordCheck ( $attribute ) {
        if(!CPasswordHelper::verifyPassword($this->$attribute, $this->password))
            $this->addError ( $attribute, "Текущий пароль указан неверно." );
    }

    public function emailCheckForReg ( $attribute ) {
        $email=$this->findByAttributes(array('email'=>$this->email));
        if (Yii::app()->controller->action->id != 'login' && !empty($email)) {
            $this->addError($attribute, "Другая учетная запись зарегистрирована на указанный адрес.");
        } elseif (Yii::app()->controller->action->id == 'login' && empty($email)) {
            $this->addError('password', "Неверный логин или пароль.");
        }
    }

    public function emailCheckForRemind ( $attribute ) {
        $email=$this->findByAttributes(array('email'=>$this->email));
        if (empty($email)) {
            $this->addError($attribute, "По данному адресу учетная запись на найдена.");
        }
    }

    public function checkPostcode ( $attribute ) {
        if ($this->$attribute == 1) {
            $this->addError('postcode', "Несуществующий индекс.");
        } elseif ($this->$attribute == 2) {
            $this->addError('postcode', "Доставка в Ваш регион в данный момент невозможна.");
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
            'orders' => array(self::HAS_MANY, 'OrderHistory', 'user_id'),
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
            'username' => 'Username',
            'password' => 'Пароль',
            'password_old' => 'Текущий пароль',
            'password_new' => 'Новый пароль',
            'password1' => 'Пароль',
            'password2' => 'Повторите пароль',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'middlename' => 'Отчество',
            'phone' => 'Моб. телефон',
            'email' => 'Эл. почта',
            'address' => 'Адрес',
            'postcode' => 'Почтовый индекс',
            'date_of_birth' => 'Дата рождения',
            'sex' => 'Пол',
            'is_subscribed' => 'Подписаться на новости и скидки',
            'blocked' => 'Заблокирован',
            'create_profile' => ' Зарегистрироваться для упрощения покупки',
            'payment' => 'Способ оплаты',
            'coupon_id' => 'Купон',
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
        $criteria->compare('username',$this->username,true);
        $criteria->compare('password',$this->password,true);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('surname',$this->surname,true);
        $criteria->compare('phone',$this->phone,true);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('sex',$this->sex,true);
        $criteria->compare('is_subscribed',$this->is_subscribed);
        $criteria->compare('coupon_id',$this->coupon_id);
        $criteria->compare('blocked',$this->blocked);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'date_create DESC',
            )
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
        if(parent::beforeSave()) {
            if($this->isNewRecord) {
                $this->password = $this->passwordCrypt($this->password);
            } else {
                if (!empty($this->password_new))
                    $this->password = $this->passwordCrypt($this->password_new);
            }
            if (!empty($this->date) && !empty($this->month) && !empty($this->year))
                $this->date_of_birth = $this->year . '.' .$this->month . '.' . $this->date;
            return true;
        } else
            return false;
    }

    protected function afterSave() {
        parent::afterSave();
        if(!empty($this->password1))
            $this->login($this->password1);
    }

    protected function passwordCrypt($password){
        $salt = CPasswordHelper::generateSalt(7);
        return crypt($password, $salt);
    }

    public function login($password = null) {
        if($this->_identity===null) {
            if($password) {
                $this->_identity = new UserIdentity($this->email, $password);
            } else {
                $this->_identity = new UserIdentity($this->email, $this->password);
            }
            $this->_identity->authenticate();
        }
        if($this->_identity->errorCode===UserIdentity::ERROR_NONE) {
            Yii::app()->user->login($this->_identity);
            return true;
        } else {
            $this->addError('password', "Неверный логин или пароль.");
            return false;
        }
    }

    public function getUser(){
        $user = $this->findByAttributes(array('email'=>Yii::app()->user->email));
        if (isset($user->date_of_birth)) {
            $date_of_birth = strtotime($user->date_of_birth);
            $user->date = (int)date('d', $date_of_birth);
            $user->month = date('n', $date_of_birth);
            $user->year = date('Y', $date_of_birth);
        }
        return $user;
    }

    public function saveUserData($attributes){
        $this->attributes = $attributes;
        if(isset($attributes['create_profile']) && $attributes['create_profile'] == '0'){
            $this->scenario = 'guestOrder'; // else 'orderWithRegistration'
        }
        if ($this->validate()) {
            if(isset($attributes['create_profile']) && $attributes['create_profile'] == '1'){
                $this->password = $this->password1;
                $this->save();
            }
            if(!Yii::app()->user->isGuest)
                $this->save();
        }
        if (!empty($attributes['payment']))
            $this->payment = $attributes['payment'];
        if (isset($attributes['create_profile']))
            $this->create_profile = $attributes['create_profile'];
    }

    public function createNewPassword(){
        $this->password_new = $this->generatePassword();
        $this->save();
    }

    public function generatePassword($length = 8) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars);
        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }
        return $result;
    }

    public function blockUser(){
        $this->blocked = true;
        $this->save();
    }

    public function unsubscribe(){
        if($this->is_subscribed) {
            $this->is_subscribed = false;
            return $this->save();
        } else {
            return false;
        }
    }
    
    public function getTitleName(){
        return mb_convert_case($this->name, MB_CASE_TITLE, "UTF-8");
    }
}
