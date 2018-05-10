<?php

/**
 * This is the model class for table "mc_student".
 *
 * The followings are the available columns in table 'mc_student':
 * @property integer $st_id
 * @property string $st_sbd
 * @property string $st_code
 * @property string $st_name
 * @property string $st_dob
 * @property integer $st_sex
 * @property string $st_class
 */
class Student extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mc_student';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('st_sbd, st_code, st_name, st_dob, st_sex, st_class', 'required'),
			array('st_sex', 'numerical', 'integerOnly'=>true),
			array('st_sbd, st_class', 'length', 'max'=>20),
			array('st_code, st_dob', 'length', 'max'=>50),
			array('st_name', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('st_id, st_sbd, st_code, st_name, st_dob, st_sex, st_class', 'safe', 'on'=>'search'),
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
			'st_id' => '#',
			'st_sbd' => 'SDB',
			'st_code' => 'Mã SV',
			'st_name' => 'Họ Tên',
			'st_dob' => 'St Dob',
			'st_sex' => 'Giới Tính',
			'st_class' => 'Lớp',
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

		$criteria->compare('st_id',$this->st_id);
		$criteria->compare('st_sbd',$this->st_sbd,true);
		$criteria->compare('st_code',$this->st_code,true);
		$criteria->compare('st_name',$this->st_name,true);
		$criteria->compare('st_dob',$this->st_dob,true);
		$criteria->compare('st_sex',$this->st_sex);
		$criteria->compare('st_class',$this->st_class,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Student the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
