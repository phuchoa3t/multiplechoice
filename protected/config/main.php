<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Trắc Nghiệm Online',
	'defaultController'=>'home',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.modules.admin.models.*',
		'application.components.*',
		'application.vendor.PHPExcel.PHPExcel',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123456',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		'admin',//Module admin
		// 'home', //Module front-end
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'loginUrl' => ['authentication/login'],	//Link for login using accessRules
		),

		'widgetFactory'=>array(
			'widgets'=>array(
				//Style for Pagination
				'CLinkPager'=>array(
					'maxButtonCount'       => 5,
					'header'               => '',
					'nextPageLabel'        => 'Next <i class="entypo-right-thin"></i>',
					'prevPageLabel'        => '<i class="entypo-left-thin"></i> Back',
					'lastPageLabel'        => 'Trang Cuối',
					'firstPageLabel'       => 'Trang Đầu',
					'selectedPageCssClass' => 'active',
					'hiddenPageCssClass'   => 'disabled',
					'htmlOptions'          => array('class' => 'pagination pagination-sm',),
					// 'cssFile' => Yii::app()->baseUrl.'/css/pager.css',
				),
				//Style for gridview
				'CGridView'=>array(
					// 'cssFile' => Yii::app()->baseUrl.'/css/style-gridview.css',
				),
			),
        ),

		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),

		//authenticate Manager
		'authManager'=>array(
	         'class' => 'CDbAuthManager',
	         'connectionID' => 'db',
	         'itemTable' => 'Account',
	         'assignmentTable'=>'Account',
	         'defaultRoles' => array('guest'),
	     ),

		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>YII_DEBUG ? null : 'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),

		//Error Page Throw
		// 'errorHandler'=>array(
  //           'errorAction'=>'authentication/error',
  //       ),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'ndna2606@gmail.com',
		'STUDENT' => 2,
		'TEACHER' => 1,
		'GRADUATESTUDENT' => 3,
		'ENTERPRISE' => 4,
	),

	'language'=>'vi',

	'timeZone' => 'Asia/Ho_Chi_Minh',
);
