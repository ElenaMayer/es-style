<?php

/**
 * This is the model class for table "horoscope_model_by_color".
 *
 * The followings are the available columns in table 'horoscope_model_by_color':
 * @property integer $id
 * @property string $model_id
 * @property string $color
 * @property integer $is_in_pare
 */
class HoroscopeModelByColor extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'horoscope_model_by_color';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('is_in_pare', 'numerical', 'integerOnly'=>true),
            array('model_id, color', 'length', 'max'=>255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, model_id, color, is_in_pare', 'safe', 'on'=>'search'),
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
            'model' => array(self::BELONGS_TO, 'Photo', 'model_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'model_id' => 'Model',
            'color' => 'Color',
            'is_in_pare' => 'Is In Pare',
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
        $criteria->compare('model_id',$this->model_id,true);
        $criteria->compare('color',$this->color,true);
        $criteria->compare('is_in_pare',$this->is_in_pare);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return HoroscopeModelByColor the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    // Два цвета, если есть пересечения берем его, если нет рендомно
	public static function getModelsByColors($colors){
        $modelsArr = [];
	    $modelsRes = [];
	    $colorsArr = [];
	    foreach ($colors as $key=>$color){
	        $models = HoroscopeModelByColor::model()->findAllByAttributes(['color'=>$colors[$key]]);
	        foreach ($models as $model){
                $colorsArr[$key][] = $model->model_id;
            }
        }
        for ($i=0;$i<count($colorsArr);$i++){
            if($i < (count($colorsArr)-1)){
                $isPareModelAdd = false;
                for ($j=$i+1;$j<count($colorsArr);$j++){
                    $modelIntersect = array_intersect($colorsArr[$i], $colorsArr[$j]);
                    if(!empty($modelIntersect)){
                        $modelStr = array_shift($modelIntersect);
                        $model = HoroscopeModelByColor::model()->findByAttributes(['model_id' => $modelStr]);
                        if (!$model->is_in_pare && $model->model->is_available && $model->model->is_show){
                            array_push($modelsArr, $modelStr);
                            array_push($modelsRes, $model);
                            unset($colorsArr[$j][array_search($modelStr, $colorsArr[$j])]);
                            $isPareModelAdd = true;
                            break;
                        } else {
                            unset($colorsArr[$i][array_search($modelStr, $colorsArr[$i])]);
                            unset($colorsArr[$j][array_search($modelStr, $colorsArr[$j])]);
                        }
                    }
                }
                if(!$isPareModelAdd) {
                    $m = HoroscopeModelByColor::getRandModel($colorsArr[$i]);
                    if($m && !in_array($m->model_id, $modelsArr)){
                        $modelsRes[$i] = $m;
                    }
                }
            } elseif(!empty($colorsArr[$i])) {
                $m = HoroscopeModelByColor::getRandModel($colorsArr[$i]);
                if($m && !in_array($m->model_id, $modelsArr)){
                    $modelsRes[$i] = $m;
                }
            }
        }
        return $modelsRes;
    }

    public static function getRandModel($modelArr){
        $modelArr = array_values($modelArr);
	    $key = rand(1, (count($modelArr)));
        $modelStr = $modelArr[$key-1];
	    $model = HoroscopeModelByColor::model()->findByAttributes(['model_id' => $modelStr]);

	    if (!$model->is_in_pare && $model->model->is_available && $model->model->is_show){
	        return $model;
        } else {
            unset($modelArr[array_search($modelStr, $modelArr)]);
            if(!empty($modelArr)){
                return HoroscopeModelByColor::getRandModel($modelArr);
            } else
                return false;
        }
    }
}

