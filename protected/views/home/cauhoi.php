<?php 
	$st = Yii::app()->session['st'];
	$time = $questionsCookie['time'];
	$bt = Yii::app()->session['bt'];
	$questionsValue = $questionsCookie['questionsValue'];

 ?>

 <?php if(Yii::app()->user->hasFlash('error')):?>
    <div id="toast-container" class="toast-top-right"><div class="toast toast-error"><div class="toast-message"><?php echo Yii::app()->user->getFlash('error'); ?></div></div></div>
<?php endif; ?>
 <?php if(Yii::app()->user->hasFlash('success')):?>
    <div id="toast-container" class="toast-top-right"><div class="toast toast-success"><div class="toast-message"><?php echo Yii::app()->user->getFlash('success'); ?></div></div></div>
<?php endif; ?>
<style type="text/css">
	.qcontent p{
		font-size: 17px;
	}
	.pnote p{
		display: block!important;
		padding: 3px;
	}
	.message-item .qa-message-content p{
		text-align: left;
	}
	.message-item .qa-message-content p img{
		display: block;
	}
	.note{
		font-size: 18px;
	}
	.note p{
		display: block !important;
		padding: 2px;
	}
	.qs_number{
		font-size: 20px;
	}
	.radio label::before{
		content: "";
	    display: inline-block;
	    position: absolute;
	    width: 25px;
	    height: 25px;
	    left: 0;
	    margin-left: -26px;
	    border: 1px solid #727272;
	    border-radius: 50%;
	    background-color: #fff;
	    -webkit-transition: border 0.15s ease-in-out;
	    -o-transition: border 0.15s ease-in-out;
	    transition: border 0.15s ease-in-out;
	}
	.list-group-item{
		display: inline;
		background: no-repeat;
		border: none;
	}
	.radio label::after{
		width: 21px;
    height: 22px;
    left: -4px;
    top: 2px;
	}
	.radio label{
		font-size: 15px;
	}
	.part1{
		overflow: hidden;
	}
	.part1 .list-group{
		width: 45%;
		float: left;
		text-align: center;
	}
	.part1 .row{
		padding: 0;
		margin: 0;
	}
	.part1 img{
		display: inline;
	}
	.part1 li p{
		text-align: center;
	}
	.part2 ul li{
		display: inline;
		float: left;
	}
	.part2 ul{
		clear: both;
	}
	.part2{
		overflow: hidden;
	}
	.part22 .answers{
		overflow: hidden;
	}
	
	.part22 .answers li{
		width: 50%;
		float: left;
	}

	.tool-fixed {
		z-index: 99999;
		position: fixed;
		background-color: #fff;
		top: 0;
		right: 0;
	}


