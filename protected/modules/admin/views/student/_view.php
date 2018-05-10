<?php
/* @var $this StudentController */
/* @var $data Student */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('st_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->st_id), array('view', 'id'=>$data->st_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('st_sbd')); ?>:</b>
	<?php echo CHtml::encode($data->st_sbd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('st_code')); ?>:</b>
	<?php echo CHtml::encode($data->st_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('st_name')); ?>:</b>
	<?php echo CHtml::encode($data->st_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('st_dob')); ?>:</b>
	<?php echo CHtml::encode($data->st_dob); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('st_sex')); ?>:</b>
	<?php echo CHtml::encode($data->st_sex); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('st_class')); ?>:</b>
	<?php echo CHtml::encode($data->st_class); ?>
	<br />


</div>