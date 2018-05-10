<?php
/* @var $this SubjectController */
/* @var $model Subject */

$this->breadcrumbs=array(
	'Subjects'=>array('index'),
	$model->sj_id=>array('view','id'=>$model->sj_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Subject', 'url'=>array('index')),
	array('label'=>'Create Subject', 'url'=>array('create')),
	array('label'=>'View Subject', 'url'=>array('view', 'id'=>$model->sj_id)),
	array('label'=>'Manage Subject', 'url'=>array('admin')),
);
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<i class="entypo-plus"></i> Cập Nhật Subject <?php echo $model->sj_id; ?>				</div>
			</div>
			<?php $this->renderPartial('_form', array('model'=>$model)); ?>		</div>
	</div>
</div>