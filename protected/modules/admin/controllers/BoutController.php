<?php

class BoutController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view', 'ajax'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'expression'=> array($this,'AcceptAdmin'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin'),
				'expression'=> array($this,'AcceptAdmin'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin', 'status'),
				'expression'=> array($this,'AcceptAdmin'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete'),
				'expression'=> array($this,'AcceptDelete'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('create'),
				'expression'=> array($this,'AcceptCreate'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('update'),
				'expression'=> array($this,'AcceptUpdate'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function AcceptAdmin()
	{
		if(strpos(isset(Yii::app()->user->role)?(Yii::app()->user->role):"", "A")!==false){
			return true;
		} else {
			return false;
		}
	}

	public function AcceptCreate()
	{
		if(strpos(isset(Yii::app()->user->role)?(Yii::app()->user->role):"", "C")!==false){
			return true;
		} else {
			return false;
		}
	}

	public function AcceptDelete()
	{
		if(strpos(isset(Yii::app()->user->role)?(Yii::app()->user->role):"", "D")!==false){
			return true;
		} else {
			return false;
		}
	}

	public function AcceptUpdate()
	{
		if(strpos(isset(Yii::app()->user->role)?(Yii::app()->user->role):"", "U")!==false){
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Bout;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Bout']))
		{
			$_POST['Bout']['ec_id'] = implode(",", $_POST['Bout']['ec_id']);
			$model->attributes=$_POST['Bout'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->b_id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Bout']))
		{
			$_POST['Bout']['ec_id'] = implode(",", $_POST['Bout']['ec_id']);
			$model->attributes=$_POST['Bout'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->b_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	/**
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Bout');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	*/

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new Bout('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Bout']))
			$model->attributes=$_GET['Bout'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Bout the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Bout::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Bout $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='bout-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionStatus($id)
	{
		$this->loadModel($id)->status();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_GET['returnUrl']) ? $_GET['returnUrl'] : array('index'));
	}


	public function actionAjax($type='', $id='')
	{
		$sj_id = isset($_POST['sj_id'])?intval($_POST['sj_id']):0;
		$result = Examcode::model()->findAll('sj_id=:id', array(':id'=>$sj_id));
		$result = CHtml::listData($result,'ec_id','ec_name');
		foreach ($result as $value => $name) {
				// echo CHtml::tag('optgroup', array('label'=>$name),CHtml::encode($name), true);
				echo CHtml::tag('option', array('value'=>$value), CHtml::encode($name), true);
		}
	}
}
