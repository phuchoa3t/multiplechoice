<?php

class UserController extends Controller
{
	public $defaultAction = 'view';
	public $footer = "";

	public function actionView()
	{
		if(strpos(isset(Yii::app()->user->role)?Yii::app()->user->role:"", "A")===false){
			Yii::app()->user->setFlash('error','Bạn không có quyền này!');
			$this->redirect(Yii::app()->createUrl('admin/'));
		}
		if(isset($_GET['status'])&&intval($_GET['status'])){
			$UI = intval($_GET['status']);
			$noaccept = (count(Account::model()->findByPk($UI)))?(strpos(Account::model()->findByPk($UI)['Role'], "S")!==false):true;
			if(Yii::app()->user->id==$UI||$noaccept){
				Yii::app()->user->setFlash('error','Bạn không thể thay đổi tài khoản này!');
				$this->redirect(Yii::app()->createUrl('admin/user'));
			} else {
				$UX = Account::model()->findByPk($UI);
				$UX->isActive = !$UX->isActive;
				$UX->update();
				Yii::app()->user->setFlash('success','Thay đổi trạng thái tài khoản thành công!');
				$this->redirect(Yii::app()->createUrl('admin/user'));
			}
		}
		if(isset($_GET['del'])&&intval($_GET['del'])){
			$UI = intval($_GET['del']);
			$noaccept = (count(Account::model()->findByPk($UI)))?(strpos(Account::model()->findByPk($UI)['Role'], "S")!==false):true; //Tài khoản quản trị cao nhất
			if(Yii::app()->user->id==$UI||$noaccept){
				Yii::app()->user->setFlash('error','Bạn không thể xóa tài khoản này!');
				$this->redirect(Yii::app()->createUrl('admin/user'));
			} else {
				Account::model()->deleteByPk($UI);
				Yii::app()->user->setFlash('success','Xóa thành công!');
				$this->redirect(Yii::app()->createUrl('admin/user'));
			}
		}
		if(isset($_POST['btnSetCRUD'])&&isset($_POST['forID'])&&intval($_POST['forID'])){
			$ID = intval($_POST['forID']);
			$noaccept = (count(Account::model()->findByPk($ID)))?(strpos(Account::model()->findByPk($ID)['Role'], "S")!==false):true;
			if(Yii::app()->user->id==$ID||$noaccept){
				Yii::app()->user->setFlash('error','Bạn không thể thay đổi quyền của chính mình hoặc Quản trị web!');
				$this->redirect(Yii::app()->createUrl('admin/user'));
			}
			$R  = null;
			if(isset($_POST['xA'])){
				$R .= "A";
			}
			if(isset($_POST['xC'])){
				$R .= (empty($R)?"C":"-C");
			}
				$R .= (empty($R)?"R":"-R");
			if (isset($_POST['xU'])) {
				$R .= (empty($R)?"U":"-U");
			}
			if (isset($_POST['xD'])) {
				$R .= (empty($R)?"D":"-D");
			}
			$U = Account::model()->find('ID=:ID', array(':ID'=>$ID));
			if(count($U)){
				$U->Role = $R;
				$U->update();
				Yii::app()->user->setFlash('success','Thay đổi quyền thành công!');
				$this->redirect(Yii::app()->createUrl('admin/user'));
			} else {
				Yii::app()->user->setFlash('error','Có lỗi xảy ra! Người dùng này không tồn tại');
				$this->redirect(Yii::app()->createUrl('admin/user'));
			}
		}
		$this->render('view');
	}

	public function actionAdd()
	{
		if(strpos(isset(Yii::app()->user->role)?Yii::app()->user->role:"", "A")===false){
			Yii::app()->user->setFlash('error','Bạn không có quyền này!');
			$this->redirect(Yii::app()->createUrl('admin/'));
		}
		$msg = array();
		$model = new AUForm();
		if(isset($_POST['AUForm'])){
			$model->attributes = $_POST['AUForm'];
			if($model->validate()){
				$U = new Account();
				$U->attributes = $model->attributes;
				$U->Password = md5($U->Password);
				if($U->save()){
					$msg[] = array('success'=>"Thêm người dùng thành công!");
				} else $msg[] = array('error'=>"Thêm người dùng thất bại!");
			}
		}
		$this->render('add', array('model' => $model, 'msg'=>$msg));
	}

	public function filters()
    {
        return array(
            'accessControl',
        );
    }
	//accessRules
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('view','add'),
				'expression'=> array($this,'AcceptAdmin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function AcceptAdmin()
	{
		if(strpos(isset(Yii::app()->user->role)?Yii::app()->user->role:"", "A")!==false){
			return true;
		} else {
			return false;
		}
	}

	public function AcceptSuperAdmin()
	{
		if(strpos(isset(Yii::app()->user->role)?Yii::app()->user->role:"", "S")!==false){
			return true;
		} else {
			return false;
		}
	}
}