<?php
/* @var $this BoutController */
/* @var $model Bout */

$this->breadcrumbs=array(
	'Bouts'=>array('index'),
	$model->b_id,
);

$this->menu=array(
	array('label'=>'List Bout', 'url'=>array('index')),
	array('label'=>'Create Bout', 'url'=>array('create')),
	array('label'=>'Update Bout', 'url'=>array('update', 'id'=>$model->b_id)),
	array('label'=>'Delete Bout', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->b_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Bout', 'url'=>array('admin')),
);
?>

<h1>View Bout #<?php echo $model->b_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'b_id',
		'b_name',
		'b_config',
		'b_status',
		'b_time',
		'ec_id',
	),
)); ?>
