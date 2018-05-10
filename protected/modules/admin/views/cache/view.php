<?php
/* @var $this CacheController */
/* @var $model Cache */

$this->breadcrumbs=array(
	'Caches'=>array('index'),
	$model->c_id,
);

$this->menu=array(
	array('label'=>'List Cache', 'url'=>array('index')),
	array('label'=>'Create Cache', 'url'=>array('create')),
	array('label'=>'Update Cache', 'url'=>array('update', 'id'=>$model->c_id)),
	array('label'=>'Delete Cache', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->c_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Cache', 'url'=>array('admin')),
);
?>

<h1>View Cache #<?php echo $model->c_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'c_id',
		'st_id',
		'ec_id',
		'b_id',
		'data',
	),
)); ?>
