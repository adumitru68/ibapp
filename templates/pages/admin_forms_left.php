<?php
?>


<div class="clearfix m-3">

	<div class="card bg-light" id="forms_list">

		<div class="card-body pl-3 pr-3 pb-2">
			<h5 class="card-title">Forms list</h5>
<!--			<form method="post">-->
				<div class="form-row align-items-center">
					<div class="col">
						<label class="sr-only" for="search_forms">Form name</label>
						<input type="text" class="form-control form-control-sm mb-2" id="search_forms" name="search_forms" placeholder="Forms filter...">
					</div>
					<div class="col-auto">
						<button type="button" id="btn_show_create_form" class="btn btn-primary btn-sm mb-2 float-sm-right" onclick="formsAdminService.showCreateForm()">New form</button>
					</div>
				</div>
<!--			</form>-->
		</div>

		<div id="list_of_forms" class="card mr-3 ml-3 mb-3">

		</div>

	</div>



</div>


