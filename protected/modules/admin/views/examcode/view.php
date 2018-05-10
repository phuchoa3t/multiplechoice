<?php
/* @var $this ExamcodeController */
/* @var $model Examcode */

$this->breadcrumbs=array(
	'Examcodes'=>array('index'),
	$model->ec_id,
);

$this->menu=array(
	array('label'=>'List Examcode', 'url'=>array('index')),
	array('label'=>'Create Examcode', 'url'=>array('create')),
	array('label'=>'Update Examcode', 'url'=>array('update', 'id'=>$model->ec_id)),
	array('label'=>'Delete Examcode', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ec_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Examcode', 'url'=>array('admin')),
);
?>

<h1>View Examcode #<?php echo $model->ec_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ec_id',
		'ec_name',
	),
)); ?>
