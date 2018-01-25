<?php
/**
 * @var $data array
 */
$user_email = '';
if(isset($data['user_email']))
	$user_email=\IB\Common\HelperIb::htmlEntities($data['user_email']);
?>
<h1 style="margin-bottom: 20px">Login</h1>

<div class="clearfix">
	<form method="post">
		<div class="form-group row">
			<label for="user_email" class="col-sm-2 col-form-label col-form-label-sm">Email</label>
			<div class="col-sm-10">
				<input type="text" id="user_email" name="user_email" value="<?=$user_email?>" class="form-control form-control-sm"  placeholder="Email adress">
				<div class="invalid-feedback">Example invalid feedback text</div>
			</div>
		</div>

		<div class="form-group row">
			<label for="user_pass" class="col-sm-2 col-form-label col-form-label-sm">Password</label>
			<div class="col-sm-10">
				<input type="password" id="user_pass" name="user_pass" class="form-control form-control-sm" placeholder="Your password">
				<div class="invalid-feedback">Example invalid feedback text</div>
			</div>
		</div>

		<div class="form-group row justify-content-end">
			<div class="col-sm-10">
				<button type="submit" class="btn btn-primary btn-sm float-sm-left my-2">Login</button>
				<span class="btn-sm my-2"><a href="/register/" class="btn btn-link btn-sm my-2">Create account</a></span>
			</div>
		</div>
	</form>
</div>
