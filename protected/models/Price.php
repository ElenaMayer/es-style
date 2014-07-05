<?php

/**
 * This is the model class for table "price".
 *
 * The followings are the available columns in table 'price':
 * @property integer $id
 * @property string $file
 * @property string $date_create
 */
class Price extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'price';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('file', 'length', 'max'=>255),
			array('date_create', 'safe'),
			array('id, file, date_create', 'safe', 'on'=>'search'),
            array('date_create','default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false,'on'=>'insert'),
            array('file', 'file', 'types'=>'xls, xlsx'),
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
			'file' => 'Файл',
			'date_create' => 'Дата добавления',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('file',$this->file,true);
		$criteria->compare('date_create',$this->date_create,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Price the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    protected function beforeSave(){
        if(!parent::beforeSave())
            return false;
        if(($this->scenario=='insert') && ($file=CUploadedFile::getInstance($this,'file'))){
            $this->deleteFile();
            $this->file=$file->name;
            $file->saveAs(Yii::getPathOfAlias('data.price').DIRECTORY_SEPARATOR.$file->name);
        }
        return true;
    }

    protected function beforeDelete(){
        if(!parent::beforeDelete())
            return false;
        $this->deleteFile();
        return true;
    }

    public function deleteFile(){
        $file=Yii::getPathOfAlias('data.price').DIRECTORY_SEPARATOR.$this->file;
        if(is_file($file))
            unlink($file);
    }

    public function getFileUrl(){
        return Yii::app()->getBaseUrl().'/data/price/';
    }

    public function getPrice(){
        $price = $this->find(array('order'=>'date_create DESC'));
        return $this->getFileUrl().$price->file;
    }
}
