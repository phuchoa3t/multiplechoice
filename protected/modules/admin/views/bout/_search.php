<?php
/* @var $this BoutController */
/* @var $model Bout */
/* @var $form CActiveForm */
?>

<div class="panel-body">
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'            => array('role'  => 'form', 'class'=>'form-horizontal form-groups-bordered')
)); ?>

	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->label($model,'b_id'); ?>
</label>
		<div class="col-sm-5"><?php echo $form->textField($model,'b_id', array('class'=>'form-control')); ?>
</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->label($model,'b_name'); ?>
</label>
		<div class="col-sm-5"><?php echo $form->textField($model,'b_name',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->label($model,'b_config'); ?>
</label>
		<div class="col-sm-5"><?php echo $form->textField($model,'b_config',array('size'=>50,'maxlength'=>50,'class'=>'form-control')); ?>
</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->label($model,'b_status'); ?>
</label>
		<div class="col-sm-5"><?php echo $form->textField($model,'b_status', array('class'=>'form-control')); ?>
</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->label($model,'b_time'); ?>
</label>
		<div class="col-sm-5"><?php echo $form->textField($model,'b_time', array('class'=>'form-control')); ?>
</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->label($model,'ec_id'); ?>
</label>
		<div class="col-sm-5"><?php echo $form->textField($model,'ec_id', array('class'=>'form-control')); ?>
</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-5">
		<?php echo CHtml::submitButton('Search', array('class'=>'btn')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->