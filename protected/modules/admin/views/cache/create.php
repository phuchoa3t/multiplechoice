<?php
/* @var $this CacheController */
/* @var $model Cache */

$this->breadcrumbs=array(
	'Caches'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Cache', 'url'=>array('index')),
	array('label'=>'Manage Cache', 'url'=>array('admin')),
);
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<i class="entypo-plus"></i> Thêm Mới Cache				</div>
			</div>
			<?php $this->renderPartial('_form', array('model'=>$model)); ?>		</div>
	</div>
</div>
