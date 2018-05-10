<!DOCTYPE html> <html lang="en">
<head>
  <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/frontend/js/jquery-1.11.3.min.js"></script>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Survey UTT" />
  <meta name="author" content="Anh Production" />
  <link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/frontend/images/favicon.ico">
  <title><?php echo CHtml::encode($this->pageTitle); ?> | UTT Survey</title>
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/frontend/css/bootstrap.css">
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/frontend/css/neon.css">
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/hover.css">
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/frontend/select2/css/select2.css">
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/frontend/select2/css/select2-bootstrap.css">
  </head>
<body>
  <div class="wrap">
    <div class="site-header-container container"> 
      <div class="row"> 
        <div class="col-md-12"> 
          <header class="site-header"> 
            <section class="site-logo"> 
              <a href="<?php echo Yii::app()->request->baseUrl; ?>"> 
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/assets/frontend/images/logo.png" style="width:95%"/> 
              </a> 
            </section> 
            <nav class="site-nav">
            <?php
              $this->beginWidget('zii.widgets.CMenu', array(
                'encodeLabel'=>false,
                'items'=>$this->menu,
                'htmlOptions'=>array('class'=>'main-menu hidden-xs', 'id' => 'main-menu'),
              ));
              $this->endWidget();
            ?>
              <div class="visible-xs"> 
                <a href="#" class="menu-trigger"> 
                  <i class="entypo-menu">
                  </i> 
                </a> 
              </div> 
            </nav> 
          </header>
          <div class="hidden-sm hidden-md hidden-lg" style="text-align: center; color: #F68F43; font-size: large">TOEIC Placement Test</div>
        </div> 
      </div> 
    </div>
    <hr/>
    <div class="container"> 
      <?php echo $content;?>
    </div>
    <footer class="site-footer"> 
      <div class="container"> 
        <div class="row"> 
          <div class="col-sm-6">
            &copy; <?php echo date('Y'); ?> UTT Survey
          </div> 
          <div class="col-sm-6"> 
            <ul class="social-networks text-right"> 
              <li> 
                <a href="javascript:;"> 
                  <i class="entypo-instagram">
                  </i> 
                </a> 
              </li> 
              <li> 
                <a href="javascript:;"> 
                  <i class="entypo-twitter">
                  </i> 
                </a> 
              </li> 
              <li> 
                <a href="https://www.facebook.com/DBCLUTT"> 
                  <i class="entypo-facebook">
                  </i> 
                </a> 
              </li> 
            </ul> 
          </div> 
        </div> 
      </div> 
    </footer> 
  </div>
  <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/frontend/select2/js/select2.js"></script>
  <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/frontend/js/gsap/TweenMax.min.js"></script> 
  <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/frontend/js/bootstrap.js"></script> 
  <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/frontend/js/joinable.js"></script> 
  <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/frontend/js/resizeable.js"></script> 
  <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/frontend/js/neon-slider.js"></script>
  <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/frontend/js/neon-custom.js"></script>
  <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/toastr.js"></script>
  <script>
  $("select").select2({
    placeholder: "",
    theme: 'bootstrap',
    'width': '100%',
  });
  </script>
  <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery.cookie.js"></script>
</body>
</html>