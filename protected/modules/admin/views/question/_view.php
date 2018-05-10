<?php
/* @var $this QuestionController */
/* @var $data Question */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('qs_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->qs_id), array('view', 'id'=>$data->qs_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qs_content')); ?>:</b>
	<?php echo CHtml::encode($data->qs_content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qs_note')); ?>:</b>
	<?php echo CHtml::encode($data->qs_note); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ec_id')); ?>:</b>
	<?php echo CHtml::encode($data->ec_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('p_id')); ?>:</b>
	<?php echo CHtml::encode($data->p_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('as_id')); ?>:</b>
	<?php echo CHtml::encode($data->as_id); ?>
	<br />


</div>