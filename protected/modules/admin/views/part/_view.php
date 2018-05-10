<?php
/* @var $this PartController */
/* @var $data Part */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('p_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->p_id), array('view', 'id'=>$data->p_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('p_name')); ?>:</b>
	<?php echo CHtml::encode($data->p_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('p_note')); ?>:</b>
	<?php echo CHtml::encode($data->p_note); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ec_id')); ?>:</b>
	<?php echo CHtml::encode($data->ec_id); ?>
	<br />


</div>