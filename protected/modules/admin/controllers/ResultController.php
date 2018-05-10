<?php

class ResultController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow super user to perform 'export' actions
				'actions'=>array('export'),
				'expression'=> array($this,'AcceptSuper'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','cancel'),
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

	public function AcceptSuper()
	{
		if(strpos(isset(Yii::app()->user->role)?(Yii::app()->user->role):"", "S")!==false){
			return true;
		} else {
			return false;
		}
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
		$this->layout = "//layouts/frontend";
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
		$model=new Result;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Result']))
		{
			$model->attributes=$_POST['Result'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->rs_id));
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

		if(isset($_POST['Result']))
		{
			$model->attributes=$_POST['Result'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->rs_id));
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
		$dataProvider=new CActiveDataProvider('Result');
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
		$model=new Result('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Result']))
			$model->attributes=$_GET['Result'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Result the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Result::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Result $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='result-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionCancel($id, $reason = "")
	{
		$this->loadModel($id)->cancel(Yii::app()->request->getParam('reason'));

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_GET['returnUrl']) ? $_GET['returnUrl'] : array('index'));
	}

	public function actionExport()
	{
		if(!isset($_GET['Result'])){
			header('Content-Type: application/json');
			echo json_encode(['error' => 'Không thể thực hiện chức năng này vui lòng kiểm tra dữ liệu']);
			exit();
		}

		if($_GET['Result']['sj_id']){
			Yii::import('ext.phpexcel.XPHPExcel');
	    	$objPHPExcel= XPHPExcel::createPHPExcel();
	    	$objPHPExcel->getProperties()->setCreator("Anh Production")
	                             		->setLastModifiedBy("Anh Production")
	                             		->setTitle("TOEIC")
	                             		->setSubject("TOEIC")
	                             		->setDescription("Create by Anh Production")
	                            		->setKeywords("FB: fb.com/anhproduction")
	                            	 	->setCategory("Email: ndna2606@gmail.com");
			$objPHPExcel->getDefaultStyle()->getFont()->setName('Times New Roman');
			//Var Style
			$center = array(//Text center
		        'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,));
		    $vcenter = array(//Text center
		        'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,));
		    $right = array(//Text Right
		        'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,));
		    $left = array(//Text Right
		        'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,));
		    $underline = array(//Text underline
		        'font' => array('underline' => PHPExcel_Style_Font::UNDERLINE_SINGLE));
		    $bold = array(//Text underline
		        'font' => array('bold' => true));

		    $subject = Subject::model()->findByPk(intval($_GET['Result']['sj_id']));
		    $subjectName = "Undefined";
		    $subjectCode = "Undefined";
		    if($subject) {
		    	$subjectName = $subject->sj_name;
		    	$subjectCode = $subject->sj_code;
		    }
		    $model=new Result();
			$model->unsetAttributes();  // clear any default values
			if(isset($_GET['Result'])) {
				$model->attributes=$_GET['Result'];
			}
			if(isset($_GET['Result']['sj_id'])){
				$model->sj_id = $_GET['Result']['sj_id'];
			}
			if(isset($_GET['Result']['b_type'])){
				$model->b_type = $_GET['Result']['b_type'];
			}

			$d = $model->getClass();
			$classes = $d->getData();
			foreach ($classes as $i => $class) {
				// Add new sheet
			    $objWorkSheet = $objPHPExcel->createSheet($i); //Setting index when creating

			    $objWorkSheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT)
			    							 ->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4)
			    							 ->setRowsToRepeatAtTopByStartAndEnd(11, 12)
											 ->setFitToPage(true)
											 ->setFitToWidth(1)
											 ->setFitToHeight(0)
											 ->setHorizontalCentered(1);

			    //Row cell height, width
			    $objWorkSheet->getRowDimension('1')->setRowHeight(3.25);
			    $objWorkSheet->getRowDimension('2')->setRowHeight(6);
			    $objWorkSheet->getRowDimension('3')->setRowHeight(15);//19
			    $objWorkSheet->getRowDimension('4')->setRowHeight(15);
			    $objWorkSheet->getRowDimension('5')->setRowHeight(3);
			    $objWorkSheet->getRowDimension('6')->setRowHeight(5.25);
			    $objWorkSheet->getRowDimension('7')->setRowHeight(4.5);
			    $objWorkSheet->getRowDimension('8')->setRowHeight(15);
			    $objWorkSheet->getRowDimension('9')->setRowHeight(15);
			    $objWorkSheet->getRowDimension('10')->setRowHeight(7.5);
			    $objWorkSheet->getRowDimension('11')->setRowHeight(14.25);
			    $objWorkSheet->getRowDimension('12')->setRowHeight(14.25);
				$objWorkSheet->getColumnDimension('A')->setWidth(4.43);
				$objWorkSheet->getColumnDimension('B')->setWidth(5.9);
				$objWorkSheet->getColumnDimension('C')->setWidth(14);
				$objWorkSheet->getColumnDimension('D')->setWidth(23.2);
				$objWorkSheet->getColumnDimension('E')->setWidth(4.7);
				$objWorkSheet->getColumnDimension('F')->setWidth(10.4);
				$objWorkSheet->getColumnDimension('G')->setWidth(12);
				$objWorkSheet->getColumnDimension('H')->setWidth(5.4);
				$objWorkSheet->getColumnDimension('I')->setWidth(28.2);

			    //Write cells
			    $dataExam = date("d/m/Y");
			    $objWorkSheet->setCellValue('A3', 'BỘ GIAO THÔNG VẬN TẢI')
			    		->mergeCells('A3:E3')
			            ->setCellValue('A4', 'TRƯỜNG ĐẠI HỌC CÔNG NGHỆ GTVT')
			    		->mergeCells('A4:E4')
			            ->setCellValue('F3', 'KẾT QUẢ KIỂM TRA TRẮC NGHIỆM TRÊN MÁY')
			    		->mergeCells('F3:I3')
			            ->setCellValue('F4', '')
			    		->mergeCells('F4:I4')
			            ->setCellValue('B8', "Lớp:")
			            ->setCellValue('C8', $class->st->st_class)
			            ->setCellValue('D8', 'Học phần:')
			            ->setCellValue('E8', $subjectName)
			            // ->setCellValue('B9','Địa điểm:')
			            // ->setCellValue('D9', '')
			            ->setCellValue('D9','Ngày thi:')
			            ->setCellValue('E9', $dataExam)
			            // ->setCellValue('I9',"Ca thi")
			            ->mergeCells('A11:A12')
			            ->setCellValue('A11','STT')
			            ->mergeCells('B11:B12')
			            ->setCellValue('B11','SBD')
			            ->mergeCells('C11:C12')
			            ->setCellValue('C11','Mã SV')
			            ->mergeCells('D11:D12')
			            ->setCellValue('D11','Họ và tên')
			            ->mergeCells('E11:E12')
			            ->setCellValue('E11','GT')
			            ->mergeCells('F11:F12')
			            ->setCellValue('F11','Ngày sinh')
			            ->mergeCells('G11:G12')
			            ->setCellValue('G11','Lớp')
			            ->mergeCells('H11:H12')
			            ->setCellValue('H11','Điểm')
			            ->mergeCells('I11:I12')
			            ->setCellValue('I11','Ghi chú')
			            ;
			    //Style it
			    $objWorkSheet->getStyle('A3:F4')->getFont()->setSize(10);
			    $objWorkSheet->getStyle('E8')->getFont()->setSize(10);
			    $objWorkSheet->getStyle('A3:F4')->applyFromArray($center)
			    								->applyFromArray($bold);
			    $objWorkSheet->getStyle('A4')->applyFromArray($underline);
			    $objWorkSheet->getStyle('B8')->applyFromArray($bold);
			    // $objWorkSheet->getStyle('G8')->applyFromArray($bold);
			    $objWorkSheet->getStyle('E8')->applyFromArray($bold);
			    $objWorkSheet->getStyle('D8:D9')->applyFromArray($right);
			    $objWorkSheet->getStyle('A11:I12')->applyFromArray($vcenter)
			    								  ->applyFromArray($bold);
			    //In thông tin ở đây
			    	$model=new Result();
					$model->unsetAttributes();  // clear any default values
					$model->st_class = $class->st->st_class;
					if(isset($_GET['Result'])) {
						$model->attributes=$_GET['Result'];
					}
					if(isset($_GET['Result']['sj_id'])){
						$model->sj_id = $_GET['Result']['sj_id'];
					}
					if(isset($_GET['Result']['b_type'])){
						$model->b_type = $_GET['Result']['b_type'];
					}

					$data = $model->export();
					$exportData = $data->getData();
					//////////
				    $stt 		= 1;
				    $j 			= 13;//Fix
				    $endrow 	= $j + count($exportData);

				    $objWorkSheet->getStyle("A11:I$endrow")->getFont()->setSize(10);
				    $objWorkSheet->getStyle("A11:I$endrow")->getBorders()->getOutline()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				    $objWorkSheet->getStyle("A11:I$endrow")->getBorders()->getVertical()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				    $objWorkSheet->getStyle("A11:I12")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

			    	foreach ($exportData as $record) {
			    		$objWorkSheet->getRowDimension("$j")->setRowHeight(19);
			    		$objWorkSheet->setCellValue("A$j", "$stt")
			    					 ->setCellValue("B$j", (($record->st)?trim($record->st->st_sbd):"NULL"))
			    					 ->setCellValue("C$j", (($record->st)?trim($record->st->st_code):"NULL"))
			    					 ->setCellValue("D$j", (($record->st)?trim($record->st->st_name):"NULL"))
			    					 ->setCellValue("E$j", (($record->st)?(($record->st->st_sex==1)?"Nam":(($record->st->st_sex==2)?"Nữ":"N/A")):"NULL"))
			    					 ->setCellValue("F$j", (($record->st)?trim($record->st->st_dob):"NULL"))
			    					 ->setCellValue("G$j", (($record->st)?trim($record->st->st_class):"NULL"))
			    					 ->setCellValue("H$j", ((isset($_GET['Result']['b_type']) && ($_GET['Result']['b_type'] == 0))&&(isset($_GET['Result']['sj_id']) && ($_GET['Result']['sj_id'] != 1)&& ($_GET['Result']['sj_id'] != 11)&& ($_GET['Result']['sj_id'] != 12)))?(2.5*$record->point):($record->point))
			    					 ->setCellValue("I$j", (($record->cancel)?("HỦY BÀI - [".$record->reason)."]":""));
			    		$objWorkSheet->getStyle("A$j:H$j")->applyFromArray($center);
			    		$objWorkSheet->getStyle("D$j")->applyFromArray($left);
			    		if($j < $endrow) $objWorkSheet->getStyle("A$j:I$j")->applyFromArray(array('borders' => array('bottom' => array('style' => PHPExcel_Style_Border::BORDER_DOTTED))));
			    		$stt++;
			    		$j++;
			    		$strtotime = date("d/m/Y", strtotime($record->created_at));
			    		$dataExam = ($strtotime != '01/01/1970')?$strtotime:$dataExam;
			    		$htt = ($record->b->b_type)?("KẾT QUẢ KIỂM TRA TRẮC NGHIỆM TRÊN MÁY"):("KẾT QUẢ THI TRẮC NGHIỆM TRÊN MÁY");
			    		// $SBD++;
			    	}
			    	$objWorkSheet->setCellValue('F3', $htt)
			            		 ->setCellValue('E9', $dataExam);

			    	$objWorkSheet->getRowDimension(($endrow + 1))->setRowHeight(6.75);
			    	$objWorkSheet->setCellValue("A".($endrow + 2), "Danh sách gồm ".count($exportData)." sinh viên")
			    				 ->setCellValue("F".($endrow + 2), 'Số bài...........................')
			    				 ->setCellValue("I".($endrow + 2), 'Số tờ............................')
			    				 ->setCellValue("A".($endrow + 3), 'TRƯỞNG BỘ MÔN')
			    				 ->setCellValue("F".($endrow + 3), 'GIÁM THỊ 1')
			    				 ->setCellValue("I".($endrow + 3), 'GIÁM THỊ 2');
			    				 // ->setCellValue("H".($endrow + 3), 'GV CHẤM THI 1')
			    				 // ->setCellValue("J".($endrow + 3), 'GV CHẤM THI 2');
			    	$objWorkSheet->getStyle("A".($endrow + 2))->getFont()->setItalic(true); 
			    // Rename sheet
			    $objWorkSheet->setTitle($class->st->st_class);
			}
			$objPHPExcel->setActiveSheetIndex(0);


			//Auto fit withd size column
		    // $cellIterator = $objWorkSheet->getRowIterator()->current()->getCellIterator();
		    // $cellIterator->setIterateOnlyExistingCells(true);
		    // foreach ($cellIterator as $cell) {
		    //     $objWorkSheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
		    // }

			$NameFile = "{$subjectCode}_".date('Y')."_KQ";
		    $objPHPExcel->setActiveSheetIndex(0);
	        header('Content-Type: application/vnd.ms-excel');
			header("Content-Disposition: attachment;filename=\"{$NameFile}_".date('d_m_Y_H_i').".xls\"");
			header('Cache-Control: max-age=0');
			header('Cache-Control: max-age=1');
			header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');
			Yii::app()->end();
		} else {
			echo json_encode(['error' => 'Bạn chưa chọn môn học']);
		}
	}
}
