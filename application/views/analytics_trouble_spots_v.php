<?php
/**
 * Created by PhpStorm.
 * User: Rana
 * Date: 9/6/2018
 * Time: 7:02 PM
 */

?>

<?php
require_once 'templates/header.php';
?>
<div class="inner-pages backend">
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
				<?php require_once 'templates/profile_sidebar.php'; ?>
			</div>
			<div class="col-lg-9">
				<div class="contentSection">
					<div class="dashboard-section">
						<div class="box-wrapper">
							<div class="box-title"><?php echo $title; ?></div>
							<div class="box-container">
								<div class="filter_box">
									<?php echo form_open(base_url('dashboard/'.$search_url),array('class'=>'form-control filter-form')); ?>
									<?php echo form_dropdown('subject_id',form_dropdown_cr(array('id','name'),'subject'),'',array('class'=>'form-control')); ?>
									<?php echo form_dropdown('grade_id',form_dropdown_cr(array('id','name'),'grade'),'',array('class'=>'form-control')); ?>
									<?php echo form_submit('search','Search',array('class'=>'btn btn-default btn-small')); ?>
									<?php echo form_close(); ?>
								</div>

								<div class="score_table">
									<div class="table_head">
										<div class="row">
											<div class="col-lg-4"><div class="table_head_text">Skill</div></div>
											<div class="col-lg-2"><div class="table_head_text">Time</div></div>
											<div class="col-lg-2"><div class="table_head_text">Score</div></div>
											<div class="col-lg-2"><div class="table_head_text">Missed</div></div>
											<div class="col-lg-2"><div class="table_head_text"></div></div>
										</div>
									</div>
									<div class="table_body">
                                        <?php //print_r($jquery_day_array); exit(); ?>
										<?php if(!empty($jquery_day_array)){ ?>
											<?php foreach ($jquery_day_array as $key_cat=>$value_cat){ ?>
                                                <button class="accordion"><?php echo get_returnfield('category','id', $key_cat,'name'); ?> </button>
                                                <div class="panel">
													<?php foreach($value_cat as $key_top=>$value_top) { ?>
                                                        <div class="row">
                                                            <div class="col-lg-4"><div class="table_body_text"><?php echo get_returnfield('topics','topic_id', $key_top,'topic_name'); ?></div></div>
                                                            <div class="col-lg-2"><div class="table_body_text"><?php echo $value_top['total_time']; ?> min</div></div>
                                                            <div class="col-lg-2"><div class="table_body_text"><?php echo $value_top['total_marks']; ?></div></div>
                                                            <div class="col-lg-2"><div class="table_body_text"><?php echo (!empty($value_top['total_ans_wrong']))?$value_top['total_ans_wrong']:0; ?></div></div>
                                                            <div class="col-lg-2"><div class="table_body_text"><a href="#">View All</a></div></div>
                                                        </div>
													<?php } ?>
                                                </div>
											<?php } ?>
										<?php } else { echo '<h3>No data found!</h3>'; } ?>

									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
				<!--Certificate design-->

				<!--end here-->

			</div>
		</div>
	</div>
</div>

<?php
require_once 'templates/footer.php';
?>
