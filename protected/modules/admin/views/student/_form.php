<?php
/* @var $this StudentController */
/* @var $model Student */
/* @var $form CActiveForm */
?>

<div class="panel-body">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'student-form',
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
		<label class="col-sm-3 control-label"><?php echo $form->labelEx($model,'st_sbd'); ?>
</label>
		<div class="col-sm-5">
			<?php echo $form->textField($model,'st_sbd',array('size'=>20,'maxlength'=>20,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'st_sbd'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->labelEx($model,'st_code'); ?>
</label>
		<div class="col-sm-5">
			<?php echo $form->textField($model,'st_code',array('size'=>50,'maxlength'=>50,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'st_code'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->labelEx($model,'st_name'); ?>
</label>
		<div class="col-sm-5">
			<?php echo $form->textField($model,'st_name',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'st_name'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->labelEx($model,'st_dob'); ?>
</label>
		<div class="col-sm-5">
			<?php echo $form->textField($model,'st_dob',array('size'=>50,'maxlength'=>50,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'st_dob'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->labelEx($model,'st_sex'); ?>
</label>
		<div class="col-sm-5">
			<?php echo $form->textField($model,'st_sex', array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'st_sex'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->labelEx($model,'st_class'); ?>
</label>
		<div class="col-sm-5">
			<?php echo $form->textField($model,'st_class',array('size'=>20,'maxlength'=>20,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'st_class'); ?>
		</div>
	</div>
<div class="form-group">
	<div class="col-sm-offset-3 col-sm-5">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Thêm Mới' : 'Cập Nhật', array('class'=>'btn')); ?>
	</div>
</div>

<?php $this->endWidget(); ?>
</div>