<?php
/* @var $this AuthenticationController */

$this->pageTitle = $code;
$this->pageTitle .= ($code==404)?" - Page not found!":" - ".$message;
?>
<div class="main-content">
	<div class="page-error-404">
		<div class="error-symbol">
			<i class="entypo-attention"></i>
		</div>
		<div class="error-text">
		<?php 
			if($code == 403){
				Yii::app()->user->setFlash('accessRules','Bạn không có quyền thực hiện hành động này!');
				$this->redirect(Yii::app()->createUrl('/admin'));
			}
		?>
			<h2><?php echo $code;?></h2>
			<p><?php echo ($code==404)?"Page not found!<br/>$message":$message; ?></p>
		</div>
		<hr/>
		<!-- <div class="error-text">
			Search Pages:
			<br />
			<br />
			<div class="input-group minimal">
				<div class="input-group-addon">
				<i class="entypo-search"></i>
				</div>

				<input type="text" class="form-control" placeholder="Search anything..." />
			</div>
		</div> -->
	</div>
</div>