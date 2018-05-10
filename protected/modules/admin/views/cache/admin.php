<?php
/* @var $this CacheController */
/* @var $model Cache */

$this->breadcrumbs=array(
	'Caches'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Cache', 'url'=>array('index')),
	array('label'=>'Create Cache', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#cache-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Caches</h1>

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
				<a href="/tn/admin/cache/create" class="bg">
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
	'id'=>'cache-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'summaryText' => "Hiển thị {start} - {end} trong {count}",
	'htmlOptions' => array('class' => 'dataTables_wrapper form-inline'),
	'itemsCssClass' => 'table table-bordered',
	'columns'=>array(
		'c_id',
		'st_id',
		'ec_id',
		'b_id',
		'data',
		array('class'=>'CButtonColumn',
		    'template'=>'{update} {delete} {view}',
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
		    ),
		),
	),
)); ?>
