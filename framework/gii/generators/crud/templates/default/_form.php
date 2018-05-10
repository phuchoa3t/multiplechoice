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
	'id'=>'".$this->class2id($this->modelClass)."-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
	'enableClientValidation' => true,
    'clientOptions'          => array(
							        'validateOnSubmit'       => true,
							        'validateOnChange'       => true,
							    ),
    'htmlOptions'            => array('role'  => 'form', 'class'=>'form-horizontal form-groups-bordered')
)); ?>\n"; ?>

	<p class="note">Các trường <span class="required">*</span> là bắt buộc.</p>

	<?php echo "<?php //echo \$form->errorSummary(\$model); ?>\n"; ?>

<?php
foreach($this->tableSchema->columns as $column)
{
	if($column->autoIncrement)
		continue;
?>
	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo "<?php echo ".$this->generateActiveLabel($this->modelClass,$column)."; ?>\n"; ?></label>
		<div class="col-sm-5">
			<?php echo "<?php echo ".$this->generateActiveField($this->modelClass,$column)."; ?>\n"; ?>
			<?php echo "<?php echo \$form->error(\$model,'{$column->name}'); ?>\n"; ?>
		</div>
	</div>
<?php
}
?>
<div class="form-group">
	<div class="col-sm-offset-3 col-sm-5">
		<?php echo "<?php echo CHtml::submitButton(\$model->isNewRecord ? 'Thêm Mới' : 'Cập Nhật', array('class'=>'btn')); ?>\n"; ?>
	</div>
</div>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>
</div>