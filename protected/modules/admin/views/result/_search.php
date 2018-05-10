<?php
/* @var $this ResultController */
/* @var $model Result */
/* @var $form CActiveForm */
?>

<div class="panel-body">
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'            => array('role'  => 'form', 'class'=>'form-horizontal form-groups-bordered', 'id'=>"fExport")
)); ?>

	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->label($model,'st_code'); ?>
</label>
		<div class="col-sm-5"><?php echo $form->textField($model,'st_code', array('class'=>'form-control')); ?>
</div>
	</div>

	<!-- <div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->label($model,'ec_id'); ?>
</label>
		<div class="col-sm-5">
			<?php
				$result = Examcode::model()->findAll();
				$raw = array();
				foreach ($result as $key => $value) {
					$raw[$value['ec_id']] = $value['ec_name'];
				}
				echo $form->dropDownList($model,'ec_id', $raw,array('class'=>'form-control', 'prompt'=>'--- Mã Đề ---',));
			?>
</div>
	</div> -->

	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->label($model,'b_id'); ?>
</label>
		<div class="col-sm-5">
			<?php
				$result = Bout::model()->findAll();
				$raw = array();
				foreach ($result as $key => $value) {
					$raw[$value['b_id']] = $value['b_name'];
				}
				echo $form->dropDownList($model,'b_id', $raw,array('class'=>'form-control', 'prompt'=>'--- Đợt ---',));
			?>
</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->label($model,'sj_id'); ?>
</label>
		<div class="col-sm-5">
			<?php
				$result = Subject::model()->findAll();
				$raw = array();
				foreach ($result as $key => $value) {
					$raw[$value['sj_id']] = $value['sj_name'];
				}
				echo $form->dropDownList($model,'sj_id', $raw,array('class'=>'form-control', 'prompt'=>'--- Môn ---',));
			?>
</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->label($model,'b_type'); ?>
</label>
		<div class="col-sm-5">
			
			<?php
				$raw = array('0'=>'BÀI THI KẾT THÚC HỌC PHẦN','1'=>'BÀI KIỂM TRA');
				echo $form->dropDownList($model,'b_type', $raw, array('class'=>'form-control', 'prompt'=>'--- Hình thức ---', 'data-validate'=>'required'));
			?>
</div>
	</div>

<!-- 	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->label($model,'point'); ?>
</label>
		<div class="col-sm-5"><?php echo $form->numberField($model,'point',array('class'=>'form-control')); ?>
</div>
	</div> -->

	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-5">
		<?php echo CHtml::submitButton('Search', array('class'=>'btn')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->