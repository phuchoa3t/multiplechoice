<?php
/* @var $this PartController */
/* @var $model Part */

$this->breadcrumbs=array(
	'Parts'=>array('index'),
	$model->p_id,
);

$this->menu=array(
	array('label'=>'List Part', 'url'=>array('index')),
	array('label'=>'Create Part', 'url'=>array('create')),
	array('label'=>'Update Part', 'url'=>array('update', 'id'=>$model->p_id)),
	array('label'=>'Delete Part', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->p_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Part', 'url'=>array('admin')),
);
?>

<h1>View Part #<?php echo $model->p_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'p_id',
		'p_name',
		'p_note',
	),
)); ?>
