<?php
/* @var $this AnswerController */
/* @var $model Answer */
/* @var $form CActiveForm */
?>

<div class="panel-body">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'answer-form',
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
		<label class="col-sm-3 control-label"><?php echo $form->labelEx($model,'qs_id'); ?>
</label>
		<div class="col-sm-5">
			<?php
				$result = Question::model()->findAll();
				$raw = array();
				foreach ($result as $key => $value) {
					$raw[$value['qs_id']] = $value['ec_id'].'.'.$value['qs_num'].'. '.$value['qs_content'];
				}
				echo $form->dropDownList($model,'qs_id', $raw,array('class'=>'form-control', 'prompt'=>'--- Câu Hỏi ---', 'data-validate'=>'required',));
			?>
			<?php echo $form->error($model,'qs_id'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->labelEx($model,'as_value'); ?>
</label>
		<div class="col-sm-5">
			<?php echo $form->textField($model,'as_value',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'as_value'); ?>
		</div>
	</div>
<div class="form-group">
	<div class="col-sm-offset-3 col-sm-5">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Thêm Mới' : 'Cập Nhật', array('class'=>'btn')); ?>
	</div>
</div>

<?php $this->endWidget(); ?>
</div>