<?php
class FileController extends Controller
{
	public function actions()
    {
        return array(
            'fileUpload'=>array(
                'class'=>'ext.redactor.actions.FileUpload',
                'uploadPath'=>'assets/uploads/files',
                'uploadUrl'=>Yii::app()->createUrl('assets/uploads/files'),
                'uploadCreate'=>true,
                'permissions'=>0755,
            ),
            'imageUpload'=>array(
                'class'=>'ext.redactor.actions.ImageUpload',
                'uploadPath'=>'assets/uploads/images',
                'uploadUrl'=>Yii::app()->createUrl('assets/uploads/images'),
                'uploadCreate'=>true,
                'permissions'=>0755,
            ),
            'imageList'=>array(
                'class'=>'ext.redactor.actions.ImageList',
                'uploadPath'=>'assets/uploads/images',
                'uploadUrl'=>Yii::app()->createUrl('assets/uploads/images'),
            ),
        );
    }
}