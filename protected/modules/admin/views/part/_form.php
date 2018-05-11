<?php
/* @var $this PartController */
/* @var $model Part */
/* @var $form CActiveForm */
?>

<div class="panel-body">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'part-form',
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
		<label class="col-sm-3 control-label"><?php echo $form->labelEx($model,'p_name'); ?>
</label>
		<div class="col-sm-5">
            <?php
            $this->widget('ext.redactor.ERedactorWidget',array(
                'model'=>$model,
                'attribute'=>'p_name',
                'options'=>array(
                    'fileUpload'=>Yii::app()->createUrl('file/fileUpload',array(
                        'attr'=>'part'
                    )),
                    'fileUploadErrorCallback'=>new CJavaScriptExpression(
                        'function(obj,json) { toastr.error(json.error); }'
                    ),
                    'imageUpload'=>Yii::app()->createUrl('file/imageUpload',array(
                        'attr'=>'part'
                    )),
                    'imageGetJson'=>Yii::app()->createUrl('file/imageList',array(
                        'attr'=>'part'
                    )),
                    'imageUploadErrorCallback'=>new CJavaScriptExpression(
                        'function(obj,json) { toastr.error(json.error); }'
                    ),
                )
            ));
            ?>
<!--			--><?php //echo $form->textArea($model,'p_name',array('rows'=>6, 'cols'=>50, 'class'=>'form-control')); ?>
			<?php echo $form->error($model,'p_name'); ?>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 control-label"><?php echo $form->labelEx($model,'p_note'); ?>
</label>
		<div class="col-sm-5">
			<?php
				$this->widget('ext.redactor.ERedactorWidget',array(
				    'model'=>$model,
				    'attribute'=>'p_note',
				    'options'=>array(
				        'fileUpload'=>Yii::app()->createUrl('file/fileUpload',array(
				            'attr'=>'part'
				        )),
				        'fileUploadErrorCallback'=>new CJavaScriptExpression(
				            'function(obj,json) { toastr.error(json.error); }'
				        ),
				        'imageUpload'=>Yii::app()->createUrl('file/imageUpload',array(
				            'attr'=>'part'
				        )),
				        'imageGetJson'=>Yii::app()->createUrl('file/imageList',array(
				            'attr'=>'part'
				        )),
				        'imageUploadErrorCallback'=>new CJavaScriptExpression(
				            'function(obj,json) { toastr.error(json.error); }'
				        ),
				    )
				));
			?>
			<?php echo $form->error($model,'p_note'); ?>
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
		<label class="col-sm-3 control-label"><?php echo $form->labelEx($model,'p_type'); ?>
</label>
		<div class="col-sm-5">
			<?php
				$raw = array('1'=>'Nghe','2'=>'Đọc');
				echo $form->dropDownList($model,'p_type', $raw, array('class'=>'form-control', 'prompt'=>'--- Loại ---', 'data-validate'=>'',));
			?>
			<?php echo $form->error($model,'p_type'); ?>
		</div>
	</div>
<div class="form-group">
	<div class="col-sm-offset-3 col-sm-5">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Thêm Mới' : 'Cập Nhật', array('class'=>'btn')); ?>
	</div>
</div>

<?php $this->endWidget(); ?>
</div>