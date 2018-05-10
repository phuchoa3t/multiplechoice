<?php
/* @var $this ExamcodeController */
/* @var $model Examcode */
/* @var $form CActiveForm */
?>

<div class="panel-body">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'examcode-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'enableClientValidation' => true,
    'clientOptions'          => array(
							        'validateOnSubmit'       => true,
							        'validateOnChange'       => true,
							    ),
    'htmlOptions'            => array('role'  => 'form', 'class'=>'form-horizontal form-groups-bordered')
)); ?>

	<p class="note">Các trường <span class="required">*</span> là bắt buộc.</p>

	<?php //echo $form->errorSummary($model); ?>

	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->labelEx($model,'ec_name'); ?>
</label>
		<div class="col-sm-5">
			<?php echo $form->textField($model,'ec_name',array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'ec_name'); ?>
		</div>
	</div>
<div class="form-group">
	<div class="col-sm-offset-3 col-sm-5">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Thêm Mới' : 'Cập Nhật', array('class'=>'btn')); ?>
	</div>
</div>

<?php $this->endWidget(); ?>
</div>