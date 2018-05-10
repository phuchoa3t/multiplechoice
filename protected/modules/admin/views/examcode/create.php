<?php
/* @var $this ExamcodeController */
/* @var $model Examcode */

$this->breadcrumbs=array(
	'Examcodes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Examcode', 'url'=>array('index')),
	array('label'=>'Manage Examcode', 'url'=>array('admin')),
);
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">
					<i class="entypo-plus"></i> Thêm Mới Examcode				</div>
			</div>
			<?php $this->renderPartial('_form', array('model'=>$model)); ?>		</div>
	</div>
</div>
