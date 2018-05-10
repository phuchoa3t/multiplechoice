<?php
/* @var $this QuestionController */
/* @var $model Question */

$this->breadcrumbs=array(
	'Questions'=>array('index'),
	$model->qs_id=>array('view','id'=>$model->qs_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Question', 'url'=>array('index')),
	array('label'=>'Create Question', 'url'=>array('create')),
	array('label'=>'View Question', 'url'=>array('view', 'id'=>$model->qs_id)),
	array('label'=>'Manage Question', 'url'=>array('admin')),
);
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<i class="entypo-plus"></i> Cập Nhật Question <?php echo $model->qs_id; ?>				</div>
			</div>
			<?php $this->renderPartial('_form', array('model'=>$model)); ?>		</div>
	</div>
</div>