<?php
/* @var $this CacheController */
/* @var $model Cache */

$this->breadcrumbs=array(
	'Caches'=>array('index'),
	$model->c_id=>array('view','id'=>$model->c_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Cache', 'url'=>array('index')),
	array('label'=>'Create Cache', 'url'=>array('create')),
	array('label'=>'View Cache', 'url'=>array('view', 'id'=>$model->c_id)),
	array('label'=>'Manage Cache', 'url'=>array('admin')),
);
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<i class="entypo-plus"></i> Cập Nhật Cache <?php echo $model->c_id; ?>				</div>
			</div>
			<?php $this->renderPartial('_form', array('model'=>$model)); ?>		</div>
	</div>
</div>