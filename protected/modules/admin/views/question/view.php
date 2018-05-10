<?php
/* @var $this QuestionController */
/* @var $model Question */

$this->breadcrumbs=array(
	'Questions'=>array('index'),
	$model->qs_id,
);

$this->menu=array(
	array('label'=>'List Question', 'url'=>array('index')),
	array('label'=>'Create Question', 'url'=>array('create')),
	array('label'=>'Update Question', 'url'=>array('update', 'id'=>$model->qs_id)),
	array('label'=>'Delete Question', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->qs_id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>Xem Câu Hỏi #<?php echo $model->qs_id; ?></h1>
<div class="row">
	<table class="table table-bordered">
	<thead>
		<tr>
			<th>Câu Hỏi</th>
			<th><blockquote class="blockquote-default"><?php echo $model->qs_content; ?></blockquote></th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>Ghi Chú</td>
			<td><?php echo $model->qs_note; ?></td>
		</tr>

		<tr>
			<td>Câu Hỏi Số</td>
			<td><?php echo $model->qs_num; ?></td>
		</tr>

		<tr>
			<td>Đáp Án</td>
			<td>
				<ul>
					<?php
						$as = Answer::model()->findAll('qs_id=:qs', array(':qs'=>$model->qs_id));
						foreach ($as as $key => $value) {
							echo "<li>".$value->as_value.(($value->as_id == $model->as_id)?" <div class='label label-success'>Correct</div>":"")."</li>";
						}
					?>
				</ul>
			</td>
		</tr>
	</tbody>
	</table>
</div>
