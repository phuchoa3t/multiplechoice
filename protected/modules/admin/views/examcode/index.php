<?php
/* @var $this ExamcodeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Examcodes',
);

$this->menu=array(
	array('label'=>'Create Examcode', 'url'=>array('create')),
	array('label'=>'Manage Examcode', 'url'=>array('admin')),
);
?>

<h1>Examcodes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
