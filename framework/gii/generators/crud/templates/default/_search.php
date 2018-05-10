<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getControllerClass(); ?> */
/* @var $model <?php echo $this->getModelClass(); ?> */
/* @var $form CActiveForm */
?>

<div class="panel-body">
<?php echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl(\$this->route),
	'method'=>'get',
	'htmlOptions'            => array('role'  => 'form', 'class'=>'form-horizontal form-groups-bordered')
)); ?>\n"; ?>

<?php foreach($this->tableSchema->columns as $column): ?>
<?php
	$field=$this->generateInputField($this->modelClass,$column);
	if(strpos($field,'password')!==false)
		continue;
?>
	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo "<?php echo \$form->label(\$model,'{$column->name}'); ?>\n"; ?></label>
		<div class="col-sm-5"><?php echo "<?php echo ".$this->generateActiveField($this->modelClass,$column)."; ?>\n"; ?></div>
	</div>

<?php endforeach; ?>
	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-5">
		<?php echo "<?php echo CHtml::submitButton('Search', array('class'=>'btn')); ?>\n"; ?>
		</div>
	</div>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

</div><!-- search-form -->