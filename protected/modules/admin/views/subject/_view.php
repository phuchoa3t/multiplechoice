<?php
/* @var $this SubjectController */
/* @var $data Subject */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('sj_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->sj_id), array('view', 'id'=>$data->sj_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sj_name')); ?>:</b>
	<?php echo CHtml::encode($data->sj_name); ?>
	<br />


</div>