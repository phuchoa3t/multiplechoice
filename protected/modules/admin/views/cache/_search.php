<?php
/* @var $this CacheController */
/* @var $model Cache */
/* @var $form CActiveForm */
?>

<div class="panel-body">
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'            => array('role'  => 'form', 'class'=>'form-horizontal form-groups-bordered')
)); ?>

	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->label($model,'c_id'); ?>
</label>
		<div class="col-sm-5"><?php echo $form->textField($model,'c_id', array('class'=>'form-control')); ?>
</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->label($model,'st_id'); ?>
</label>
		<div class="col-sm-5"><?php echo $form->textField($model,'st_id', array('class'=>'form-control')); ?>
</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->label($model,'ec_id'); ?>
</label>
		<div class="col-sm-5"><?php echo $form->textField($model,'ec_id', array('class'=>'form-control')); ?>
</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->label($model,'b_id'); ?>
</label>
		<div class="col-sm-5"><?php echo $form->textField($model,'b_id', array('class'=>'form-control')); ?>
</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->label($model,'data'); ?>
</label>
		<div class="col-sm-5"><?php echo $form->textArea($model,'data',array('rows'=>6, 'cols'=>50)); ?>
</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-5">
		<?php echo CHtml::submitButton('Search', array('class'=>'btn')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->