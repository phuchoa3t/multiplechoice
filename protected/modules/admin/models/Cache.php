<?php

/**
 * This is the model class for table "mc_cache".
 *
 * The followings are the available columns in table 'mc_cache':
 * @property integer $c_id
 * @property integer $st_id
 * @property integer $ec_id
 * @property integer $b_id
 * @property string $data
 *
 * The followings are the available model relations:
 * @property Bout $b
 */
class Cache extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mc_cache';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('st_id, ec_id, b_id, data', 'required'),
			array('c_id, st_id, ec_id, b_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('c_id, st_id, ec_id, b_id, data', 'safe', 'on'=>'search'),
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
			'b' => array(self::BELONGS_TO, 'Bout', 'b_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'c_id' => '#',
			'st_id' => 'Sinh Viên',
			'ec_id' => 'Mã Đề',
			'b_id' => 'Đợt',
			'data' => 'Thông Tin',
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

		$criteria->compare('c_id',$this->c_id);
		$criteria->compare('st_id',$this->st_id);
		$criteria->compare('ec_id',$this->ec_id);
		$criteria->compare('b_id',$this->b_id);
		$criteria->compare('data',$this->data,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cache the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
