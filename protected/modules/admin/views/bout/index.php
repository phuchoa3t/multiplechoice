<?php
/* @var $this BoutController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Bouts',
);

$this->menu=array(
	array('label'=>'Create Bout', 'url'=>array('create')),
	array('label'=>'Manage Bout', 'url'=>array('admin')),
);
?>

<h1>Bouts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
