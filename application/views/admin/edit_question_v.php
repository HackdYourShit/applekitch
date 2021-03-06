<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'templates/header.php';
?>
<div id="edit_option_input_add" style="display: none;">
    <input type="text" name="option_1[]" class="form-control option_1" >
</div>
	<div class="container-fluid">
		<div class="row">
			<nav class="col-md-2 d-none d-md-block bg-light sidebar">
				<?php require_once 'templates/profile_sidebar.php'; ?>
			</nav>

			<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
					<div class="container">
						<div class="row">
							<div class="col-lg-6">
								<h1 class="h2"><?= $title; ?></h1>
							</div>
							<div class="col-lg-6">
                                <a href="<?php echo base_url('admin/questions'); ?>" class="btn btn-primary btn-sm">Back</a>
							</div>
						</div>
					</div>
				</div>
				<?php $this->load->view('admin/templates/error_v.php'); ?>
				<!--<form method="post" action="<?php /*echo base_url('/admin/'.$method) */?>">-->
				<?php if(!empty($questions)) { ?>
                    <?php //print_r($questions); ?>
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label>Country: </label>
							<?php echo form_dropdown('country',form_dropdown_cr(array('id','name'),'country'),$questions->country_id,array('class'=>'form-control','id'=>'country_id','required'=>true)); ?>
						</div>
						<div class="col-md-6">
							<label>Subject: </label>
							<?php echo form_dropdown('subject',form_dropdown_cr(array('id','name'),'subject'),$questions->subject_id,array('class'=>'form-control','id'=>'subject_id','required'=>true)); ?>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label>Grade: </label>
							<?php echo form_dropdown('grade',form_dropdown_cr(array('id','name'),'grade'),$questions->grade_id,array('class'=>'form-control','id'=>'grade_id','required'=>true)); ?>

						</div>
						<div class="col-md-6">
							<label>Category: </label>
							<?php echo form_dropdown('category',form_dropdown_cr(array('id','name'),'category'),$questions->category_id,array('class'=>'form-control','id'=>'category_id','required'=>true)); ?>

						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label>Topic: </label>
							<?php echo form_dropdown('topic',form_dropdown_cr(array('topic_id','topic_name'),'topics'),$questions->topic_id,array('class'=>'form-control','id'=>'topic_id','required'=>true)); ?>
						</div>
						<div class="col-md-6">
							<!--<label>Type: </label>
							--><?php /*echo form_dropdown('question_type',form_dropdown_cr(array('type_id','type_name'),'question_type'),'',array('class'=>'form-control')); */?>
						</div>
					</div>
				</div>
				<hr>
					<?php $form_data=unserialize($questions->form_data); ?>
                    <?php //print_r($form_data); ?>
				<h4>Add question here</h4>
				<div id="add_row_demo">
					<div class="add_question_row">
						<div class="row_delete">
							<a class="deletQ_row" href="#" title="Delete"><span data-feather="delete"></span></a>
						</div>

                            <h5>Preview</h5>
                            <iframe name="edit_iframe" id="edit_iframe" src="<?php
                            echo base_url('admin/preview?qid='.$questions->question_id); ?>"></iframe>

						<form action="" class="addQ_form" enctype="multipart/form-data">
							<div class="addQ_field_grp">
								<div class="form-group">
									<div class="row">
										<div class="col-lg-12">
											<input type="hidden" name="question_id" class="question_id" value="<?php echo $questions->question_id; ?>">
											<label for="question">Question</label>
											<input class="form-control question" name="question" id="question" value="<?php echo $questions->question_name; ?>" type="text" required>
										</div>

									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-lg-6">
											<label for="question">Question Option</label>
											<?php echo form_dropdown('question_option',form_dropdown_cr(array('option_id','option_name'),'question_option'),$form_data['question_option'],array('class'=>'form-control questions_option_drop','required'=>true)); ?>
										</div>
										<div class="col-lg-6">
											<label for="q_score">Question Marks</label>
											<input class="form-control" name="q_score" id="q_score" value="<?php echo $questions->q_score; ?>" type="number" required>
										</div>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <div class="col-lg-12">
                                            <label for="qRight_feedback">If Answer Right</label>
                                            <input type="text" class="form-control" name="qRight_feedback" id="qRight_feedback" value="<?php echo !empty($form_data['qRight_feedback'])?$form_data['qRight_feedback']:''; ?>">
                                        </div>
                                        <div class="col-lg-12">
                                            <label for="qRight_feedback">If Answer Wrong (explanation)</label>
                                            <textarea class="form-control tynimce" name="qWrong_feedback" id="qWrong_feedback"><?php echo !empty($form_data['qWrong_feedback'])?$form_data['qWrong_feedback']:''; ?></textarea>
                                        </div>
										<div class="col-lg-12">
											<div class="add_dynamic_field">
											</div>

											<!--<label for="question">Question Type</label>
											--><?php /*echo form_dropdown('question_type',form_dropdown_cr(array('type_id','type_name'),'question_type'),'',array('class'=>'form-control')); */?>
										</div>
									</div>
								</div>
								<div class="question_wrap">
									<?php                                                $c_data['question_option']=$form_data['question_option'];
									$c_data['form_cdata']=$form_data;
									?>
									<?php $this->load->view('admin/templates/edit_combination',$c_data); ?>
                                </div>
							</div>
							<!--<a href="javascript:void(0)" class="btn add_row_save addQ_preview"><span data-feather="eye"></span> Preview</a>-->
							<a href="javascript:void(0)" class="btn add_row_save addQ_edit"><span data-feather="arrow-right-circle"></span> Update</a>
						</form>
					</div>
				</div>
				<div id="add_row"></div>
				<!--<div class="form-group">
					<div class="row">
						<div class="col-md-12">
							<div style="text-align: right;">
								<a href="javascript:void(0)" class="btn add_row addQ_row" ><span data-feather="plus-circle"></span> Add Row</a>
							</div>
						</div>
					</div>
				</div>-->
				<!--<div class="form-group">
					<div class="row">
						<div class="col-md-12">
							<div style="text-align: left;">
								<input type="submit" name="save" id="question_save" class="btn btn-primary btn-primary-green" value="Save"/>
							</div>
						</div>
					</div>
				</div>-->
				<?php } ?>
				<div id="loading" class="loading">Loading&#8230;</div>
				<!--</form>-->
			</main>
		</div>
	</div>
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Preview</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" id="myModal_body">
					...
				</div>
				<!--<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>-->
			</div>
		</div>
	</div>
	<div style="display: none">
		<?php $this->load->view('admin/templates/combination_form.php'); ?>
	</div>

	<script>
        jQuery(function(){
            jQuery('.table').footable();
        });
	</script>
<?php
require_once 'templates/footer.php';
?>

