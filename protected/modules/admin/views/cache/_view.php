<?php
/* @var $this CacheController */
/* @var $data Cache */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('c_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->c_id), array('view', 'id'=>$data->c_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('st_id')); ?>:</b>
	<?php echo CHtml::encode($data->st_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ec_id')); ?>:</b>
	<?php echo CHtml::encode($data->ec_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('b_id')); ?>:</b>
	<?php echo CHtml::encode($data->b_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data')); ?>:</b>
	<?php echo CHtml::encode($data->data); ?>
	<br />


</div>