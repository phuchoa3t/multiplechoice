<?php
/* @var $this PartController */
/* @var $model Part */

$this->breadcrumbs=array(
	'Parts'=>array('index'),
	$model->p_id=>array('view','id'=>$model->p_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Part', 'url'=>array('index')),
	array('label'=>'Create Part', 'url'=>array('create')),
	array('label'=>'View Part', 'url'=>array('view', 'id'=>$model->p_id)),
	array('label'=>'Manage Part', 'url'=>array('admin')),
);
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<i class="entypo-plus"></i> Cập Nhật Part <?php echo $model->p_id; ?>				</div>
			</div>
			<?php $this->renderPartial('_form', array('model'=>$model)); ?>		</div>
	</div>
</div>