<?php
class HomeController extends FrontendController
{

	public function actionIndex($value='')
	{
		header('Content-Type: text/html; charset=UTF-8');
		if(Yii::app()->request->isPostRequest){
			$st_code = trim(Yii::app()->request->getPost('st_code'));

			$st_name = mb_strtoupper(trim(Yii::app()->request->getPost('st_name')), 'utf-8');
			$st = Student::model()->find(
				'st_code=:st_code  and st_name LIKE  :st_name
				', array(
					':st_code'=> $st_code,
					':st_name'=> '%' .$st_name.'%'
				)
			);

			if($st_code == "" || $st_name == "" || $st == null){
				Yii::app()->user->setFlash('error', "Mã sinh viên hoặc họ tên không hợp lệ. Xin mời nhập lại");
				$this->redirect(Yii::app()->createUrl('home'));
			}

			
			$bts = Bout::model()->findAllByAttributes(
				array(
					'b_status'=> [1,2]
				)
			);
			
			$bt = null;
			foreach ($bts as $key => $obj) {
				$config = $obj->attributes['b_config'];
				$items = explode(",", $config);
				foreach ($items as $k => $item) {
					$arr = explode("-", $item);
					if(count($arr) == 2){
						if((int)$st->attributes['st_sbd'] >= $arr[0] && (int)$st->attributes['st_sbd'] <= $arr[1]){
							$bt = $obj;
							break;
						}elseif((int)$st->attributes['st_sbd'] == $arr[0]){
							$bt = $obj;
							break;
						}
					}
					if($bt != null){
						break;
					}
				}
			}

			if($bt == null){
				Yii::app()->user->setFlash('error', "Bạn chưa được cấp quyền để làm bài kiểm tra. Vui lòng liên hệ với người quản trị");
				$this->redirect(Yii::app()->createUrl('home'));
			}


			$student_result = Result::model()->find(
				'st_id=:st_id and 
				 b_id=:b_id
				', array(
					':st_id'=> $st->attributes['st_id'],
					':b_id'=> $bt->attributes['b_id']
				)
			);

			if($student_result != null){
				Yii::app()->user->setFlash('error', "Bạn đã làm bài kiểm tra rồi !");
				$this->redirect(Yii::app()->createUrl('home'));
			}

