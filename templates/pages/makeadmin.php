<?php
$user_email = '';
if(isset($data['user_email']))
	$user_email=\IB\Common\HelperIb::htmlEntities($data['user_email']);
?>
<h1 style="margin-bottom: 20px">Make Admin</h1>

<div class="clearfix">
	<form method="post">

		<div class="form-group row">
			<label for="user_email" class="col-sm-2 col-form-label col-form-label-sm">Email</label>
			<div class="col-sm-10">
				<input type="text" id="user_email" name="user_email" value="<?=$user_email?>" class="form-control form-control-sm"  placeholder="Email adress">
				<div class="invalid-feedback">Example invalid feedback text</div>
			</div>
		</div>

		<div class="form-group row justify-content-end">
			<div class="col-sm-10">
				<button type="submit" class="btn btn-primary btn-sm float-sm-left my-2">Make admin</button>
			</div>
		</div>
	</form>
</div>
