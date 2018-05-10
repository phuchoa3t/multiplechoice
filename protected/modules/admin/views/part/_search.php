<?php
/* @var $this PartController */
/* @var $model Part */
/* @var $form CActiveForm */
?>

<div class="panel-body">
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'            => array('role'  => 'form', 'class'=>'form-horizontal form-groups-bordered')
)); ?>

	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->label($model,'p_id'); ?>
</label>
		<div class="col-sm-5"><?php echo $form->textField($model,'p_id', array('class'=>'form-control')); ?>
</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->label($model,'p_name'); ?>
</label>
		<div class="col-sm-5"><?php echo $form->textArea($model,'p_name',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->label($model,'p_note'); ?>
</label>
		<div class="col-sm-5"><?php echo $form->textArea($model,'p_note',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
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