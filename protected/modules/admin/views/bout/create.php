<?php
/* @var $this BoutController */
/* @var $model Bout */

$this->breadcrumbs=array(
	'Bouts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Bout', 'url'=>array('index')),
	array('label'=>'Manage Bout', 'url'=>array('admin')),
);
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<i class="entypo-plus"></i> Thêm Mới Bout				</div>
			</div>
			<?php $this->renderPartial('_form', array('model'=>$model)); ?>		</div>
	</div>
</div>
