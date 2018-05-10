<?php
/* @var $this ExamcodeController */
/* @var $model Examcode */

$this->breadcrumbs=array(
	'Examcodes'=>array('index'),
	$model->ec_id=>array('view','id'=>$model->ec_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Examcode', 'url'=>array('index')),
	array('label'=>'Create Examcode', 'url'=>array('create')),
	array('label'=>'View Examcode', 'url'=>array('view', 'id'=>$model->ec_id)),
	array('label'=>'Manage Examcode', 'url'=>array('admin')),
);
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<i class="entypo-plus"></i> Cập Nhật Examcode <?php echo $model->ec_id; ?>				</div>
			</div>
			<?php $this->renderPartial('_form', array('model'=>$model)); ?>		</div>
	</div>
</div>