</style>
<section class="features-blocks">

    <div class="container">

    	<form method="post" id="form">

	    	<div class="qa-message-list">

	    		<div class="row">
	    			
	    		 	<div class="message-item hvr-float-shadow col-md-4" style="float:left;">

			    		<div class="message-inner" style="text-align: center">

							<h4><strong style="color: #F68F43"><?php echo ($bt->b_type == 1)?"BÀI KIỂM TRA":"BÀI THI KẾT THÚC HỌC PHẦN"; ?> <br/><br/><?php echo ($bt->sj->sj_name) ?></strong></h4>

			    		</div>

			    	</div>
			    	<div id="timer" class="clock col-md-4" style="    float: right;
    font-size: 30px;
    color: #f7944d;
    font-weight: bold;
    border: solid #f68f43 1px;
    padding: 11px;
    text-align: center;">
			    		<div class="row">
					      <div class="col-sm-7">
					              <div style="font-size:17px;color:#777777;">Thời gian còn lại</div>
					              <span>121 : 02</span>
					      </div>
					      <div class="col-sm-5" style="font-size: 20px; height: 100%; cursor: pointer;">
					        <div class="btn" id="gotoListen">LISTEN</div>
					        <div class="btn" id="gotoRead">READ</div>
					      </div>
					    </div>
			    	</div>
	    		</div>

		    	<div class="message-item">

		    		<div class="message-inner">

					
					
							<div class="form-gr	oup">

								Mã sinh viên: <label for="" id=""> <?php echo $st->attributes['st_code']; ?></label>

							</div>

							<div class="form-gr	oup">

								Họ và tên: <label for="" id=""> <?php echo $st->attributes['st_name']; ?></label>

							</div>

		    		</div>

		    	</div>


				<div class="message-item">

					<div class="message-inner">

						<div class="message-head clearfix">


						</div>

						<div class="qa-message-content">

					<?php
						$p_num =0;
						$p_id = 0;
						$part = null;
						foreach ($questions as $key => $value) {
							if($value->p_id != $p_id){
								$p_num ++;
								$p_id = $value->p_id;
								$part = Part::model()->findByPk($p_id);
							}else{
								$part = null;
							}
							if(array_key_exists($value->qs_id, $questionIds)){

					?>
<?php if($part != null): ?>
									<div id="<?php echo "p_".$p_num; ?>" class="pnote" style="    color: #20314b;
    font-size: 22px;"><?php echo $part->p_note ;?></div>

									<div style="
    font-size: 22px;text-align: center;"><?php echo $part->p_name ;?></div>
								<?php endif; ?>
								<?php if(trim($value->qs_note) != ""): ?>

								<div class="note"><?php echo $value->qs_note; ?></div>
								<?php endif; ?>
							<?php if($value->qs_num == 1): ?>	
							<div class="<?php echo ($bt->attributes['sj_id'] == 1 || $bt->attributes['sj_id'] == 11|| $bt->attributes['sj_id'] == 12) ?"part1":"part22"?>">
							<?php endif; ?>
							<?php if($value->qs_num == 11): ?>	
							<div class="<?php echo $bt->attributes['sj_id'] != 1 ?"part22":"part2"?>">
							<?php endif; ?>
							<?php if($value->qs_num == 41): ?>	
							<div class="part22">
							<?php endif; ?>
							<?php if($value->qs_num % 2 != 0 && $value->qs_num <11): ?>
							<div class="row">
							<?php endif; ?>
							<ul class="list-group">
								<p class="qs_err alert-danger" id="qs<?php echo $value->qs_id ?>" style="padding: 8px; border-radius: 5px; display: none;">Bạn chưa trả lời câu hỏi này</p>
		
								
								<li style="list-style: none;font-size: 17px;" class="qcontent">
								<span class="qs_number"><?php echo $value->qs_num; ?>. </span>
								<?php
									echo $value->qs_content;
								?>

								</li>
								<div class="answers">
								<?php
									foreach ($value->answers as $k => $val) {
								?>

									<li class="list-group-item" style="padding-top: 5px; padding-bottom: 5px;">

										<div class="radio radio-primary hvr-float-shadow">

								            <input <?php if(isset($questionsValue[$value->qs_id]) && $val->as_id == $questionsValue[$value->qs_id]){echo "checked ";}?> type="radio" name="<?php echo $value->qs_id; ?>" id="<?php echo $val->as_id; ?>" value="<?php echo $val->as_id; ?>">

								            <label for="<?php echo $val->as_id; ?>">

								                <?php echo $val->as_value; ?>

								            </label>

								        </div>

							      	</li>


								<?php

									}

								?>
							      	</div>

							</ul>
							<?php if($value->qs_num % 2 == 0 && $value->qs_num <11): ?>
							</div>
							<?php endif; ?>
							<?php if($value->qs_num == 10): ?>	
							</div>
							<?php endif; ?>
							<?php if($value->qs_num == 40): ?>	
							</div>
							<?php endif; ?>
							<?php if($value->qs_num == 200): ?>	
							</div>
							<?php endif; ?>

					<?php 

							}

						}

					?>

						</div>

					</div>

				</div>

				<div class="message-item">

					<a href="<?php echo $this->createUrl('home/index') ?>" class="btn btn-warning hvr-icon-back"> Quay Lại</a>

					<button id="bsubmit" onclick="return false" class="btn btn-primary hvr-icon-forward hvr-wobble-horizontal">Nộp Bài </button>

				</div>

			</div>

        </form>

	</div>

</section>

