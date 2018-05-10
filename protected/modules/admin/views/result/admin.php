<?php
/* @var $this ResultController */
/* @var $model Result */

$this->breadcrumbs=array(
	'Results'=>array('index'),
	'Manage',
);

$this->menu=array(
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#result-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Thống Kê Kết Quả</h1>

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
				<?php echo CHtml::link('Export', "javascript:void(0);",array('id'=>'btnExport')); ?>
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
<div class="modal fade" id="cancelExam" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Xác nhận lý do</h4>
			</div>

			<div class="modal-body">
				Hello I am a Modal!
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-info">Save changes</button>
			</div>
		</div>
	</div>
</div>

<?php
$template = "{view}";
$role = explode("-", Yii::app()->user->role);
$super = ["S","A","C","R","U","D"];
if(!array_diff($super, $role)){
	$template .=" {delete}";

}
 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'result-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'summaryText' => "Hiển thị {start} - {end} trong {count}",
	'htmlOptions' => array('class' => 'dataTables_wrapper form-inline'),
	'itemsCssClass' => 'table table-bordered',
	'columns'=>array(
		'rs_id',
		array(
			'name'=>'st_id',
			'value'=>'$data->st->st_name'
		),
		array(
			'name'=>'b_id',
			'value'=>'$data->b->b_name'
		),
		array(
			'name'=>'Môn',
			'value'=>'$data->b->sj->sj_name'
		),
		'point',
		'reason',
		array(
			'name'=>'cancel',
			'sortable'=>true,
			'type'=>'raw',
			'value'=>'(($data->cancel)?(CHtml::link(\'<i class="entypo-check"></i>\', array("/admin/result/cancel/id/$data->rs_id"), array("onclick"=>"", "class" => "btn btn-green btn-sm", "style" => "padding: 4px 5px;"))):(CHtml::link(\'<i class="entypo-cancel"></i>\', array("/admin/result/cancel/id/$data->rs_id"), array("onclick"=>"return doThis(this)", "class" => "btn btn-red btn-sm", "style" => "padding: 4px 5px;"))))',
		),
		array('class'=>'CButtonColumn',
		    'template'=> $template,
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
<script type="text/javascript">
	function doThis(e) {
		$url = e.href;
		$reason = prompt('Lý do hủy bài?');
		if ($reason == null || $reason == "") {
			return false;
	    }
		$link = $url+"?reason="+$reason;
		e.href = $link;
	}

	$("#btnExport").click(function(e) {
		e.preventDefault();
		data = $("#fExport").serialize();
		window.location = "<?php echo Yii::app()->createUrl('admin/result/export'); ?>?"+data;
	})
</script>