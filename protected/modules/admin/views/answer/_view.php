<?php
/* @var $this AnswerController */
/* @var $data Answer */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('as_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->as_id), array('view', 'id'=>$data->as_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qs_id')); ?>:</b>
	<?php echo CHtml::encode($data->qs_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('as_value')); ?>:</b>
	<?php echo CHtml::encode($data->as_value); ?>
	<br />


</div>