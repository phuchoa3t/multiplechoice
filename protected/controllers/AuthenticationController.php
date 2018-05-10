<?php

class AuthenticationController extends Controller
{
	public $defaultAction = 'login';
	protected function beforeAction($event)
    {
    	//Do something
    	return true;
    }
    
	public function actionLogin()
	{
		//Check if logged -> back to home
		if (!Yii::app()->user->isGuest)
	        $this->redirect(Yii::app()->homeUrl);
	    $model = new LoginForm('login');
	    if (isset($_POST['LoginForm'])) {
	        $model->attributes = $_POST['LoginForm'];
	        if ($model->validate('login') && $model->login()) {
	        	Yii::app()->user->setFlash('WelcomeBack', "Welcome back!<br/>How are you?");
	            $this->redirect(Yii::app()->baseUrl."/admin");
	        }
	    }
		$this->layout = 'login';
	    $this->render('login', array('model' => $model));
	}
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->baseUrl.'/authentication/login');
	}

	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
        {
        	$this->layout = 'error';
        	$this->render('error', $error);
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