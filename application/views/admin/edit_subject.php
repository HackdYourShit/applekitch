<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'templates/header.php';
?>
	<div class="container-fluid">
		<div class="row">
			<nav class="col-md-2 d-none d-md-block bg-light sidebar">
				<?php require_once 'templates/profile_sidebar.php'; ?>
			</nav>

			<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
					<h1 class="h2"><?= $title; ?></h1>
				</div>
				<form method="post" action="<?= base_url('/admin/update_subject') ?>">
					<div class="form-group">
						<div class="row">
							<input name="subject_id" type="hidden" value="<?= $subject['id']; ?>"/>
							<div class="col-md-6">
								<label>Name: </label>
								<input required type="text" name="name" class="form-control" value="<?= $subject['name']; ?>"/>
							</div>
							<?php /*if(!empty($grades)) { */?><!--
								<div class="col-md-6">
									<label>Grade: </label>
									<select class="form-control" name="grade">
										<option>----</option>
										<?php /*foreach($grades as $grade) { */?>
											<option<?php /*if($subject['grade'] == $grade['id']) { */?> selected<?php /*} */?> value="<?/*= $grade['id']; */?>"><?/*= $grade['name']; */?></option>
										<?php /*} */?>
									</select>
								</div>
							--><?php /*} */?>
						</div>
					</div>
					<!--<div class="form-group">
						<div class="row">
							<div class="col-lg-12">
								<label>Country: </label>
								<select class="form-control" name="country">
									<option>----</option>
									<?php /*foreach($countries as $country) { */?>
										<option<?php /*if($subject['country'] == $country['id']) { */?> selected<?php /*} */?> value="<?/*= $country['id']; */?>"><?/*= $country['name']; */?></option>
									<?php /*} */?>
								</select>
							</div>
						</div>
					</div>-->
					<div class="form-group">
						<div class="row">
							<div class="col-md-12">
								<div style="text-align: right;">
									<input type="submit" name="save" class="btn btn-primary btn-primary-green" value="Update"/>
								</div>
							</div>
						</div>
					</div>
				</form>
			</main>
		</div>
	</div>
	<script>
        jQuery(function(){
            jQuery('.table').footable();
        });
	</script>
<?php
require_once 'templates/footer.php';
?>