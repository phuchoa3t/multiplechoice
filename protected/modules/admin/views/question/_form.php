<?php
/* @var $this QuestionController */
/* @var $model Question */
/* @var $form CActiveForm */
?>

<div class="panel-body">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'question-form',
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
		<label class="col-sm-3 control-label"><?php echo $form->labelEx($model,'qs_num'); ?>
</label>
		<div class="col-sm-5">
			<?php echo $form->numberField($model,'qs_num', array('class'=>'form-control')); ?>
			<?php echo $form->error($model,'qs_num'); ?>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->labelEx($model,'qs_content'); ?>
</label>
		<div class="col-sm-9">
			<?php
				$this->widget('ext.redactor.ERedactorWidget',array(
				    'model'=>$model,
				    'attribute'=>'qs_content',
				    'options'=>array(
				        'fileUpload'=>Yii::app()->createUrl('file/fileUpload',array(
				            'attr'=>'question'
				        )),
				        'fileUploadErrorCallback'=>new CJavaScriptExpression(
				            'function(obj,json) { toastr.error(json.error); }'
				        ),
				        'imageUpload'=>Yii::app()->createUrl('file/imageUpload',array(
				            'attr'=>'question'
				        )),
				        'imageGetJson'=>Yii::app()->createUrl('file/imageList',array(
				            'attr'=>'question'
				        )),
				        'imageUploadErrorCallback'=>new CJavaScriptExpression(
				            'function(obj,json) { toastr.error(json.error); }'
				        ),
				    )
				));
			?>
			<?php echo $form->error($model,'qs_content'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->labelEx($model,'qs_note'); ?>
</label>
		<div class="col-sm-9">
			<?php
				$this->widget('ext.redactor.ERedactorWidget',array(
				    'model'=>$model,
				    'attribute'=>'qs_note',
				    'options'=>array(
				        'fileUpload'=>Yii::app()->createUrl('file/fileUpload',array(
				            'attr'=>'question'
				        )),
				        'fileUploadErrorCallback'=>new CJavaScriptExpression(
				            'function(obj,json) { toastr.error(json.error); }'
				        ),
				        'imageUpload'=>Yii::app()->createUrl('file/imageUpload',array(
				            'attr'=>'question'
				        )),
				        'imageGetJson'=>Yii::app()->createUrl('file/imageList',array(
				            'attr'=>'question'
				        )),
				        'imageUploadErrorCallback'=>new CJavaScriptExpression(
				            'function(obj,json) { toastr.error(json.error); }'
				        ),
				    )
				));
			?>
			<?php echo $form->error($model,'qs_note'); ?>
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
				echo $form->dropDownList($model,'ec_id', $raw,array('class'=>'form-control', 'prompt'=>'--- Mã Đề ---', 'data-validate'=>'required',));
			?>
			<?php echo $form->error($model,'ec_id'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->labelEx($model,'p_id'); ?>
</label>
		<div class="col-sm-5">
			<?php
				$result = Part::model()->findAll();
				$raw = array();
				foreach ($result as $key => $value) {
					$raw[$value['p_id']] = $value['p_name'];
				}
				echo $form->dropDownList($model,'p_id', $raw,array('class'=>'form-control', 'prompt'=>'--- Phần Đề Thi ---', 'data-validate'=>'required',));
			?>
			<?php echo $form->error($model,'p_id'); ?>
		</div>
	</div>
	<?php 
		if($model->isNewRecord){
	?>
		<div class="form-group">
			<label class="col-sm-3 control-label"><?php echo $form->labelEx($model,'as_id'); ?></label>
			<div class="col-sm-9" id="as">
				<div class="row" id="as-1">
					<div class="col-sm-1"><input type="radio" name="as" value="1" checked /></div>
					<div class="col-sm-5">
						<?php echo CHtml::textField('answer[as-1]', '',array('class'=>'form-control')); ?>
					</div>
					<div class="col-sm-3"><?php echo CHtml::Button('+ Thêm Đáp Án', array('class'=>'btn', 'id'=>'add_answer')); ?></div>
				</div>
			</div>
		</div>

				<script type="text/javascript">
					var as = 1;
					$("#add_answer").click(function(e){
						e.preventDefault();
						$('#as').append('<div class="row" id="as-' + (as + 1) +'"><div class="col-sm-1"><input type="radio" name="as" value="' + (as + 1) +'"/></div><div class="col-sm-5"><input class="form-control" type="text" value="" name="answer[as-' + (as + 1) +']"></div><div class="col-sm-3"></div></div>');
						as++;
					});
				</script>
	<?php
		} else {
			$result = Answer::model()->findAll('qs_id=:qs', array(':qs'=>$model->qs_id));
			if(count($result)){
				?>
				<div class="form-group">
					<label class="col-sm-3 control-label"><?php echo $form->labelEx($model,'as_id'); ?></label>
					<div class="col-sm-5">
				<?php
				$raw = array();
				foreach ($result as $key => $value) {
					$raw[$value['as_id']] = $value['as_value']; 
				}
				echo $form->dropDownList($model,'as_id', $raw,array('class'=>'form-control', 'prompt'=>'--- Đáp án ---', 'data-validate'=>'required',));
				?>
					</div>
				</div>
				<?php
			} else {
				?>
					<div class="form-group">
			<label class="col-sm-3 control-label"><?php echo $form->labelEx($model,'as_id'); ?></label>
			<div class="col-sm-9" id="as">
				<div class="row" id="as-1">
					<div class="col-sm-1"><input type="radio" name="as" value="1" checked /></div>
					<div class="col-sm-5">
						<?php echo CHtml::textField('answer[as-1]', '',array('class'=>'form-control')); ?>
					</div>
					<div class="col-sm-3"><?php echo CHtml::Button('+ Thêm Đáp Án', array('class'=>'btn', 'id'=>'add_answer')); ?></div>
				</div>
			</div>
		</div>

				<script type="text/javascript">
					var as = 1;
					$("#add_answer").click(function(e){
						e.preventDefault();
						$('#as').append('<div class="row" id="as-' + (as + 1) +'"><div class="col-sm-1"><input type="radio" name="as" value="' + (as + 1) +'"/></div><div class="col-sm-5"><input class="form-control" type="text" value="" name="answer[as-' + (as + 1) +']"></div><div class="col-sm-3"></div></div>');
						as++;
					});
				</script>
				<?php
			}
		}
	?>
<div class="form-group">
	<div class="col-sm-offset-3 col-sm-5">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Thêm Mới' : 'Cập Nhật', array('class'=>'btn')); ?>
	</div>
</div>

<?php $this->endWidget(); ?>
</div>