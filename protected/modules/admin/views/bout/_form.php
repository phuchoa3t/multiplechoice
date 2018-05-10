<?php
/* @var $this BoutController */
/* @var $model Bout */
/* @var $form CActiveForm */
?>

<div class="panel-body">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bout-form',
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
)); ?>

	<p class="note">Các trường <span class="required">*</span> là bắt buộc.</p>

	<?php //echo $form->errorSummary($model); ?>

	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->labelEx($model,'b_name'); ?>
</label>
		<div class="col-sm-5">
			<?php echo $form->textField($model,'b_name',array('size'=>60,'maxlength'=>100,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'b_name'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->labelEx($model,'b_config'); ?>
</label>
		<div class="col-sm-5">
			<?php echo $form->textField($model,'b_config',array('size'=>50,'maxlength'=>50,'class'=>'form-control')); ?>
			<?php echo $form->error($model,'b_config'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->labelEx($model,'b_status'); ?>
</label>
		<div class="col-sm-5">
			<?php
				$raw = array('0'=>'Đóng','1'=>'Hoạt Động','2'=>'Hoạt Động(Không cho vào thi)');
				echo $form->dropDownList($model,'b_status', $raw, array('class'=>'form-control', 'prompt'=>'--- Trạng Thái ---', 'data-validate'=>'required',));
			?>
			<?php echo $form->error($model,'b_status'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->labelEx($model,'b_time'); ?>
</label>
		<div class="col-sm-5">
			<?php echo $form->numberField($model,'b_time', array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'b_time'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->labelEx($model,'sj_id'); ?>
</label>
		<div class="col-sm-5">
			<?php
				$result = Subject::model()->findAll();
				$raw = array();
				foreach ($result as $key => $value) {
					$raw[$value['sj_id']] = $value['sj_name'];
				}
				echo $form->dropDownList($model,'sj_id', $raw,array('class'=>'form-control', 'prompt'=>'--- Môn ---', 'data-validate'=>'required','ajax'=>array(
                                'type'=>'POST',
                                'url'=>$this->createUrl('bout/ajax'),
                                'update'=>'#'.CHtml::activeId($model, 'ec_id'),
                                'data'=>array('sj_id'=>'js:this.value'),
                            )));
			?>
			<?php echo $form->error($model,'sj_id'); ?>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->labelEx($model,'ec_id'); ?>
</label>
		<div class="col-sm-5">
			<?php
				$result = Examcode::model()->findAll();
				$raw = array();
				foreach ($result as $key => $value) {
					$raw[$value['ec_id']] = $value['ec_name']; 
				}
				$options = [];
				if($model->ec_id != ""){
					$ec_ids = explode(",", $model->ec_id);
					foreach ($ec_ids as $keyec => $ec_id) {
						$options[$ec_id] = array('selected' => 'selected');
					}
				}
				echo $form->ListBox($model,'ec_id', $raw, array('style'=>'width:100%','class'=>'select2', 'prompt'=>'--- Đề thi ---', 'data-validate'=>'required','multiple' => 'multiple', 'options' => $options));
			?>
			<?php echo $form->error($model,'ec_id'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->labelEx($model,'b_type'); ?>
</label>
		<div class="col-sm-5">
			<?php
				$raw = array('0'=>'BÀI THI KẾT THÚC HỌC PHẦN','1'=>'BÀI KIỂM TRA');
				echo $form->dropDownList($model,'b_type', $raw, array('class'=>'form-control', 'prompt'=>'--- Hình thức ---', 'data-validate'=>'required'));
			?>
			<?php echo $form->error($model,'b_type'); ?>
		</div>
	</div>
<div class="form-group">
	<div class="col-sm-offset-3 col-sm-5">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Thêm Mới' : 'Cập Nhật', array('class'=>'btn')); ?>
	</div>
</div>

<?php $this->endWidget(); ?>
</div>
<script>
$("select#<?php echo CHtml::activeId($model, 'sj_id')?>").change( function(e) {
	if($("select#<?php echo CHtml::activeId($model, 'sj_id')?>").val()>0){
		$("select#<?php echo CHtml::activeId($model, 'ec_id')?>").removeAttr('disabled');
	} else {
		$("select#<?php echo CHtml::activeId($model, 'ec_id')?>").attr('disabled','disabled');
	}
});

</script>