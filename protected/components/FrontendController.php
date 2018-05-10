<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class FrontendController extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/frontend';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array(
					array('label'=>'UTT Test <i class="entypo-clipboard"></i>', 'url'=>'', 'linkOptions'=>array('onclick'=>'return false;', 'style'=>'color:#F68F43;font-size: large;', 'class'=>'hidden-xs')),
					array('label'=>'Trang Chủ', 'url'=>array('/')),
					array('label'=>'UTT', 'url'=>'http://utt.edu.vn'),
				);
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	public $modal = "";//$tilte $content $button
}