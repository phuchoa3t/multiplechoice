<?php

class ExamController extends FrontendController
{
	public $defaultAction = 'question';
	public function actionQuestion()
	{
		$obj_id = Yii::app()->session['obj_id'];
		$class = Yii::app()->session['class'];
		$sj_id = Yii::app()->session['sj_id'];
		$sys_id = Yii::app()->session['sys_id'];
		$tc_id = Yii::app()->session['tc_id'];
		$sc_id = Yii::app()->session['sc_id'];
		$en_id = Yii::app()->session['en_id'];

		if((int)$obj_id != 0){
			if(isset($_POST) && !empty($_POST)){
				foreach ($_POST as $qs_id => $as_id) {
					$model = new SuvResult();
					$model->obj_id = $obj_id;
					$model->sys_id = $sys_id;
					$model->tc_id = $tc_id;
					$model->sj_id = $sj_id;
					$model->qs_id = $qs_id;
					$model->as_id = $as_id;
					$model->sc_id = $sc_id;
					$model->en_id = $en_id;
					$model->save();
				}
				$this->redirect(Yii::app()->createUrl('survey/thankyou'));
			}
			$this->render('index', compact("questions"));
		}else{
			$this->redirect('index');
		}
	}

	public function actionThankyou($value='')
	{
		$this->render('thankyou');
	}

	public function actionAjax($type='')
	{
		if(intval($type)==1){
			if(isset($_POST['class'])){
				Yii::app()->session['class'] = $_POST['class'];
				$result = SuvSc::model()->findAll('class=:id', array(':id'=>$_POST['class']));
				$result = CHtml::listData($result,'sj_id','sj_name');
				echo CHtml::tag('option', array('value'=>''),CHtml::encode('--- Môn Học ---'), true);
				foreach ($result as $value => $name) {
					echo CHtml::tag('option', array('value'=>$value),CHtml::encode($name), true);
				}
			}
		} elseif (intval($type==2)) {
			if(isset($_POST['sj_id'])){
				$class = isset(Yii::app()->session['class'])?Yii::app()->session['class']:"";
				Yii::app()->session['sj_id'] = $_POST['sj_id'];
				$result = SuvSc::model()->with('teacher')->find('sj_id=:id AND class=:cl', array(':id'=>$_POST['sj_id'], ':cl'=>$class));
				preg_match("/(.*) (.*)/", $result->teacher->tc_name, $name);
				$hiddenname = "";
				if(is_array($name)){
					$hiddenname = $name[1]." ";
					for ($i=0; $i < count(str_split($name[2])); $i++) { 
						$hiddenname .= "*";
					}
				}
				echo ("Giảng Viên: ".$hiddenname);
			}
		}
	}

	public function actionCheck($value='')
	{
		if(isset($_POST['data'])){
			foreach ($_POST['data'] as $qs_id => $as_id) {
				if(isset($_POST['questionIds'][$qs_id]) && (int) $as_id != 0){
					unset($_POST['questionIds'][$qs_id]);
				}
			}
		}
		echo json_encode($_POST['questionIds']);
	}

	public function actionResult()
	{
		$en_id = Yii::app()->request->getParam('en_id');
		
		if((int)$en_id != 0){
			$this->render('result');
		}else{
			$this->redirect(Yii::app()->createUrl('home/enterprise'));
		}
	}
	public function actionResultStudent()
	{
		$sys_id = Yii::app()->request->getParam('sys_id');
		$sc_id = Yii::app()->request->getParam('sc_id');

		if((int)$sys_id != 0 && $sc_id != 0){
			$this->render('result_student');
		}else{
			$this->redirect(Yii::app()->createUrl('home/index'));
		}
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}