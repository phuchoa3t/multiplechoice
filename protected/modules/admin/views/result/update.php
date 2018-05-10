<?php
/* @var $this ResultController */
/* @var $model Result */

$this->breadcrumbs=array(
	'Results'=>array('index'),
	$model->rs_id=>array('view','id'=>$model->rs_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Result', 'url'=>array('index')),
	array('label'=>'Create Result', 'url'=>array('create')),
	array('label'=>'View Result', 'url'=>array('view', 'id'=>$model->rs_id)),
	array('label'=>'Manage Result', 'url'=>array('admin')),
);
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<i class="entypo-plus"></i> Cập Nhật Result <?php echo $model->rs_id; ?>				</div>
			</div>
			<?php $this->renderPartial('_form', array('model'=>$model)); ?>		</div>
	</div>
</div>