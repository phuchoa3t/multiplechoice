<?php
/* @var $this StudentController */
/* @var $model Student */
/* @var $form CActiveForm */
?>

<div class="panel-body">
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'            => array('role'  => 'form', 'class'=>'form-horizontal form-groups-bordered')
)); ?>

	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->label($model,'st_id'); ?>
</label>
		<div class="col-sm-5"><?php echo $form->textField($model,'st_id', array('class'=>'form-control')); ?>
</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->label($model,'st_sbd'); ?>
</label>
		<div class="col-sm-5"><?php echo $form->textField($model,'st_sbd',array('size'=>20,'maxlength'=>20,'class'=>'form-control')); ?>
</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->label($model,'st_code'); ?>
</label>
		<div class="col-sm-5"><?php echo $form->textField($model,'st_code',array('size'=>50,'maxlength'=>50,'class'=>'form-control')); ?>
</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->label($model,'st_name'); ?>
</label>
		<div class="col-sm-5"><?php echo $form->textField($model,'st_name',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->label($model,'st_dob'); ?>
</label>
		<div class="col-sm-5"><?php echo $form->textField($model,'st_dob',array('size'=>50,'maxlength'=>50,'class'=>'form-control')); ?>
</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->label($model,'st_sex'); ?>
</label>
		<div class="col-sm-5"><?php echo $form->textField($model,'st_sex', array('class'=>'form-control')); ?>
</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->label($model,'st_class'); ?>
</label>
		<div class="col-sm-5"><?php echo $form->textField($model,'st_class',array('size'=>20,'maxlength'=>20,'class'=>'form-control')); ?>
</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-5">
		<?php echo CHtml::submitButton('Search', array('class'=>'btn')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->