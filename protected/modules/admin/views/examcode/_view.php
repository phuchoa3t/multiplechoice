<?php
/* @var $this ExamcodeController */
/* @var $data Examcode */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ec_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ec_id), array('view', 'id'=>$data->ec_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ec_name')); ?>:</b>
	<?php echo CHtml::encode($data->ec_name); ?>
	<br />


</div>