			Yii::app()->session['st'] = $st;
			Yii::app()->session['bt'] = $bt;
			$this->redirect(Yii::app()->createUrl('home/cauhoi'));
		}

		$this->render('home');
	}

	public function actionCauhoi()
	{
        $st = Yii::app()->session['st'];
		$bt = Yii::app()->session['bt'];
		if($st == null || $bt ==null){
			Yii::app()->user->setFlash('error', "Có lỗi xảy ra. Bạn vui lòng nhập mã sinh viên và họ tên để làm bài !");
			$this->redirect(Yii::app()->createUrl('home'));
		}
		$cache = Cache::model()->find(
			'b_id=:b_id and
			st_id=:st_id
			', 
			array(
				':b_id'=> $bt->attributes['b_id'],
				':st_id'=> $st->attributes['st_id'],
			)
		);
		if($cache == null && $bt->attributes['b_status'] == 2){
			Yii::app()->user->setFlash('error', "Đợt kiểm tra trước chưa được đóng !");
			$this->redirect(Yii::app()->createUrl('home'));
		}
		$qsList = [];
		
		$student_result = Result::model()->find(
			'st_id=:st_id and 
			 b_id=:b_id
			', array(
				':st_id'=> $st->attributes['st_id'],
				':b_id'=> $bt->attributes['b_id']
			)
		);
		if($student_result != null){
			Yii::app()->user->setFlash('error', "Bạn đã gửi bài thi. Không thể gửi lại ! Xin liên hệ với người quản trị");
			$this->redirect(Yii::app()->createUrl('home'));
		}

		$cookie_name = "student_".$st->attributes['st_id']."_".$bt->attributes['b_id'];
		$studentQuestions = Yii::app()->session['studentQuestions'];

		$ec_ids_string = explode(",", $bt->attributes['ec_id']);
		$ec_id = $ec_ids_string[array_rand($ec_ids_string)];
		if(true || $studentQuestions == null || !is_array($studentQuestions) || !isset($studentQuestions[$st->attributes['st_code']])){
			$qsAll = [];
			$listenQuestions = [];
			if($bt->attributes['sj_id'] == 1 )
			{
				$listenQuestions = Question::model()->findAllByAttributes([
					'p_id' => [1,2,3,4],
					'ec_id' => $ec_id
				],[
					'order' => 'qs_num ASC'
				]);
				$qsAll = array_merge($qsAll, $listenQuestions);
				$partDif = [4,5,6,7,8,9,10,11];
				for ($i=5; $i <=7; $i++) { 
//					$ec_id = $partDif[array_rand($partDif)];
					$readPartQuestion = Question::model()->findAllByAttributes([
						'p_id' => $i,
						'ec_id' => $ec_id
					],[
						'order' => 'qs_num ASC'
					]);
					$qsAll = array_merge($qsAll, $readPartQuestion);
				}
			}elseif($bt->attributes['sj_id'] == 11 )
			{
				$listenQuestions = Question::model()->findAllByAttributes([
					'p_id' => [1,2,3,4],
					'ec_id' => $ec_id
				],[
					'order' => 'qs_num ASC'
				]);
				$qsAll = array_merge($qsAll, $listenQuestions);
				$partDif = [441,442,443,444,445,446,447,448,449,450];
				for ($i=5; $i <=7; $i++) { 
					$ec_id = $partDif[array_rand($partDif)];
					$readPartQuestion = Question::model()->findAllByAttributes([
						'p_id' => $i,
						'ec_id' => $ec_id
					],[
						'order' => 'qs_num ASC'
					]);
					$qsAll = array_merge($qsAll, $readPartQuestion);
				}
			}elseif($bt->attributes['sj_id'] == 12 )
			{
				$listenQuestions = Question::model()->findAllByAttributes([
					'p_id' => [8, 9],
					'ec_id' => $ec_id
				],[
					'order' => 'qs_num ASC'
				]);
				$qsAll = array_merge($qsAll, $listenQuestions);
				$partDif = [451, 452, 453, 454];
				for ($i=10; $i <=12; $i++) { 
					$ec_id = $partDif[array_rand($partDif)];
					$readPartQuestion = Question::model()->findAllByAttributes([
						'p_id' => $i,
						'ec_id' => $ec_id
					],[
						'order' => 'qs_num ASC'
					]);
					$qsAll = array_merge($qsAll, $readPartQuestion);
				}
			}else{
				$qsAll = Question::model()->findAllByAttributes([
					'ec_id' => $ec_id
				],[
					'order' => 'qs_num ASC'
				]);
			}
			
			$studentQuestions = [
				$st->attributes['st_code'] => $qsAll
			];
			Yii::app()->session['studentQuestions'] = $studentQuestions;
		}
		$questions = $studentQuestions[$st->attributes['st_code']];
		$questionIds = [];
		foreach ($questions as $key => $value) {
			$questionIds[$value->attributes['qs_id']] = 0;
		}
		$questionsCookie = [];
		if($cache != null){
			$questionsCookie = json_decode($cache->attributes['data'], true);
		}else{
			$questionsCookie = [
				'time' => $bt->attributes['b_time'],
				'questionsValue' => $questionIds
			];
			$cache_save = new Cache();
			$cache_save->b_id = $bt->attributes['b_id'];
			$cache_save->st_id = $st->attributes['st_id'];
			$cache_save->ec_id = $ec_id;
			$cache_save->data = json_encode($questionsCookie);
			$cache_save->save();
		}

		if($questionsCookie['time'] > $bt->attributes['b_time']){
			$questionsCookie['time'] = $bt->attributes['b_time'];
		}
		if(Yii::app()->request->isPostRequest){
			if($bt->attributes['b_status'] == 0){
				Yii::app()->user->setFlash('error', "Đợt đánh giá này đã bị đóng ! Xin liên hệ với người quản trị");
				$this->redirect(Yii::app()->createUrl('home/cauhoi'));
			}
			$data = [];
			foreach ($_POST as $qs_id => $as_id) {
				$questionIds[$qs_id] = $as_id;
			}
			$model = new Result();
			$model->st_id = $st->attributes['st_id'];
			$model->b_id = $bt->attributes['b_id'];
			$model->ec_id = $ec_id;
			$model->data = json_encode($questionIds);
			if($bt->attributes['sj_id'] == 1 )
			{
				$point = $model->getResultTOEIC();
				$model->point = $point;
				$model->save();
			}elseif($bt->attributes['sj_id'] == 11 )
			{
				$point = $model->getResultTOEIC(1);
				$model->point = $point;
				$model->save();
			}elseif($bt->attributes['sj_id'] == 12 )
			{
				$point = $model->getResultTOEICCC();
				$model->point = $point;
				$model->save();
			}else{
				$point = $model->getResultTest();
				$model->point = $point;
				$model->save();
			}
			Yii::app()->user->setFlash('success', "Bạn đã hoàn thành bài kiểm tra với số điểm là <strong><h1>".$point."</h1></strong>");
			$this->redirect(Yii::app()->createUrl('home'));
		}


		$this->render('cauhoi', 
			compact('cookie_name','questions', 'questionIds', 'questionsCookie'));
	}
	public function actionCache($value='')
	{
		if(Yii::app()->request->isPostRequest){
			$st = Yii::app()->session['st'];
			$bt = Yii::app()->session['bt'];
			$questionsCookie = $_POST['questionsCookie'];
			$cache = Cache::model()->find(
				'b_id=:b_id and
				st_id=:st_id
				', 
				array(
					':b_id'=> $bt->attributes['b_id'],
					':st_id'=> $st->attributes['st_id'],
				)
			);
			if($cache == null){
				$cache = new Cache();
				$cache->b_id = $bt->attributes['b_id'];
				$cache->st_id = $st->attributes['st_id'];
				$cache->ec_id = $bt->attributes['ec_id'];
				$cache->data = json_encode($questionsCookie);
			}else{
				$cache->data = json_encode($questionsCookie);
			}
			$cache->save();
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
	public function actionConnect($value='')
	{
		$st = Yii::app()->session['st'];
		$bt = Yii::app()->session['bt'];
		if($st == null || $bt ==null){
			echo "Có lỗi xảy ra, Liên hệ ngay với người quản trị. Dừng mọi thao tác !!!";
		}
	}
}