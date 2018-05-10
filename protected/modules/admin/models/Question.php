<?php

/**
 * This is the model class for table "mc_question".
 *
 * The followings are the available columns in table 'mc_question':
 * @property integer $qs_id
 * @property integer $qs_num
 * @property string $qs_content
 * @property string $qs_note
 * @property integer $ec_id
 * @property integer $p_id
 * @property integer $as_id
 *
 * The followings are the available model relations:
 * @property Answer[] $answers
 */
class Question extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mc_question';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ec_id', 'required'),
			array('qs_num, ec_id, p_id, as_id', 'numerical', 'integerOnly'=>true),
			array('qs_content, qs_note', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('qs_id, qs_num, qs_content, qs_note, ec_id, p_id, as_id', 'safe', 'on'=>'search'),
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
			'answers' => array(self::HAS_MANY, 'Answer', 'qs_id'),
			'part' => array(self::BELONGS_TO, 'Part', 'p_id'),
			'ec' => array(self::BELONGS_TO, 'Examcode', 'ec_id'),
			'as' => array(self::BELONGS_TO, 'Answer', 'as_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'qs_id' => 'Question ID',
			'qs_num' => 'Câu Hỏi Số',
			'qs_content' => 'Nội Dung',
			'qs_note' => 'Ghi chú',
			'ec_id' => 'Mã Đề',
			'p_id' => 'Mã Phần',
			'as_id' => 'Đáp Án',
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

		$criteria->compare('qs_id',$this->qs_id);
		$criteria->compare('qs_num',$this->qs_num);
		$criteria->compare('qs_content',$this->qs_content,true);
		$criteria->compare('qs_note',$this->qs_note,true);
		$criteria->compare('ec_id',$this->ec_id);
		$criteria->compare('p_id',$this->p_id);
		$criteria->compare('as_id',$this->as_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Question the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	protected function afterSave() {
		$answers = Yii::app()->request->getPost('answer');
		$correct = Yii::app()->request->getPost('as');
		$question_id = $this->qs_id;
		$ans = Answer::model()->findAll('qs_id=:qs', array(':qs'=>$question_id));
		if(count($ans)){
			
		} else {
			foreach ($answers as $key => $value) {
				preg_match('/as-(\d+)/', $key, $arr);
				if(!empty($arr)){
					$as = new Answer;
					$as->qs_id = $question_id;
					$as->as_value = $value;
					$as->save();
					if($correct == $arr[1]){
						$q = Question::model()->findByPk($question_id);
						$q->as_id = $as->as_id;
						$q->save();
					}
				}
			}
		}
	}
}
