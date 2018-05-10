<?php
/* @var $this BoutController */
/* @var $model Bout */

$this->breadcrumbs=array(
	'Bouts'=>array('index'),
	$model->b_id=>array('view','id'=>$model->b_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Bout', 'url'=>array('index')),
	array('label'=>'Create Bout', 'url'=>array('create')),
	array('label'=>'View Bout', 'url'=>array('view', 'id'=>$model->b_id)),
	array('label'=>'Manage Bout', 'url'=>array('admin')),
);
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<i class="entypo-plus"></i> Cập Nhật Bout <?php echo $model->b_id; ?>				</div>
			</div>
			<?php $this->renderPartial('_form', array('model'=>$model)); ?>		</div>
	</div>
</div>