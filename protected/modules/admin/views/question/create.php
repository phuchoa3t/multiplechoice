<?php
/* @var $this QuestionController */
/* @var $model Question */

$this->breadcrumbs=array(
	'Questions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Question', 'url'=>array('index')),
	array('label'=>'Manage Question', 'url'=>array('admin')),
);
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<i class="entypo-plus"></i> Thêm Mới Question				</div>
			</div>
			<?php $this->renderPartial('_form', array('model'=>$model)); ?>		</div>
	</div>
</div>
