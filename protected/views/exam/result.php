<?php
/* @var $this SurveyController */
$this->breadcrumbs=array(
	'Survey',
);
$obj_id = Yii::app()->session['obj_id'];
$en_id = Yii::app()->request->getParam('en_id');

if($obj_id != Yii::app()->params['ENTERPRISE']){
	$this->redirect('/survey');
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
						Bạn Là: <label for="" id=""> <?php echo SuvEnterprise::model()->findByPk($en_id)->name ?></label>
						</div>
		    		</div>
		    	</div>
	    	<?php

				$data = SuvQuestion::model()->with('cr')->findAll("obj_id=:obj", array(':obj'=>$obj_id));

				$questionIds = CHtml::listData($data,'qs_id', 'qs_id');
				$listcr = CHtml::listData($data,'cr_id', 'cr.cr_name');
				foreach ($listcr as $cr => $cr_name) {
					$data = SuvQuestion::model()->with('answers')->findAll("obj_id=:obj AND cr_id=:cr", array(':obj'=>(isset(Yii::app()->session['obj_id'])?(Yii::app()->session['obj_id']):("%%")), ':cr'=>$cr));
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
								$result = SuvResult::model()->findAll('en_id=:en_id and qs_id=:qs_id and as_id=:as_id', array(
									':en_id' => $en_id,
									':qs_id' => $value->qs_id,
									':as_id' => $val->as_id,
								));
								$checked = "checked";
								if(empty($result)){
									$checked = "";
								}
							?>
								<li class="list-group-item" style="padding-top: 5px; padding-bottom: 5px;">
									<div class="radio radio-primary hvr-float-shadow">
							            <input <?php echo $checked; ?> disabled="disabled" type="radio" name="<?php echo $value->qs_id; ?>" id="<?php echo $val->as_id; ?>" value="<?php echo $val->as_id; ?>">
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
					?>
						</div>
					</div>
				</div>
				<?php
					}
				?>
				<div class="message-item">
					<a href="<?php echo $this->createUrl('home/index') ?>" class="btn btn-warning hvr-icon-back"> Quay Lại</a>
					<button onclick="return check()" class="btn btn-primary hvr-icon-forward hvr-wobble-horizontal" type="submit">In kết quả </button>
				</div>
			</div>
        </form>
	</div>
</section>
<br/>
