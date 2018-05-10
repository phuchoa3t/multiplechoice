<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->id,
);
?>
<section class="features-blocks">
    <div class="container">
        <form method="post">
       
        <div class="row" id="Student">
            <div class="col-md-12">
                <div class="row">
                    <h4 class="text-center" style="color:black;text-transform: uppercase;
    font-size: 23px;">HỆ THỐNG THI / KIỂM TRA TRẮC NGHIỆM TRÊN MÁY</h4>

                </div>
               <?php if(Yii::app()->user->hasFlash('error')):?>
                    <div id="toast-container" class="toast-top-right"><div class="toast toast-error"><div class="toast-message"><?php echo Yii::app()->user->getFlash('error'); ?></div></div></div>
                <?php endif; ?>
                 <?php if(Yii::app()->user->hasFlash('success')):?>
                <div id="toast-container" class="toast-top-right"><div class="toast toast-success"><div class="toast-message"><?php echo Yii::app()->user->getFlash('success'); ?></div></div></div>
            <?php endif; ?>
                <div class="row">
                    <div class="col-md-6">
                        <label>Mã sinh viên</label>
                        <input class="form-control" type="" name="st_code" placeholder="Nhập mã sinh viên" required="">
                    </div>
                    <div class="col-md-6">
                        <label>Họ tên</label>
                        <input class="form-control" type="" name="st_name" placeholder="Nhập họ và tên" required="">
                    </div>
                </div>
                <div class="row" style="margin-top:20px;">
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php echo CHtml::htmlButton('Bắt Đầu Làm Bài <i class="entypo-to-end"></i>', array('class'=>'btn btn-primary', 'type'=>'submit', 'id'=>'StartSurvey')); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </form>
    </div>
</section>
<br/>