<?php

/**
 * This is the model class for table "mc_part".
 *
 * The followings are the available columns in table 'mc_part':
 * @property integer $p_id
 * @property string $p_name
 * @property string $p_note
 * @property integer $ec_id
 * @property integer $p_type
 */
class Part extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mc_part';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('p_name', 'required'),
			array('ec_id, p_type', 'numerical', 'integerOnly'=>true),
			array('p_note', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('p_id, p_name, ec_id, p_type,p_note', 'safe', 'on'=>'search'),
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
			'p_id' => '#',
			'p_name' => 'Tên Phần',
			'p_note' => 'Ghi chú',
			'ec_id' => 'Mã Đề',
			'p_type' => 'Loại',//1 - nghe, 2 - đọc
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

		$criteria->compare('p_id',$this->p_id);
		$criteria->compare('p_name',$this->p_name,true);
		$criteria->compare('p_note',$this->p_note,true);
		$criteria->compare('ec_id',$this->ec_id);
		$criteria->compare('p_type',$this->p_type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Part the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
