<?php
?>


<div id="create_form_box" class="clearfix m-3" style="display: none;">

<!--    <button type="button" id="btn_show_create_form" class="btn btn-primary btn-lg" onclick="formsAdminService.showCreateForm()">Create form</button>-->

    <div class="card bg-light">

        <div class="card-body">
            <h5 class="card-title">Create form</h5>

            <form id="create_new_form" method="post">
                <div class="form-row align-items-center">
                    <div class="col-sm-12">
                        <label class="sr-only" for="inlineFormInput">Form name</label>
                        <input type="text" class="form-control form-control-sm" id="form_name" name="form_name" placeholder="Form title...">
                        <div class="invalid-feedback">Example invalid feedback text</div>
                    </div>
                </div>

                <button type="reset" class="btn btn-secondary btn-sm mb-2 float-sm-right mt-2" onclick="formsAdminService.hideCreateForm()">Cancel</button>
                <button type="submit" class="btn btn-primary btn-sm mb-2 float-sm-right mt-2 mr-2">Create form</button>
            </form>

        </div>
    </div>

    <div id="result_submit"></div>

</div>


