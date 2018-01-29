<?php
/**
 * @var $dao array
 * @var $quizRows array
 */
?>

<div class="card bg-light mb-3">

	<div class="card-body">
		<h5 class="card-title">Edit form</h5>



		<form id="edit_form" method="post">

			<input type="hidden" id="form_id" name="form_id" value="<?=$dao['form_id']?>">

			<div class="form-row">
				<div class="form-group col">
					<label for="inputEmail4" class="col-form-label-sm mb-0 pb-0">Form title</label>
					<input type="text" id="form_name" name="form_name" value="<?=$dao['form_name']?>" class="form-control form-control-sm mt-0" placeholder="Form title">
					<div class="invalid-feedback">Example invalid feedback text</div>
				</div>
			</div>

			<h6 class="mb-1 mt-2">Questions</h6>

			<div id="quiz_questions_destination">

				<?php
				foreach ( $quizRows as $key => $val ) {
					$quiz_name_attr = "quiz_options[" . $val['quiz_id'] ."][q]";
					$quiz_name_val = \IB\Common\HelperIb::htmlEntities($val['quiz_question']);
					$quiz_items = \IB\Common\HelperIb::jsonDecode($val['quiz_options'],true);
					?>
				<div class="quiz_item">
					<div class="form-row quiz">
						<div class="form-group col mt-3 mb-0">
							<input type="text" name="<?=$quiz_name_attr?>" value="<?=$quiz_name_val?>" class="form-control form-control-sm mt-0" placeholder="Question">
							<div class="invalid-feedback">Example invalid feedback text</div>
						</div>
						<div class="form-group col-auto mt-3 mb-0">
							<button type="button" class="btn btn-danger btn-sm float-sm-right" onclick="formsAdminService.deleteQuestion(this)">Delete</button>
						</div>
					</div>

					<div class="form-row quiz_response_row">
						<?php
						foreach ($quiz_items as $k => $v) {
							$opt_name_attr =  "quiz_options[" . $val['quiz_id'] ."][r][$k]";
							$opt_val = \IB\Common\HelperIb::htmlEntities($v);
							?>
							<div class="form-group col quiz_response">
								<label class="col-form-label-sm mb-0 pb-0">Option 3</label>
								<input type="text" name="<?=$opt_name_attr?>" value="<?=$opt_val?>" class="form-control form-control-sm mt-0" placeholder="Option label">
							</div>
							<?php
						}
						?>
					</div>
				</div>
					<?php
				}
				?>

			</div>

<!--			<button type="reset" class="btn btn-secondary btn-sm mb-2 float-sm-right mt-3" onclick="//formsAdminService.hideCreateForm()">Cancel</button>-->
			<button type="submit" class="btn btn-primary btn-sm mb-2 float-sm-right mt-3">Save form</button>
			<button type="button" class="btn btn-outline-primary btn-sm mb-2 mt-3 mr-2" onclick="formsAdminService.addQuestion()">Add question</button>

		</form>

	</div>
</div>

<div id="result_edit_process"></div>

<div id="template_quiz" class="quiz_item no_quiz_display">

	<div class="form-row quiz">
		<div class="form-group col mt-3 mb-0">
			<input type="text" name="" value="" class="form-control form-control-sm mt-0" placeholder="Question">
			<div class="invalid-feedback">Example invalid feedback text</div>
		</div>
		<div class="form-group col-auto mt-3 mb-0">
			<button type="button" class="btn btn-danger btn-sm float-sm-right" onclick="formsAdminService.deleteQuestion(this)">Delete</button>
		</div>
	</div>

	<div class="form-row quiz_response_row">
		<div class="form-group col quiz_response">
			<label class="col-form-label-sm mb-0 pb-0">Option 1</label>
			<input type="text" name="" value="" class="form-control form-control-sm mt-0" placeholder="Option label">
		</div>
		<div class="form-group col quiz_response">
			<label class="col-form-label-sm mb-0 pb-0">Option 2</label>
			<input type="text" name="" value="" class="form-control form-control-sm mt-0" placeholder="Option label">
		</div>
		<div class="form-group col quiz_response">
			<label class="col-form-label-sm mb-0 pb-0">Option 3</label>
			<input type="text" name="" value="" class="form-control form-control-sm mt-0" placeholder="Option label">
		</div>
		<div class="form-group col quiz_response">
			<label class="col-form-label-sm mb-0 pb-0">Option 4</label>
			<input type="text" name="" value="" class="form-control form-control-sm mt-0" placeholder="Option label">
		</div>
		<div class="form-group col quiz_response">
			<label class="col-form-label-sm mb-0 pb-0">Option 5</label>
			<input type="text" name="" value="" class="form-control form-control-sm mt-0" placeholder="Option label">
		</div>
	</div>

</div>

<script>
	formsAdminService.bindEditForm();
</script>