<br/>
<script type="text/javascript">
	var localStoreName = "<?php echo $st->attributes['st_code']; ?>";
	var questionsCookie = JSON.parse('<?php echo json_encode($questionsCookie, true); ?>');
	var NUMBER_ANSWER = 0;
	var NUMBER_ANSWER_CACHE = 0;
	var TIME = parseInt(<?php echo $time; ?>);
	var minute = parseInt(TIME/60);
	var second = TIME - minute * 60;
	var INTERVAL;
	if(minute < 10){
		minute = "0" + minute;
	}
	if(second < 10){
		second = "0" + second;
	}
	$("#bsubmit").click(function(){

		$.ajax("<?php echo Yii::app()->request->baseUrl ?>/home/connect", {
		  complete : function(xhr){
		  	if(xhr.status == 404){
					toastr.error("Lỗi kết nối! Vui lòng ngừng thao tác. Liên hệ với người quản trị, Dừng mọi thao tác !!!");
					return false;
		  	}
		  	if(xhr.status == 200){
		  		if(xhr.responseText.trim() != ""){
		  			toastr.error(xhr.responseText);
		  		}else{
		  			check();
		  		}
		  	}
		  }
		});
	});
	function check() {
		if(TIME <= 0){
			alert("Không thể nộp bài vì đã hết giờ làm bài !!");
			return false;
		}

		if(!confirm('Bạn đã chắc chắn khi gửi bài chưa ?')){
			return false;
		}
		$(".qs_err").hide();

		var questionIds = <?php echo json_encode($questionIds); ?>;

		var data = $("#form").serializeArray();

		dataArray = [];

		$.each(data, function (key, val) {

			dataArray[val.name] = val.value;

		});
		$("#form").submit();

		// $.ajax({

		// 	data : {data : dataArray, questionIds: questionIds},

		// 	url : "<?php echo Yii::app()->request->baseUrl ?>/home/check",

		// 	method : "post",

		// 	success : function (result) {

		// 		var ids = JSON.parse(result);

		// 		if(Object.keys(ids).length == 0){

		// 			$("#form").submit();

		// 		}else{
		// 			toastr.error("Bạn chưa trả lời hết các câu hỏi!");

		// 			$.each(ids, function (qs_id, val) {

		// 				$("#qs"+ qs_id).show();

		// 			});

		// 		}

		// 	}

		// });

		return false;
	}
	
	displayTime = function () {
		TIME --;
		questionsCookie.time = TIME;

		if(NUMBER_ANSWER % 3 == 0 && NUMBER_ANSWER_CACHE != NUMBER_ANSWER){
			NUMBER_ANSWER_CACHE = NUMBER_ANSWER;
			$.ajax({
				type : "post",
				url : "<?php echo Yii::app()->request->baseUrl ?>/home/cache",
				data : {questionsCookie : questionsCookie}
			});
		}
		if(TIME % 10 == 0){
			$.ajax({
				type : "post",
				url : "<?php echo Yii::app()->request->baseUrl ?>/home/cache",
				data : {questionsCookie : questionsCookie}
			});
		}
		if(TIME == 60){
			toastr.error("Còn 1 phút");
		}
		if(TIME == 30){
			toastr.error("Còn 30s");
		}
		if(TIME <= 0){
			$("#timer span").html("Hết giờ !");
			$("#timer").css({
				"background": "red",
				"color" :"white"
			});
			$("#timer span").css({
				"color":"white"
			});
			$("#timer div").remove();
			clearInterval(INTERVAL);
			$("#form").submit();
			return;
		}
		var minute = parseInt(TIME/60);
		var second = TIME - minute * 60;
		if(minute < 10){
			minute = "0" + minute;
		}
		if(second < 10){
			second = "0" + second;
		}
		$("#timer span").html(minute + " : "+second);

	}
	INTERVAL = setInterval(displayTime, 1000);
	$("input").change(function () {
		NUMBER_ANSWER ++;
		var qs_id = parseInt($(this).attr("name"));
		var as_id = parseInt($(this).val());
		questionsCookie.questionsValue[qs_id] = as_id;
		localAnswers = JSON.parse(localStorage.getItem(localStoreName));
		if(localAnswers == null){
			localAnswers = {};
		}
		localAnswers[qs_id] = as_id;
		localStorage.setItem(localStoreName,JSON.stringify(localAnswers));
	});

	jQuery(document).ready(function($){
		jQuery(".part1 img").css({"width" : "400px", "height" : "300px"});
	  $(window).scroll(function(){
	      if($(this).scrollTop()>200){  
	        $("#timer").addClass("tool-fixed");
	      }else{
	        $("#timer").removeClass("tool-fixed");
	      }}
	  )
	});
	$("#gotoListen").click(function(e){
	  $('html, body').animate({
	      scrollTop: $("#p_1").offset().top
	  }, 0);
	});
	$("#gotoRead").click(function(e){
	  $('html, body').animate({
	      scrollTop: $("#p_4").offset().top
	  }, 0);
	});
	$(document).ready(function () {
		localAnswers = JSON.parse(localStorage.getItem(localStoreName));
		if(localAnswers != null){
			$.each(localAnswers, function(qs_id, as_id){
				$("input[value='"+as_id+"']").click();
			});
		}
	});
</script>