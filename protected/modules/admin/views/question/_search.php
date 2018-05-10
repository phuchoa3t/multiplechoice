<?php
/* @var $this QuestionController */
/* @var $model Question */
/* @var $form CActiveForm */
?>

<div class="panel-body">
<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'htmlOptions'            => array('role'  => 'form', 'class'=>'form-horizontal form-groups-bordered')
)); ?>

	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->label($model,'qs_id'); ?>
</label>
		<div class="col-sm-5"><?php echo $form->textField($model,'qs_id', array('class'=>'form-control')); ?>
</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->label($model,'qs_num'); ?>
</label>
		<div class="col-sm-5"><?php echo $form->textField($model,'qs_num', array('class'=>'form-control')); ?>
</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->label($model,'qs_content'); ?>
</label>
		<div class="col-sm-5"><?php echo $form->textArea($model,'qs_content',array('rows'=>6, 'cols'=>50)); ?>
</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->label($model,'qs_note'); ?>
</label>
		<div class="col-sm-5"><?php echo $form->textArea($model,'qs_note',array('rows'=>6, 'cols'=>50)); ?>
</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->label($model,'ec_id'); ?>
</label>
		<div class="col-sm-5">
		<?php //echo $form->textField($model,'ec_id', array('class'=>'form-control')); ?>
		<?php
				$result = Examcode::model()->findAll();
				$raw = array();
				foreach ($result as $key => $value) {
					$raw[$value['ec_id']] = $value['ec_name'];
				}
				echo $form->dropDownList($model,'ec_id', $raw,array('class'=>'form-control', 'prompt'=>'--- Mã Đề ---',));
			?>
</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->label($model,'p_id'); ?>
</label>
		<div class="col-sm-5"><?php echo $form->textField($model,'p_id', array('class'=>'form-control')); ?>
</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->label($model,'as_id'); ?>
</label>
		<div class="col-sm-5"><?php echo $form->textField($model,'as_id', array('class'=>'form-control')); ?>
</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-5">
		<?php echo CHtml::submitButton('Search', array('class'=>'btn')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->