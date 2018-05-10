<?php
/* @var $this PartController */
/* @var $model Part */

$this->breadcrumbs=array(
	'Parts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Part', 'url'=>array('index')),
	array('label'=>'Manage Part', 'url'=>array('admin')),
);
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<i class="entypo-plus"></i> Thêm Mới Part				</div>
			</div>
			<?php $this->renderPartial('_form', array('model'=>$model)); ?>		</div>
	</div>
</div>
