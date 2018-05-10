<?php
/* @var $this SurveyController */
$this->breadcrumbs=array(
	'Survey',
);
$obj_id = Yii::app()->session['obj_id'];
$class = Yii::app()->session['class'];
$sj_id = Yii::app()->session['sj_id'];
$sys_id = Yii::app()->session['sys_id'];

if($obj_id == Yii::app()->params['STUDENT']){
	$criteria = new CDbCriteria();
	$criteria->distinct=true;
	$criteria->condition = "t.sj_id='".$sj_id."' and t.class='".$class."'" ; 
	$suvSC =    SuvSc::model()->find($criteria)  ;
	if($suvSC == null){
		$this->redirect('/survey');
	}
	$sj_name = $suvSC->sj_name;
	$tc_name = $suvSC->teacher->tc_name;
}
?>
<section class="features-blocks">
    <div class="container">
    	<form method="post" id="form">
	    	<div class="qa-message-list">
    		 	<div class="message-item hvr-float-shadow">
		    		<div class="message-inner" style="text-align: center">
						<h4><strong style="color: #F68F43">KHẢO SÁT TRỰC TUYẾN</strong></h4>
		    		</div>
		    	</div>
		    	<div class="message-item">
		    		<div class="message-inner">
						<div class="form-group">
						Bạn Là: <label for="" id=""> <?php echo SuvObject::model()->findByPk($obj_id)->obj_name ?></label>
						</div>
						<?php if ($obj_id == Yii::app()->params['STUDENT']): ?>

							<div class="form-gr	oup">
								Học Kì: <label for="" id=""> <?php echo SuvSys::model()->findByPk($sys_id)->sys_name ?></label>
							</div>
							<div class="form-group">
								Lớp: <label for="" id=""> <?php echo $class ?></label>
							</div>
							<div class="form-group">
								Môn Học: <label for="" id=""> <?php echo $sj_name ?></label>
							</div>
							<div class="form-group">
								Giảng Viên: <label for="" id=""> <?php echo $tc_name ?></label>
							</div>
						<?php endif ?>
		    		</div>
		    	</div>
	    	<?php
	    		$sq = SuvSq::model()->with('qs')->findAll("sys_id=:sys_id AND obj_id=:obj AND isActive = 1", array(':sys_id'=>$sys_id, ':obj'=>$obj_id));
				$data = SuvQuestion::model()->with('cr')->findAll("obj_id=:obj AND isActive = 1", array(':obj'=>$obj_id));

	    		if($obj_id == Yii::app()->params['STUDENT']){
	    			$data = [];
		    		foreach ($sq as $obj) {
		    			$data[] = $obj->qs;
		    		}
	    		}
				$questionIds = CHtml::listData($data,'qs_id', 'qs_id');
				$listcr = CHtml::listData($data,'cr_id', 'cr.cr_name');
				foreach ($listcr as $cr => $cr_name) {
					$data = SuvQuestion::model()->with('answers')->findAll("obj_id=:obj AND cr_id=:cr", array(':obj'=>$obj_id, ':cr'=>$cr));
			?>
				<div class="message-item">
					<div class="message-inner">
						<div class="message-head clearfix">
							<div class="user-detail">
								<h5 class="handle" style="color:#8560a8; text-transform: uppercase;"><i class="entypo-trophy"></i> <?php echo $cr_name;?></h5>
							</div>
						</div>
						<div class="qa-message-content">
					<?php 
						foreach ($data as $key => $value) {
							if(in_array($value->qs_id, $questionIds)){
					?>
							<ul class="list-group">
								<p class="qs_err alert-danger" id="qs<?php echo $value->qs_id ?>" style="padding: 8px; border-radius: 5px; display: none;">Bạn chưa đánh giá câu hỏi này</p>
								<li class="list-group-item active">
								<?php
									echo $value->qs_content;
								?>
								</li>
								<?php
									foreach ($value->answers as $k => $val) {
								?>
									<li class="list-group-item" style="padding-top: 5px; padding-bottom: 5px;">
										<div class="radio radio-primary hvr-float-shadow">
								            <input type="radio" name="<?php echo $value->qs_id; ?>" id="<?php echo $val->as_id; ?>" value="<?php echo $val->as_id; ?>">
								            <label for="<?php echo $val->as_id; ?>">
								                <?php echo $val->as_value; ?>
								            </label>
								        </div>
							      	</li>
								
								<?php
									}
								?>
							</ul>
					<?php 
							}
						}
					?>
						</div>
					</div>
				</div>
				<?php
					}
				?>
				<div class="message-item">
					<a href="<?php echo $this->createUrl('home/index') ?>" class="btn btn-warning hvr-icon-back"> Quay Lại</a>
					<button onclick="return check()" class="btn btn-primary hvr-icon-forward hvr-wobble-horizontal" type="submit">Gửi Đánh Giá </button>
				</div>
			</div>
        </form>
	</div>
</section>
<br/>

<script type="text/javascript">
	function check() {
		$(".qs_err").hide();
		var questionIds = <?php echo json_encode($questionIds); ?>;
		var data = $("#form").serializeArray();
		dataArray = [];
		$.each(data, function (key, val) {
			dataArray[val.name] = val.value;
		});
		$.ajax({
			data : {data : dataArray, questionIds: questionIds},
			url : "<?php echo Yii::app()->request->baseUrl ?>/survey/check",
			method : "post",
			success : function (result) {
				var ids = JSON.parse(result);
				if(Object.keys(ids).length == 0){
					$("#form").submit();
				}else{
					toastr.error("Bạn chưa đánh giá hết các câu hỏi!");
					$.each(ids, function (qs_id, val) {
						$("#qs"+ qs_id).show();
					});
				}
			}
		});
		return false;
	}
</script>
