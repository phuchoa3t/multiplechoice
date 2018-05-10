<?php
/* @var $this BoutController */
/* @var $data Bout */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('b_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->b_id), array('view', 'id'=>$data->b_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('b_name')); ?>:</b>
	<?php echo CHtml::encode($data->b_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('b_config')); ?>:</b>
	<?php echo CHtml::encode($data->b_config); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('b_status')); ?>:</b>
	<?php echo CHtml::encode($data->b_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('b_time')); ?>:</b>
	<?php echo CHtml::encode($data->b_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ec_id')); ?>:</b>
	<?php echo CHtml::encode($data->ec_id); ?>
	<br />


</div>