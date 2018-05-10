<?php
/* @var $this QuestionController */
/* @var $model Question */

$this->breadcrumbs=array(
	'Questions'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Question', 'url'=>array('index')),
	array('label'=>'Create Question', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#question-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Questions</h1>

<p>
Có thể sử dụng các toán tử (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) ở đầu từ khóa để tìm.(VD: >=1)
</p>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title"><?php echo CHtml::link('Tìm Kiếm','#',array('class'=>'search-button')); ?></div>
				<div class="panel-options">
				<a href="/tn/admin/question/create" class="bg">
				   <i class="entypo-plus"></i>
				   Thêm Mới
				</a>
				</div>
			</div>
		<div class="search-form" style="display:none">
		<?php $this->renderPartial('_search',array(
			'model'=>$model,
		)); ?>
		</div><!-- search-form -->
		</div>
	</div>
</div>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'question-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'summaryText' => "Hiển thị {start} - {end} trong {count}",
	'htmlOptions' => array('class' => 'dataTables_wrapper form-inline'),
	'itemsCssClass' => 'table table-bordered',
	'columns'=>array(
		'qs_id',
		'qs_num',
		'qs_content',
		'qs_note',
		array(
			'name'=>'ec_id',
			'value'=>'$data->ec->ec_name'
		),
		// array(
		// 	'name'=>'p_id',
		// 	'value'=>'$data->part->p_name'
		// ),
		array(
			'name'=>'as_id',
			'value'=>'$data->as->as_value'
		),
		array('class'=>'CButtonColumn',
		    'template'=>'{update} {delete} {view} {answer}',
		    'deleteConfirmation' => 'Bạn có chắc muốn xóa đối tượng này không?',
		    'buttons'=>array (
		        'update'=> array(
		            'label'=>'<i class="entypo-pencil"></i> Sửa',
		            'imageUrl'=>false,
		            'options'=>array( 'class'=>'btn btn-default btn-sm btn-icon icon-left' ),
		        ),
		        'view'=>array(
		            'label'=>'<i class="entypo-eye"></i> Xem',
		            'imageUrl'=>false,
		            'options'=>array( 'class'=>'btn btn-info btn-sm btn-icon icon-left' ),
		        ),
		        'delete'=>array(
		            'label'=>'<i class="entypo-cancel"></i> Xóa',
		            'imageUrl'=>false,

		            'options'=>array( 'class'=>'btn btn-danger btn-sm btn-icon icon-left' ),

		        ),
		        'answer'=>array(
		            'label'=>'<i class="entypo-docs"></i> Đáp Án',
		            'imageUrl'=>false,
		            'options'=>array( 'class'=>'btn btn-primary btn-sm btn-icon icon-left' ),
		            'url'=>'Yii::app()->createUrl("admin/answer?Answer[qs_id]=$data->qs_id")',
		        ),
		    ),
		),
	),
)); ?>
