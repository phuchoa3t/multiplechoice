<?php

/**
 * This is the model class for table "mc_result".
 *
 * The followings are the available columns in table 'mc_result':
 * @property integer $rs_id
 * @property integer $st_id
 * @property integer $ec_id
 * @property integer $b_id
 * @property string $data
 *
 * The followings are the available model relations:
 * @property Bout $b
 */
class Result extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public $point;
	public $sj_id;
	public $st_code;
	public $b_type;
	public $st_class;

	public function tableName()
	{
		return 'mc_result';
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
			array('rs_id, st_id, ec_id, b_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('rs_id,b_type, sj_id,st_code,st_id, ec_id, b_id, point, cancel, st_class', 'safe', 'on'=>'search'),
			array('rs_id,b_type, sj_id,st_code,st_id, ec_id, b_id, point, cancel, st_class', 'safe', 'on'=>'export'),
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
			'st' => array(self::BELONGS_TO, 'Student', 'st_id'),
			'ec' => array(self::BELONGS_TO, 'Examcode', 'ec_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'rs_id' => '#',
			'st_id' => 'Sinh Viên',
			'ec_id' => 'Mã Đề',
			'b_id' => 'Đợt',
			'data' => 'Dữ Liệu',
			'point'=>'Điểm',
			'cancel'=>'Hủy Bài',
			'sj_id'=>'Môn',
			'st_code'=>'Mã sinh viên',
			'b_type'=>'Hình thức',
			'reason'=>'Lý Do Hủy'
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
		$criteria->with = array("b", "st");
		$criteria->compare('rs_id',$this->rs_id);
		$criteria->compare('b.sj_id',$this->sj_id);
		$criteria->compare('b.b_type',$this->b_type);
		$criteria->compare('st.st_code',$this->st_code);
		$criteria->compare('ec_id',$this->ec_id);
		$criteria->compare('b.b_id',$this->b_id);
		$criteria->compare('point',$this->point);
		$criteria->compare('cancel',$this->cancel);
		$criteria->compare('reason',$this->reason);
		$criteria->compare('data',$this->data,true);
		$criteria->addSearchCondition('st.st_class', $this->st_class, true);
 		$criteria->order = 'rs_id DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function export()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->with = array("b", "st");
		$criteria->compare('b.sj_id',$this->sj_id);
		$criteria->compare('rs_id',$this->rs_id);
		$criteria->compare('b.b_type',$this->b_type);
		$criteria->compare('st_id',$this->st_id);
		$criteria->compare('st.st_code',$this->st_code);
		$criteria->compare('ec_id',$this->ec_id);
		$criteria->compare('b.b_id',$this->b_id);
		$criteria->compare('point',$this->point);
		$criteria->compare('cancel',$this->cancel);
		$criteria->compare('reason',$this->reason);
		$criteria->compare('data',$this->data,true);
		$criteria->addSearchCondition('st.st_class', $this->st_class, true);
 		$criteria->order = 'length(st.st_sbd), st.st_sbd, st.st_class DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>false,
		));
	}

	public function getClass()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		$criteria->with = array("b", "st");
		$criteria->compare('b.sj_id',$this->sj_id);
		$criteria->compare('rs_id',$this->rs_id);
		$criteria->compare('b.b_type',$this->b_type);
		$criteria->compare('st_id',$this->st_id);
		$criteria->compare('st.st_code',$this->st_code);
		$criteria->compare('ec_id',$this->ec_id);
		$criteria->compare('b.b_id',$this->b_id);
		$criteria->compare('point',$this->point);
		$criteria->compare('cancel',$this->cancel);
		$criteria->compare('reason',$this->reason);
		$criteria->compare('data',$this->data,true);
 		$criteria->group = 'st.st_class';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>false,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Result the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public function getResultTOEIC($type = 0)
	{

		$mapPointTOEIC = array(
						  '0'=>array('1'=>'5', '2'=>'5'),
						  '1'=>array('1'=>'5', '2'=>'5'),
						  '2'=>array('1'=>'5', '2'=>'5'),
						  '3'=>array('1'=>'5', '2'=>'5'),
						  '4'=>array('1'=>'5', '2'=>'5'),
						  '5'=>array('1'=>'5', '2'=>'5'),
						  '6'=>array('1'=>'5', '2'=>'5'),
						  '7'=>array('1'=>'10', '2'=>'5'),
						  '8'=>array('1'=>'15', '2'=>'5'),
						  '9'=>array('1'=>'20', '2'=>'5'),
						  '10'=>array('1'=>'25', '2'=>'10'),
						  '11'=>array('1'=>'30', '2'=>'15'),
						  '12'=>array('1'=>'35', '2'=>'20'),
						  '13'=>array('1'=>'40', '2'=>'25'),
						  '14'=>array('1'=>'45', '2'=>'30'),
						  '15'=>array('1'=>'50', '2'=>'35'),
						  '16'=>array('1'=>'55', '2'=>'40'),
						  '17'=>array('1'=>'60', '2'=>'45'),
						  '18'=>array('1'=>'65', '2'=>'50'),
						  '19'=>array('1'=>'70', '2'=>'55'),
						  '20'=>array('1'=>'75', '2'=>'60'),
						  '21'=>array('1'=>'80', '2'=>'65'),
						  '22'=>array('1'=>'85', '2'=>'70'),
						  '23'=>array('1'=>'90', '2'=>'75'),
						  '24'=>array('1'=>'95', '2'=>'80'),
						  '25'=>array('1'=>'100', '2'=>'90'),
						  '26'=>array('1'=>'105', '2'=>'95'),
						  '27'=>array('1'=>'110', '2'=>'100'),
						  '28'=>array('1'=>'115', '2'=>'110'),
						  '29'=>array('1'=>'120', '2'=>'115'),
						  '30'=>array('1'=>'125', '2'=>'120'),
						  '31'=>array('1'=>'135', '2'=>'125'),
						  '32'=>array('1'=>'140', '2'=>'130'),
						  '33'=>array('1'=>'145', '2'=>'135'),
						  '34'=>array('1'=>'150', '2'=>'140'),
						  '35'=>array('1'=>'155', '2'=>'145'),
						  '36'=>array('1'=>'160', '2'=>'150'),
						  '37'=>array('1'=>'165', '2'=>'155'),
						  '38'=>array('1'=>'170', '2'=>'160'),
						  '39'=>array('1'=>'180', '2'=>'170'),
						  '40'=>array('1'=>'185', '2'=>'175'),
						  '41'=>array('1'=>'190', '2'=>'180'),
						  '42'=>array('1'=>'195', '2'=>'185'),
						  '43'=>array('1'=>'200', '2'=>'195'),
						  '44'=>array('1'=>'210', '2'=>'200'),
						  '45'=>array('1'=>'220', '2'=>'205'),
						  '46'=>array('1'=>'225', '2'=>'210'),
						  '47'=>array('1'=>'230', '2'=>'220'),
						  '48'=>array('1'=>'235', '2'=>'225'),
						  '49'=>array('1'=>'240', '2'=>'230'),
						  '50'=>array('1'=>'245', '2'=>'235'),
						  '51'=>array('1'=>'250', '2'=>'240'),
						  '52'=>array('1'=>'255', '2'=>'250'),
						  '53'=>array('1'=>'260', '2'=>'255'),
						  '54'=>array('1'=>'270', '2'=>'260'),
						  '55'=>array('1'=>'275', '2'=>'270'),
						  '56'=>array('1'=>'280', '2'=>'275'),
						  '57'=>array('1'=>'285', '2'=>'280'),
						  '58'=>array('1'=>'295', '2'=>'285'),
						  '59'=>array('1'=>'300', '2'=>'290'),
						  '60'=>array('1'=>'305', '2'=>'295'),
						  '61'=>array('1'=>'310', '2'=>'300'),
						  '62'=>array('1'=>'315', '2'=>'305'),
						  '63'=>array('1'=>'320', '2'=>'310'),
						  '64'=>array('1'=>'325', '2'=>'320'),
						  '65'=>array('1'=>'330', '2'=>'325'),
						  '66'=>array('1'=>'335', '2'=>'330'),
						  '67'=>array('1'=>'340', '2'=>'335'),
						  '68'=>array('1'=>'345', '2'=>'340'),
						  '69'=>array('1'=>'350', '2'=>'345'),
						  '70'=>array('1'=>'360', '2'=>'350'),
						  '71'=>array('1'=>'365', '2'=>'355'),
						  '72'=>array('1'=>'370', '2'=>'360'),
						  '73'=>array('1'=>'375', '2'=>'365'),
						  '74'=>array('1'=>'380', '2'=>'370'),
						  '75'=>array('1'=>'390', '2'=>'375'),
						  '76'=>array('1'=>'395', '2'=>'380'),
						  '77'=>array('1'=>'400', '2'=>'385'),
						  '78'=>array('1'=>'405', '2'=>'390'),
						  '79'=>array('1'=>'410', '2'=>'395'),
						  '80'=>array('1'=>'420', '2'=>'400'),
						  '81'=>array('1'=>'425', '2'=>'405'),
						  '82'=>array('1'=>'430', '2'=>'405'),
						  '83'=>array('1'=>'435', '2'=>'410'),
						  '84'=>array('1'=>'440', '2'=>'415'),
						  '85'=>array('1'=>'450', '2'=>'420'),
						  '86'=>array('1'=>'455', '2'=>'425'),
						  '87'=>array('1'=>'460', '2'=>'430'),
						  '88'=>array('1'=>'470', '2'=>'435'),
						  '89'=>array('1'=>'475', '2'=>'445'),
						  '90'=>array('1'=>'480', '2'=>'450'),
						  '91'=>array('1'=>'485', '2'=>'455'),
						  '92'=>array('1'=>'490', '2'=>'465'),
						  '93'=>array('1'=>'495', '2'=>'470'),
						  '94'=>array('1'=>'495', '2'=>'480'),
						  '95'=>array('1'=>'495', '2'=>'485'),
						  '96'=>array('1'=>'495', '2'=>'490'),
						  '97'=>array('1'=>'495', '2'=>'495'),
						  '98'=>array('1'=>'495', '2'=>'495'),
						  '99'=>array('1'=>'495', '2'=>'495'),
						  '100'=>array('1'=>'495', '2'=>'495'));
		$data = json_decode($this->data);
		$numListen = 0;
		$numRead = 0;
		foreach ($data as $question => $answer) {
			$q = Question::model()->findByPk($question);
			if(intval($q->as_id) == intval($answer)){
				if($q->part->p_type == 1){
					$numListen++;
				} elseif($q->part->p_type ==2){
					$numRead++;
				}
			}
		}
		$point = intval($mapPointTOEIC[$numListen][1]) + intval($mapPointTOEIC[$numRead][2]);

		if($type == 1){
			$ten_point = [
				[0, 17,	0],
				[18, 35,	0.5],
				[36 , 53,	1],
				[54 , 70,	1.5],
				[71 , 88,	2],
				[89 , 105	,2.5],
				[106 , 123	,3],
				[124 , 140	,3.5 ],
				[141 , 158	,4],
				[159 , 175	,4.5 ],
				[176 , 193	,5],
				[194 , 210	,5.5 ],
				[211 , 228,	6],
				[229 , 245,	6.5],
				[246 , 263	,7],
				[264 , 280	,7.5 ],
				[281 , 298	,8],
				[299 , 315	,8.5],
				[316 , 333	,9],
				[334 , 350	,9.5 ],
				[351 , 360	,10]
			];

			foreach ($ten_point as $key => $value) {
				if($point >= $value[0] && $point <= $value[1]){
					return $value[2];
				}
			}
			return 0;

		}
		return ($type == 0)?$point:array('listen'=>array('correct'=>$numListen, 'point'=>intval($mapPointTOEIC[$numListen][1])),'read'=>array('correct'=>$numRead, 'point'=>intval($mapPointTOEIC[$numRead][2])));
	}

	public function cancel($reason="")
	{
		$this->cancel = !$this->cancel;
		$this->reason = $reason;
		$this->update();
	}

	public function getResultTest(){
		$point = 0;
		$count_point = $this->b->b_type == 1 ? 0.5 : 0.2;
		$data = json_decode($this->data);
		foreach ($data as $question => $answer) {
			$q = Question::model()->findByPk($question);
			if(intval($q->as_id) == intval($answer)){
				$point += $count_point;
			}
		}
		return $point;
	}


	public function getResultTOEICCC(){
		$point = 0;
		$data = json_decode($this->data);
		foreach ($data as $question => $answer) {
			$q = Question::model()->findByPk($question);
			if(intval($q->as_id) == intval($answer)){
				$count_point = 1.5;
				if($q->part->p_type == 2){
					$count_point = 1;
				}
				$point += $count_point;
			}
		}
		return floatval($point / 10);
	}
}
