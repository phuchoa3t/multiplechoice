<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="span-19">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<br/>
<style>
	.errorMessage {
		color: red;
	}
	.errorMessage:before {
		content: '\a';
		white-space: pre;
	}
</style>
<div class="span-5 last">
	<div id="sidebar">
	<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Các Chức Năng',
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'list-group', 'style'=>'list-style:none'),
			'itemCssClass' =>'list-group-item',
			'itemTemplate' => '<i class="entypo-right-open"></i> {menu}',
		));
		$this->endWidget();
	?>
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>