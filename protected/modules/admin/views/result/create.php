<?php
/* @var $this ResultController */
/* @var $model Result */

$this->breadcrumbs=array(
	'Results'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Result', 'url'=>array('index')),
	array('label'=>'Manage Result', 'url'=>array('admin')),
);
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<i class="entypo-plus"></i> Thêm Mới Result				</div>
			</div>
			<?php $this->renderPartial('_form', array('model'=>$model)); ?>		</div>
	</div>
</div>
