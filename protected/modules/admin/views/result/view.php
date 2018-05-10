<?php
	$st = Student::model()->findByPk($model->st_id);
	$bt = Bout::model()->findByPk($model->b_id);
	$questionsValue = json_decode($model->data, true);
 ?>
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
	.part22 ul > li{
		display: block!important;
		float: none!important;
	}
</style>
<section class="features-blocks">
    <div class="container">
    	<form method="post" id="form">
	    	<div class="qa-message-list">
	    		<div class="row">
	    		 	<div class="message-item hvr-float-shadow col-md-4" style="float:left;">
			    		<div class="message-inner" style="text-align: center">
							<h4><strong style="color: #F68F43"><?php echo strtoupper("KẾT QUẢ BÀI THI ".$bt->sj->sj_name) ?></strong></h4>
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
						$p_id = 0;
						$part = null;
						$questions = array();
						foreach ($questionsValue as $key => $value) {
							$questions[] = Question::model()->findByPk($key);
						}
						foreach ($questions as $key => $value) {
							if($value->p_id != $p_id){
								$p_id = $value->p_id;
								$part = Part::model()->findByPk($p_id);
							}else{
								$part = null;
							}
					?>
							<?php if($part != null): ?>
								<h4 class="pnote" style="color: #20314b;font-size: 22px;"><?php echo $part->p_note ;?></h4>
								<h4 style="color: #20314b;font-weight: bold;font-size: 22px;text-align: center;">
								<?php echo $part->p_name ;?></h4>
							<?php endif; ?>
								<?php if(trim($value->qs_note) != ""): ?>

										<div class="note"><?php echo $value->qs_note; ?></div>
										<?php endif; ?>
									<?php if($value->qs_num == 1): ?>
									<div class="<?php echo $bt->attributes['sj_id'] != 1 ?"part22":"part1"?>">
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
										            <input <?php if(isset($questionsValue[$value->qs_id]) && $val->as_id == $questionsValue[$value->qs_id]){echo "checked ";}?> type="radio" disabled>
										            <label for="<?php echo $val->as_id; ?>" <?php if($value->as_id == $val->as_id){ echo "style=\"color:green;font-weight:bold;\""; } elseif( isset($questionsValue[$value->qs_id]) && $val->as_id == $questionsValue[$value->qs_id] && $val->as_id != $value->as_id){
										            		echo "style=\"color:red; text-decoration: line-through;\"";
										            	}?> >
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
							// }
						}
					?>
						</div>
					</div>
				</div>
			</div>
        </form>
	</div>
</section>