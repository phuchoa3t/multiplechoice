<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */

<?php
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	'Manage',
);\n";
?>

$this->menu=array(
	array('label'=>'List <?php echo $this->modelClass; ?>', 'url'=>array('index')),
	array('label'=>'Create <?php echo $this->modelClass; ?>', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#<?php echo $this->class2id($this->modelClass); ?>-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage <?php echo $this->pluralize($this->class2name($this->modelClass)); ?></h1>

<p>
Có thể sử dụng các toán tử (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) ở đầu từ khóa để tìm.(VD: >=1)
</p>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title"><?php echo "<?php echo CHtml::link('Tìm Kiếm','#',array('class'=>'search-button')); ?>"; ?></div>
				<div class="panel-options">
				<a href="<?php echo Yii::app()->createUrl('admin//create');?>" class="bg">
				   <i class="entypo-plus"></i>
				   Thêm Mới
				</a>
				</div>
			</div>
		<div class="search-form" style="display:none">
		<?php echo "<?php \$this->renderPartial('_search',array(
			'model'=>\$model,
		)); ?>\n"; ?>
		</div><!-- search-form -->
		</div>
	</div>
</div>


<?php echo "<?php"; ?> $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'<?php echo $this->class2id($this->modelClass); ?>-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'summaryText' => "Hiển thị {start} - {end} trong {count}",
	'htmlOptions' => array('class' => 'dataTables_wrapper form-inline'),
	'itemsCssClass' => 'table table-bordered',
	'columns'=>array(
<?php
$count=0;
foreach($this->tableSchema->columns as $column)
{
	if(++$count==7)
		echo "\t\t/*\n";
	echo "\t\t'".$column->name."',\n";
}
if($count>=7)
	echo "\t\t*/\n";
?>
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
