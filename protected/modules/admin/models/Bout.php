<?php

/**
 * This is the model class for table "mc_bout".
 *
 * The followings are the available columns in table 'mc_bout':
 * @property integer $b_id
 * @property string $b_name
 * @property string $b_config
 * @property integer $b_status
 * @property integer $b_time
 * @property integer $ec_id
 *
 * The followings are the available model relations:
 * @property Cache[] $caches
 * @property Result[] $results
 */
class Bout extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mc_bout';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('b_name, b_config, b_status, b_time, ec_id, sj_id, b_type', 'required'),
			array('b_status, b_time', 'numerical', 'integerOnly'=>true),
			array('b_name', 'length', 'max'=>100),
			array('b_config', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('b_id, b_name, b_config, b_status, b_time, ec_id, sj_id, b_type', 'safe', 'on'=>'search'),
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
			'caches' => array(self::HAS_MANY, 'Cache', 'b_id'),
			'results' => array(self::HAS_MANY, 'Result', 'b_id'),
			'sj' => array(self::BELONGS_TO, 'Subject', 'sj_id'),
			'ec' => array(self::BELONGS_TO, 'Examcode', 'ec_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'b_id' => '#',
			'b_name' => 'Tên Đợt',
			'b_config' => 'Cấu Hình',
			'b_status' => 'Trạng Thái',
			'b_time' => 'Thời Gian',
			'ec_id' => 'Mã Đề',
			'sj_id' => 'Môn thi',
			'b_type' => 'Hình thức',
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

		$criteria->compare('b_id',$this->b_id);
		$criteria->compare('b_name',$this->b_name,true);
		$criteria->compare('b_config',$this->b_config,true);
		$criteria->compare('b_status',$this->b_status);
		$criteria->compare('b_time',$this->b_time);
		$criteria->compare('ec_id',$this->ec_id);
 		$criteria->order = 'b_id DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Bout the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function status()
	{
		$this->b_status = !$this->b_status;
		$this->update();
	}
}
