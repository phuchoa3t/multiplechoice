<?php
/* @var $this CacheController */
/* @var $model Cache */
/* @var $form CActiveForm */
?>

<div class="panel-body">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cache-form',
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
		<label class="col-sm-3 control-label"><?php echo $form->labelEx($model,'c_id'); ?>
</label>
		<div class="col-sm-5">
			<?php echo $form->textField($model,'c_id', array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'c_id'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->labelEx($model,'st_id'); ?>
</label>
		<div class="col-sm-5">
			<?php echo $form->textField($model,'st_id', array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'st_id'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->labelEx($model,'ec_id'); ?>
</label>
		<div class="col-sm-5">
			<?php echo $form->textField($model,'ec_id', array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'ec_id'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->labelEx($model,'b_id'); ?>
</label>
		<div class="col-sm-5">
			<?php echo $form->textField($model,'b_id', array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'b_id'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->labelEx($model,'data'); ?>
</label>
		<div class="col-sm-5">
			<?php echo $form->textArea($model,'data',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'data'); ?>
		</div>
	</div>
<div class="form-group">
	<div class="col-sm-offset-3 col-sm-5">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Thêm Mới' : 'Cập Nhật', array('class'=>'btn')); ?>
	</div>
</div>

<?php $this->endWidget(); ?>
</div>